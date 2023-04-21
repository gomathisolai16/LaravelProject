<?php

namespace App\Models;

use App\Additional\Models\ActivePassive;
use App\Additional\Models\CommonFilters;
use App\Additional\Models\Orderable;
use App\Additional\Models\OwnerOrAdmin;
use App\Schemes\Models\IOrderable;
use App\Models\UserWatchList;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * Class News
 * @package App\Models
 */
class News extends Model implements IOrderable
{
    use OwnerOrAdmin,
        Orderable,
        CommonFilters,
        ActivePassive;

    /**
     * Order fields by release date
     * Default order field is created_at
     * @var string $_orderField
     */
    protected $_orderField = 'release_date';

    /**
     * @var array $usedItems
     */
    protected $usedItems = [
        'tickers' => [],
        'categories' => []
    ];
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'title',
        'percentage',
        'description',
        'meta_keywords',
        'top',
        'active',
        'release_date',
        'show_in_editor',
        'transmission_id',
        'version',
        'video',
        'crypto',
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $categories
     * @param string $order
     * @return mixed
     */
    public function scopeForSingleDashboardCall($query, array $categories, $order = 'desc')
    {
        $n = $this->getTable();
        return $query
            ->select("$n.*", \DB::raw('(
                    CASE WHEN `' . \DB::getTablePrefix() . 'unp`.`user_id` IS NULL THEN 0 ELSE 1 END
                ) as `parked`'), 'i.path as image_path')
            ->join('new_category as nc', function ($join) use ($categories, $n) {
                $join->on("$n.id", '=', 'nc.new_id')->whereIn('nc.category_id', $categories);
            })
            ->leftJoin('new_image as ni', "$n.id", '=', 'ni.new_id')
            ->leftJoin('images as i', 'i.id', '=', 'ni.image_id')
            ->leftJoin('user_new_parked as unp', 'unp.new_id', '=', "$n.id")
            ->groupBy("$n.id")
            ->orderBy("$n.release_date", $order);
    }

    /**
     * Scope a query to only include parked news.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $parked
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParked($query, $parked)
    {
        $tbl = $this->getTable();
        return !$parked
            ? $query->whereNotIn($tbl . '.id', function ($subQuery) {
                $subQuery->select('new_id')->from('user_new_parked')->where('user_id', Auth::id());
            })
            : $query->join('user_new_parked as unp', $tbl . '.id', '=', 'unp.new_id')
                ->where('unp.user_id', Auth::id());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $flag
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForEditor($query, $flag = true)
    {
        return $query->where([
            'top' => true,
            'show_in_editor' => $flag,
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithParkedStatus($query)
    {
        return $query->selectRaw(\DB::getTablePrefix() . $this->getTable() . ".*, IF(`" . \DB::getTablePrefix() . "tnp`.`new_id` IS NULL, FALSE, TRUE) as parked")
            ->leftJoin(\DB::raw("(SELECT DISTINCT new_id FROM " . \DB::getTablePrefix() . "user_new_parked WHERE `" . \DB::getTablePrefix() . "user_new_parked`.`user_id` = " . Auth::id() . ") as `" . \DB::getTablePrefix() . "tnp`"), 'news.id', '=', 'tnp.new_id');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function scopeSubscribeLevel($query)
    {
        if (!Auth::user()->hasRole('admin')) {
            $subscription = Auth::user()->getSubscription();
            if (empty($subscription)) {
                return $query;
            }
            $subscriptionsIds = Subscription::getSubscriptionsHierarchyBySubscription($subscription);
            if (!count($subscriptionsIds)) {
                return $query;
            }
            $allowVideoNews = Subscription::hasSubscriptionsHierarchyVideoRelatedSubscription($subscription);
            // The following source code is part of Query optimizations.
            // What it does it is that it replaces EXISTS operation that we had before, which was very slow
            // with COUNT operation. So, instead of EXISTS in SELECT, we COUNT in SELECT and then check if COUNT is greater than 0.
            // The problem with this appraoch is that you cannot use this in WHERE state unless you wrap the entire query
            // with another SELECT. That is what is done in the rest of the code.

            $query = $query->addSelect(
                DB::raw("(select COUNT(*)
                    from `tbl_new_category` as `tbl_nc` 
                    inner join `tbl_categories` as `tbl_c` 
                    on `tbl_c`.`id` = `tbl_nc`.`category_id` 
                    where `tbl_c`.`subscription_id` in (" . implode(',', $subscriptionsIds) . ") 
                    and tbl_nc.new_id = tbl_news.id" . (!$allowVideoNews ? " and tbl_news.video = 0" : "") . ") as subscribed"
                )
            );
            
            // ORDER BY workaround is to move order by from subquery into main query.
            // Otherwise results are not the same.
            $orderBy = $query->getQuery()->orders;
            $query->getQuery()->orders = null;            

            // Wrap with SELECT and add new ORDER BY criteria.
            $newQuery = DB::table(
                DB::raw("({$query->toSql()}) as " . \DB::getTablePrefix() . "news") )
                ->mergeBindings($query->getQuery())
                ->selectRaw('*')
                ->where('subscribed', '>', 0);
                
            foreach($orderBy as $orderCriteria)
            {
                $newQuery = $newQuery->orderBy($orderCriteria["column"], $orderCriteria["direction"]);
            }

            return $query->setQuery($newQuery);
        }

        return $query;
    }

    /**
     * Scope a query to only include parked news.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTop($query, $filter)
    {
        return $query->where('top', $filter);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVideo($query, $filter)
    {
        return $query->where('video', $filter);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class, 'new_image', 'new_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function videos() {
        return $this->belongsToMany(Video::class, 'news_video', 'news_id');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTicker($query, $filter)
    {
        if (is_array($filter)) {
            return $query->leftJoin('new_ticker', 'news.id', '=', 'new_ticker.new_id')->whereIn('new_ticker.ticker_id', $filter)->distinct()
                ->select('news.*');
        } else {
            return $query->leftJoin('new_ticker', 'news.id', '=', 'new_ticker.new_id')->where('new_ticker.ticker_id', $filter);
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickers()
    {
        return $this->belongsToMany(Ticker::class, 'new_ticker', 'new_id', 'ticker_id')
            ->withPivot('id')
            ->orderBy('new_ticker.id', 'asc');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $keywords
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKeywords($query, $keywords)
    {
        $length = count($keywords);

        if ($length) {
            for ($i = 0; $i < $length; $i++) {
                $decoded = urldecode($keywords[$i]);
                $query->orWhereRaw("match(`" . \DB::getTablePrefix() . "news`.`title`, `" . \DB::getTablePrefix() . "news`.`description`) against (?)", [$decoded]);
            }
        }
        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $categories
     * @param null $user
     * @param $innerJoin
     * @return mixed
     */
    public function scopeCategories($query, $categories, $user = null, $innerJoin = true)
    {
        if ($user == null) {
            $user = Auth::user();
        }
        $categories = $user->filterCategoriesBySubscription($categories, $user);                
        // We need to make the joining configurable in order to switch between from INNER to LEFT based on the need
        $query = $query->{$innerJoin ? 'join' : 'leftJoin'}(\DB::raw('(SELECT DISTINCT `tnc`.`new_id` ' .
            'FROM `' . \DB::getTablePrefix() . 'new_category` AS `tnc` ' .
            'WHERE `tnc`.`category_id` IN ('. implode(',', $categories) .') ' 
            .') AS ' . \DB::getTablePrefix() . 'tb2'), 'news.id', '=', 'tb2.new_id');
        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $tickers
     * @param $isStrict
     * @return mixed
     */
    public function scopeTickers($query, $tickers, $isStrict = false)
    {
        $q = $query->leftJoin(\DB::raw('(SELECT DISTINCT `tnt`.`new_id`' .
            ($isStrict ? ', `tnt`.`ticker_id`, (SELECT GROUP_CONCAT(`tntl`.`ticker_id` ORDER BY `tntl`.`id` ASC) FROM `' . \DB::getTablePrefix() . 'new_ticker` AS `tntl` WHERE `tntl`.`new_id` = `tnt`.`new_id` GROUP BY `tntl`.`new_id`) AS `tickers_list`' : '') .
            ' FROM   `' . \DB::getTablePrefix() . 'new_ticker` AS `tnt` ' .
            'WHERE  `tnt`.`ticker_id` ' .
            'IN (' . implode(',', $tickers) . ') '.
            'GROUP BY `tnt`.`new_id`'. ($isStrict ? ' HAVING LOCATE(CAST(`tnt`.`ticker_id` AS CHAR), `tickers_list`) = 1' : '') .') ' .
            'AS ' . \DB::getTablePrefix() . 'tb1'), 'news.id', '=', 'tb1.new_id')
            ->where('tb1.new_id', '!=', null);
        return $q;
    }

    /**
     * @param string $relation
     * @param array $data
     * @return mixed
     */
    public function storeBulkRelation($relation, $data)
    {
        return \DB::table("new_$relation")->insert($data);
    }

    /**
     * @return int
     */
    public function resolveAndGetLastId()
    {
        $news = $this->orderBy('id', 'desc')->first();
        $maxId = null === $news ? 0 : $news->id;
        \DB::statement('ALTER TABLE ' . env('DB_PREFIX') . 'news AUTO_INCREMENT=' . ($maxId + 1));
        return $maxId + 1;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'new_category', 'new_id', 'category_id');
    }

    /**
     * @param int $newId
     * @return bool
     */
    public function toggleParked($newId)
    {
        $data = [
            'user_id' => Auth::guard('api')->id(),
            'new_id' => $newId
        ];
        $tbl = \DB::table('user_new_parked');

        $parkedNew = $tbl->where($data)->first();

        if ($parkedNew) {
            $tbl->where('new_id', $parkedNew->new_id)->delete();
            return false;
        }

        $tbl->insert($data);
        return true;
    }

    /**
     * @return Collection
     */
    public static function getTickerUpdates()
    {
        return DB::table('news')
            ->join('new_ticker', 'news.id', '=', 'new_ticker.new_id')
            ->join('tickers', 'new_ticker.ticker_id', '=', 'tickers.id')
            ->distinct()
            ->select('tickers.id', 'tickers.abbreviation', 'news.created_at')
            ->orderBy('news.created_at', 'desc')
            ->get();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $moduleId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByModuleId($query, $moduleId, $userId = null)
    {
        $module = Module::find($moduleId);
        $user = $userId ? User::find($userId) : Auth::user();
        // TODO: Handle better case when Watch List record is deleted so related column 'watch_list' is maked null
        // NOTE: We need to make sure that assigned Watch List record is created from logged user for the edge cases
        // when preset/public modules are loaded from regular users different from the admins that have created them
        $handleWatchList = $module && !is_null($module->watch_list) && !is_null(UserWatchList::where(['user_id' => $user->id, 'id' => $module->watch_list])->first())
            ? true
            : false;
        if ($handleWatchList) {
            // Check if the search is 'Strict' or 'Loose'
            $isStrict = (bool)$module->strict;
            $query = $query
                ->join(\DB::raw('
                    (
                        SELECT' . 
                            '`new_id`,' .
                            '`tnt`.`ticker_id`,' .
                            '(SELECT GROUP_CONCAT(`tntf`.`ticker_id` ORDER BY `tntf`.`id` ASC) FROM `' . \DB::getTablePrefix() . 'new_ticker` AS `tntf` WHERE `tntf`.`new_id` = `tnt`.`new_id` GROUP BY `tntf`.`new_id`) AS `ticker_list`' .
                        'FROM `'. \DB::getTablePrefix() . 'new_ticker` AS `tnt`' .
                        'INNER JOIN (SELECT `ticker_id` FROM `' . \DB::getTablePrefix() . 'user_ticker` WHERE `watch_list_id` = ' . $module->watch_list . ') AS `tut`' . 
                        'ON `tnt`.`ticker_id` = `tut`.`ticker_id`' .
                        'GROUP BY `tnt`.`new_id`' . ($isStrict ? ' HAVING LOCATE(CAST(`tnt`.`ticker_id` AS CHAR), `ticker_list`) = 1' : '') . '
                    ) AS `'. \DB::getTablePrefix() . 'twt`
                '), 'news.id', '=', 'twt.new_id');
            // Do LEFT JOIN so we can get news records based on the records filter by the Watch List
            $query = $query->leftJoin(\DB::raw('
                (
                    SELECT `new_id` ' .
                    'FROM `' . \DB::getTablePrefix() . 'new_category` ' .
                    'INNER JOIN `' . \DB::getTablePrefix() . 'module_category` '.
                        'ON  `' . \DB::getTablePrefix() . 'module_category`.`category_id` = `' . \DB::getTablePrefix() . 'new_category`.`category_id` ' .
                    'WHERE `' . \DB::getTablePrefix() . 'module_category`.`module_id` = ' . $moduleId . ' ' .
                ') AS ' . \DB::getTablePrefix() . 'tbcu'), 'news.id', '=', 'tbcu.new_id');
        } else {
            $query = $query
                    ->join('new_category', 'news.id', '=', 'new_category.new_id')
                    ->join('module_category', 'new_category.category_id', '=', 'module_category.category_id')
                    ->where('module_category.module_id', $moduleId);

                    $query->distinct();
        }
        $subscription = app(User::class)->getSubscription($user->id);
        if (!Subscription::hasSubscriptionsHierarchyVideoRelatedSubscription($subscription) && !$user->hasRole('admin')) {
            $query = $query->whereRaw("`" . \DB::getTablePrefix() . "news`.`video` = 0");
        } else {
            $moduleCategories = $module->categories()->get()->toArray();
            $videoCategoriesCount = $module->getVideoCategoriesCount($moduleCategories);
            // In cases we have to deal with a "Video Module" (it means it has at least on video category) we should consider cases
            // when we have other categories that should filter video content in an "AND" relation (it should alter the Watchlist implementation as well)
            $filterVideoNewsByAssociatedCategories = (bool)$videoCategoriesCount && count($moduleCategories) !== $videoCategoriesCount;
            if ($filterVideoNewsByAssociatedCategories) {
                $implodeVideoCategories = implode(',', array_map(function($category) {
                    return "'$category'";
                }, Category::VIDEO_CATEGORIES_CODES));
                $query = $query->selectRaw('(
                    SELECT COUNT(*) FROM `' . \DB::getTablePrefix() . 'module_category`
                    INNER JOIN `' . \DB::getTablePrefix() . 'new_category` ON `' . \DB::getTablePrefix() . 'module_category`.`category_id` = `' . \DB::getTablePrefix() . 'new_category`.`category_id` 
                    INNER JOIN `' . \DB::getTablePrefix() . 'categories` ON `' . \DB::getTablePrefix() . 'categories`.`id` = `' . \DB::getTablePrefix() . 'module_category`.`category_id`
                    WHERE `' . \DB::getTablePrefix() . 'news`.`id` = `' . \DB::getTablePrefix() . 'new_category`.`new_id` AND `' . \DB::getTablePrefix() . 'categories`.`abbreviation` NOT IN (' . $implodeVideoCategories . ') AND `' . \DB::getTablePrefix() . 'module_category`.`module_id` = ' . $module->id . ') AS `nonVideoCategoryCount`');
                $query = $query->selectRaw('(
                    SELECT COUNT(*) FROM `' . \DB::getTablePrefix() . 'module_category`
                    INNER JOIN `' . \DB::getTablePrefix() . 'new_category` ON `' . \DB::getTablePrefix() . 'module_category`.`category_id` = `' . \DB::getTablePrefix() . 'new_category`.`category_id` 
                    INNER JOIN `' . \DB::getTablePrefix() . 'categories` ON `' . \DB::getTablePrefix() . 'categories`.`id` = `' . \DB::getTablePrefix() . 'module_category`.`category_id`
                    WHERE `' . \DB::getTablePrefix() . 'news`.`id` = `' . \DB::getTablePrefix() . 'new_category`.`new_id` AND `' . \DB::getTablePrefix() . 'categories`.`abbreviation` IN (' . $implodeVideoCategories . ') AND `' . \DB::getTablePrefix() . 'module_category`.`module_id` = ' . $module->id . ') AS `videoCategoryCount`');
                $query = $query->groupBy('news.id');
                $query = $query->having('videoCategoryCount', '>', 0);
                $query = $query->having('nonVideoCategoryCount', '=', count($moduleCategories) - $videoCategoriesCount);
            }
        }
        return $query;
    }
}
