<?php

namespace App\Models;

use App\Additional\Models\Nestedable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    const SUBSCRIPTION_BASIC = "Basic";
    const SUBSCRIPTION_TRIAL = "Trial";
    const VIDEO_CATEGORIES_CODES = ['VIDE.MN', 'BVID.MN'];
    const CRYPTO_CATEGORIES_CODES = ['CRYP.MN'];

    use Nestedable;

    /**
     * @var string $_relationId
     */
    protected $_relationId = "category_id";
    /**
     * @var array
     */
    protected $fillable = [
        'abbreviation',
        'title',
        'description',
        'active',
        'subscription_id',
        'category_id',
        'sort_order'
    ];

    /**
     * @param string|array $abbreviations
     * @return boolean
     */
    public static function isTopNewsCategory($abbreviations)
    {
        if (!isset($abbreviations)) {
            return false;
        }
        if (is_string($abbreviations)) {
            $abbreviations = [$abbreviations];
        }
        if (!is_array($abbreviations)) {
            return false;
        }
        if (!count($abbreviations)) {
            return false;
        }
        return (bool) count(array_filter($abbreviations, function($abbreviation) {
            return in_array($abbreviation, ['TOPN.MN'], true);
        }));
    }

    /**
     * @param string|array $abbreviations
     * @return boolean
     */
    public static function isVideosNewsCategory($abbreviations)
    {
        if (!isset($abbreviations)) {
            return false;
        }
        if (is_string($abbreviations)) {
            $abbreviations = [$abbreviations];
        }
        if (!is_array($abbreviations)) {
            return false;
        }
        return (bool) count(array_filter($abbreviations, function ($abbreviation) {
            return in_array($abbreviation, self::VIDEO_CATEGORIES_CODES, true);
        }));
    }

    /**
     * @param string|array $abbreviations
     * @return boolean
     */
    public static function isCryptoNewsCategory($abbreviations)
    {
        if (!isset($abbreviations)) {
            return false;
        }
        if (is_string($abbreviations)) {
            $abbreviations = [$abbreviations];
        }
        if (!is_array($abbreviations)) {
            return false;
        }
        return (bool) count(array_filter($abbreviations, function ($abbreviation) {
            return in_array($abbreviation, self::CRYPTO_CATEGORIES_CODES, true);
        }));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(__CLASS__);
    }

    /**
     * @param $query
     * @param $abbrArray
     * @return array
     */
    public function scopeIdsByAbbr($query, $abbrArray)
    {
        if(!is_array($abbrArray)){
            return [];
        }
        return $query->whereIn('abbreviation', $abbrArray)->pluck('id');
    }
    /**
     * @param $modulesIds
     * @return mixed
     */
    public function getByModulesIds($modulesIds)
    {
        if (count($modulesIds) === 0) {
            return [];
        }
        return \DB::table('module_category as mc')
            ->select('mc.module_id', 'mc.category_id', 'c.abbreviation')
            ->join($this->getTable() . ' as c', 'c.id', '=', 'mc.category_id')
            ->whereIn('mc.module_id', $modulesIds)->get();
    }

    /**
     * Scope results for specific subscriptions. Hierarchy applies.
     *
     * @param $query
     * @param $subscription_id
     * @return mixed
     * @throws \Exception
     * @internal param $subscription
     */
    public function scopeSubscriptions($query, $subscription_id)
    {
        if (!Auth::user()->hasRole('admin')) {
            $subscription = Auth::user()->getSubscription();
            if (!$subscription) {
                throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => $subscription_id]));
            }
            $subscription_id = $subscription->id;
        }
        return $query->whereIn('subscription_id', Subscription::getSubscriptionsHierarchyById($subscription_id));
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_category', 'category_id', 'module_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'category_keyword', 'category_id', 'keyword_id');
    }

    /**
     * @param $keywords
     * @param bool $sync
     * @return array|bool
     */
    public function assignKeywords($keywords, $sync = false)
    {
        if ($sync) {
            return $this->keywords()->sync($keywords);
        }
        $this->keywords()->attach($keywords);
        return true;
    }

    /**
     * Get the subscription that owns the category.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
