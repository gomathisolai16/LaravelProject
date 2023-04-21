<?php

namespace App\Models;

use App\Additional\Models\HasApiTokens;
use App\Additional\Models\WatchList;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, EntrustUserTrait, WatchList;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'status', 'options'
    ];

    /**
     * The statuses that are used for deactivated user.
     *
     * @var array
     */
    public static $_userDeactivatedStatuses = ['canceled', 'suspended', 'trial-incomplete'];

    /**
     * The statuses that are used for all user.
     *
     * @var array
     */
    public static $_userStatuses = ['trial','demo','regular','canceled','suspended','trial-incomplete'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *
     * Options filed from users table
     * content of field should be json
     * we will keep here some additional information (like from witch API, url, etc...) for each user
     *
     * @return \stdClass
     */
    public function getOptions(){
        return json_decode($this->options);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getOption($key){
        $options = $this->getOptions();
        if(is_object($options) && property_exists($options, $key)){
            return $options->{$key};
        }

        return null;
    }

    /**
     * @param array $options
     */
    public function setOptions($options){
        $this->options = json_encode($options);
    }

    /**
     * @return string
     */
    public function fullName(){
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dashboards(){
        $subscription = $this->getSubscription();
        if ($subscription && $subscription != null) {
            return $this->hasMany(Dashboard::class)
                ->where('dashboards.subscription_id','=', $subscription->id)->orWhere('dashboards.subscription_id',null);
        } else {
            return $this->hasMany(Dashboard::class);
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings(){
        return $this->hasMany(Setting::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activeDashboards()
    {
        return $this->belongsToMany(Dashboard::class, 'user_dashboard', 'user_id', 'dashboard_id');
    }

    /**
     * @param $id
     * @param bool $attach
     */
    public function updateDashboardList($id, $attach = false){
        if ($attach) {
            $this->activeDashboards()->attach($id);
        } else {
            $this->activeDashboards()->detach($id);
        }
    }

    /**
     * Remove active dashboards that are presets and don't belong to the subscription level that the user currently is.
     */
    public function filterActiveDashboards()
    {
        $subscription = $this->getSubscription();
        $activeDashboards = $this->activeDashboards;
        $filteredDashboards = $activeDashboards;
        if (!$this->hasRole('admin') &&  $subscription !== null) {
            $removeDashboards = [];
            $filteredDashboards = [];
            foreach ($activeDashboards as $dash) {
                if (($dash->preset == false && $dash->subscription_id == null) || $dash->subscription_id == $subscription->id) {
                    $filteredDashboards[] = $dash;
                }
                elseif (($dash->preset == true && $dash->subscription_id == null) || $dash->subscription_id != $subscription->id) {
                    $removeDashboards[] = $dash->id;
                }
            }
            if (count($removeDashboards) > 0) {
                $this->updateDashboardList($removeDashboards, false);
            }
        }
        return $filteredDashboards;
    }
    /**
     * @param $query
     * @param $count
     */
    public function scopeLastInserted($query,$count){
        return $query->limit($count)->orderBy('id','desc');
    }

    /**
     * Gets latest news sent for email alerts
     *
     * @return mixed
     */
    public function getLatestNewsSentId()
    {
       $setting = Setting::where(['key' => 'email_alert_watchlist_last_news_id', 'user_id' => $this->id])->first();
       if (!$setting) {
           return null;
       }
       return $setting->value;
    }

    /**
     * Update latest news sent to the user for email alerts
     *
     * @param $newsId
     */
    public function updateLatestNewsSent($newsId)
    {
        $setting = Setting::where(['key' => 'email_alert_watchlist_last_news_id', 'user_id' => $this->id])->first();
        if (!$setting || $setting == null) {
            $setting = new Setting();
            $setting->user_id = $this->id;
            $setting->key = 'email_alert_watchlist_last_news_id';
            $setting->title = 'Email Alerts Last Tracked News Id';
            $setting->value = $newsId;
            $setting->save();
        } else {
            $setting->value = $newsId;
            $setting->save();
        }
    }

    /**
     * @param string $userId
     * @return Subscription
     */
    public function getSubscription($userId = null)
    {
        $subscriptions = Setting::where(['user_id' => $userId ?? $this->id, 'key' => 'subscriptions'])->first();
        $subscriptionObject = json_decode($subscriptions->value);

        if(!$subscriptionObject || empty($subscriptionObject->abbreviations)){
            return null;
        }

        return Subscription::where('abbreviation', $subscriptionObject->abbreviations[0])->first();
    }
    /**
     * Gets the category IDs depending on the level of subscription for the user.
     *
     * @return array
     */
    public function getCategoriesBySubscription() {
        $subscription = $this->getSubscription();
        $subscriptionsIds = Subscription::getSubscriptionsHierarchyBySubscription($subscription);
        $categories = DB::table('categories')
            ->whereIn('subscription_id', $subscriptionsIds)
            ->orWhere('subscription_id', null)
            ->select('id')
            ->get();
        $categoryIds = [];
        foreach($categories as $cat) {
            $categoryIds[] = $cat->id;
        }
        return $categoryIds;
    }

    /**
     * Gets category ids checks if the categories that the user has permission to see are different from the ones
     * we get from the request, if yes, it removes that category id from the categories list.
     *
     * @param $categories
     * @param null $user
     * @return mixed
     */
    public function filterCategoriesBySubscription($categories, $user = null) {
        if ($user == null) {
            $user = Auth::user();
        }
        if (!$user->hasRole('admin')) {
            $userCategoryIDs = $this->getCategoriesBySubscription();
            $diff = array_diff($categories, $userCategoryIDs);
            if(count($diff) > 0) {
                foreach ($diff as $r) {
                    if (($key = array_search($r, $categories)) !== false) {
                        unset($categories[$key]);
                    }
                }
            }
        }
        return $categories;
    }
}
