<?php

namespace App\Models;

use App\Additional\Models\ActivePassive;
use App\Additional\Models\Authorable;
use App\Additional\Models\Cachable;
use App\Additional\Models\Orderable;
use App\Additional\Models\OwnerOrAdmin;
use App\Additional\Models\PublicOrPrivate;
use App\Schemes\Models\ICachable;
use App\Schemes\Models\IOrderable;
use App\Schemes\Models\IOwnerOrAdmin;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Dashboard
 * @package App\Models
 */
class Dashboard extends Model implements IOwnerOrAdmin, IOrderable, ICachable
{
    const PRESET_ACTIVE = 1;
    const PRESET_DISABLED = 0;
    use ActivePassive,
        Orderable,
        Cachable,
        OwnerOrAdmin,
        PublicOrPrivate,
        Authorable;
    /**
     * @var string $_orderField
     */
    protected $_orderField = 'created_at';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name','abbreviation', 'user_id', 'public', 'preset', 'active','subscription_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class,'module_dashboard')
            ->withPivot(['pos_x','pos_y','width','height']);
    }

    /**
     * @param $module_id
     * @param $options
     */
    public function attachModule($module_id, $options)
    {
        $this->modules()->attach([$module_id => $options]);
    }

    /**
     * @param $modules
     * @param bool $sync
     * @return array|bool
     */
    public function assignModules($modules, $sync = false)
    {
        if ($sync) {
            return $this->modules()->sync($modules);
        }
        $this->modules()->attach($modules);
        return true;
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
     * Scope a query to only include dashboards for specific subscriptions
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
        $subscription = Subscription::find($subscription_id);
        if (!$subscription) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'subscription', 'id' => $subscription_id]));
        }
        return $query->where('subscription_id', $subscription_id);
    }

    /**
     * Get personal dashboards for user.
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
     * @param $module_id
     * @return int
     */
    public function detachModule($module_id)
    {
      return $this->modules()->detach($module_id);
    }

    /**
     * @param int $user_id
     * @param string $name
     * @return boolean
     */
    public function isUnique($user_id, $name){
        if($this->where([
            'user_id' => $user_id,
            'name' => $name
        ])->first()){
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_dashboard', 'dashboard_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * @param $dashboardId
     * @return mixed
     */
    public function getModulesWithCategories($dashboardId){
        return \DB::table('module_dashboard as md')
            ->select('md.module_id', 'mc.category_id')
            ->where('md.dashboard_id', '=', $dashboardId)
            ->leftJoin('module_category as mc', 'md.module_id', '=', 'mc.module_id')
            ->orderBy('mc.category_id')->get();
    }

    /**
     * @param $query
     * @param $dashboardId
     * @return mixed
     */
    public function scopeNews($query, $dashboardId)
    {
        $this->_orderField = 'n.release_date';
        $prefix = \DB::getTablePrefix();
        return $query
            ->distinct()
            ->select(
                \DB::raw('SQL_CALC_FOUND_ROWS '.$prefix.'n.id'),
                'n.*',
                'md.module_id as module_id',
                \DB::raw('(CASE
                    WHEN '.$prefix.'unp.`new_id`  IS NULL THEN 0
                ELSE 1 END) AS parked'),
                'i.id as image_id',
                'i.path as image_path',
                'i.title as image_title'
            )
            ->where($this->getTable() . '.id', '=', $dashboardId)
            ->join('module_dashboard as md', 'md.dashboard_id', '=', 'id')
            ->join('module_category as mc', 'mc.module_id', '=', 'md.module_id')
            ->join('new_category as nc', 'nc.category_id', '=', 'mc.category_id')
            ->join('news as n', 'n.id', '=', 'nc.new_id')
            ->leftJoin('new_image as ni', 'n.id', '=', 'ni.new_id')
            ->leftJoin('images as i', 'i.id', '=', 'ni.image_id')
            ->leftJoin('user_new_parked as unp', 'unp.new_id', '=', 'n.id');
    }

}
