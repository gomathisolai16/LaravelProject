<?php

namespace App\Models;

use App\Additional\Models\ActivePassive;
use App\Additional\Models\Authorable;
use App\Additional\Models\Cachable;
use App\Additional\Models\OwnerOrAdmin;
use App\Additional\Models\PublicOrPrivate;
use App\Additional\Models\Sortable;
use App\Schemes\Models\ICachable;
use App\Schemes\Models\IOwnerOrAdmin;
use App\Services\ModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Module
 * @package App\Http\Api\V1Models
 */
class Module extends Model implements IOwnerOrAdmin, ICachable
{
    const PRESET_ACTIVE = 1;

    use Sortable,
        OwnerOrAdmin,
        Cachable,
        ActivePassive,
        PublicOrPrivate,
        Authorable;

    /**
     * Define sortable columns
     * First key will be primary column will be used by Sortable trait
     *
     * @var array $columns
     */
    protected $_columns = [
        'sort_order' => 'asc'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'abbreviation',
        'public',
        'name',
        'user_id',
        'sort_order',
        'preset',
        'active',
        'subscription_id',
        'watch_list',
        'strict'
    ];

    /**
     * @param int $dashboardId
     */
    public function getByDashboardId($dashboardId)
    {
        return \DB::table($this->getTable() . ' as m')
            ->select('m.id','m.watch_list')
            ->join('module_dashboard as md', 'm.id', '=', 'md.module_id')
            ->where('md.dashboard_id', $dashboardId)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'module_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dashboards()
    {
        return $this->belongsToMany(Dashboard::class, 'module_dashboard', 'module_id', 'dashboard_id')
            ->withPivot(['pos_x','pos_y','width','height']);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Scope a query to only include parked news.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePreset($query, $preset)
    {
        return $query->where('preset', $preset);
    }

    /**
     * Scope a query to only include modules for specific subscriptions
     *
     * @param $query
     * @param $subscription_id
     * @return mixed
     * @throws \Exception
     * @internal param $subscription
     */
    public function scopeSubscriptions($query, $subscription_id)
    {
        ModelService::removeCacheIfExists();
        if (!Auth::user()->hasRole('admin')) {
            $subscription = Auth::user()->getSubscription();
            if (!$subscription) {
                throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => $subscription_id]));
            }
            $subscription_id = $subscription->id;
        }
        $subscription = Subscription::find($subscription_id);
        if (!$subscription) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => $subscription_id]));
        }
        return $query->where('subscription_id', $subscription_id);
    }
    /**
     * Get personal modules for user.
     *
     * @param $query
     * @param $personal
     * @return mixed
     */
    public function scopePersonal($query, $personal)
    {
        if ($personal == 1 && !Auth::user()->hasRole('admin')) {
            return $query->orWhere(function($q){
                $q->where('subscription_id',null)->where('preset',false);
            });
        }
        return $query;
    }
    /**
     * @param int $userId
     * @param string $name
     * @param int $dashboardId
     * @return boolean
     */
    public function isUnique($userId, $name, $dashboardId){
        $count = $this->join('module_dashboard', 'module_id', '=', 'id')->where([
            'dashboard_id' => $dashboardId,
            'name' => $name,
            'user_id' => $userId
        ])->count();

        return $count > 0;
    }

    /**
     * @return mixed
     */
    public function attachNews()
    {
        return News::whereIn('id',function ($query){
            $query->select('new_id')->from('new_category')->whereIn('category_id',function ($sq){
                $sq->select('category_id')->from('module_category')->where('module_id',$this->id);
            });
        });
    }

    /**
     * @param $categories
     * @param bool $sync
     * @return array|bool
     */
    public function assignCategories($categories, $sync = false)
    {
        if ($sync) {
           return $this->categories()->sync($categories);
        }
        $this->categories()->attach($categories);
        return true;
    }

    /**
     * @param $dashboard_id
     * @param $options
     */
    public function addToDashboard($dashboard_id, $options)
    {
        $this->dashboards()->attach([$dashboard_id => $options]);
    }

    /**
     * @param $dashboard_id
     * @param $options
     */
    public function updateInDashboard($dashboard_id, $options)
    {
        $this->dashboards()->syncWithoutDetaching([$dashboard_id => $options]);
    }

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }

    /**
     * Get count of video categories assigned to module
     * 
     * @return int
     */
    public function getVideoCategoriesCount($categories = [])
    {
        return count(array_filter($categories, function($category) {
            return in_array($category['abbreviation'], Category::VIDEO_CATEGORIES_CODES, true);
        }));
    }
}
