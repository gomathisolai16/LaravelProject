<?php

namespace App\Models;

use Log;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    const SUBSCRIPTION_MAPPING = [
        'mtx' => ['mtx'],
        'pro' => ['pro', 'mtx'],
        'pro_gm' => ['pro_gm', 'pro', 'mtx'],
        'pro_na_vids' => ['pro_na_vids', 'pro', 'mtx'],
        'pro_gm_vids' => ['pro_gm_vids', 'pro_na_vids', 'pro_gm', 'pro', 'mtx']
    ];
    /**
     * @var array
     */
    protected $fillable = [
        'abbreviation', 'title',
    ];


    /**
     * Get the category that owns the phone.
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Get collection of subscriptions hierarchy to provide for news and categories access by ID
     * 
     * @param string $id
     * @return array
     */
    public static function getSubscriptionsHierarchyById($id)
    {
        return self::getSubscriptionsHierarchyBySubscription(self::find($id));
    }

    /**
     * Get collection of subscriptions hierarchy to provide for news and categories access
     * 
     * @param \App\Models\Subscription $subscription
     * @return array
     */
    public static function getSubscriptionsHierarchyBySubscription($subscription)
    {
        if (!isset($subscription)) {
            return [];
        }
        if (!isset(self::SUBSCRIPTION_MAPPING[$subscription->abbreviation])) {
            Log::warning('Subscription mapping for "' . $subscription->abbreviation . '" not found, will return only related record ID');
            return $subscription ? [$subscription->id] : [];
        }
        return array_map(function($record) {
            return $record['id'];
        }, self::whereIn('abbreviation', self::SUBSCRIPTION_MAPPING[$subscription->abbreviation])->get()->toArray());
    }

    /**
     * Check if subscription is part of one of the known video's subscriptions through subscription record
     * 
     * @param App\Models\Subscription $subscription
     * @return boolean
     */
    public static function hasSubscriptionsHierarchyVideoRelatedSubscription($subscription)
    {
        if (!isset($subscription)) {
            return false;
        }
        if (isset(self::SUBSCRIPTION_MAPPING[$subscription->abbreviation])) {
            return (bool) count(array_filter(self::SUBSCRIPTION_MAPPING[$subscription->abbreviation], function($abbreviation) {
                return self::hasVideoRelatedSubscriptions($abbreviation);
            }));
        }
        return self::hasVideoRelatedSubscriptions($subscription->abbreviation);
    }

    /**
     * Check if subscription is part of one of the known video's subscriptions
     * 
     * @param array|string $abbreviation
     * @return boolean
     */
    public static function hasVideoRelatedSubscriptions($abbreviation)
    {
        if (!isset($abbreviation)) {
            return false;
        }
        if (is_string($abbreviation)) {
            $abbreviation = [$abbreviation];
        }
        if (!is_array($abbreviation)) {
            return false;
        }
        if (!count($abbreviation)) {
            return false;
        }
        return (bool) count(array_filter($abbreviation, function($item) {
            return in_array($item, ['pro_gm_vids', 'pro_na_vids']);
        }));
    }

    /**
     * Check if module record is assigned to subscription that allows video news being displayed
     * 
     * @param App\Models\Module $module
     * @return boolean
     */
    public static function allowVideoNewsForModule($module)
    {
        if (!isset($module)) {
            return false;
        }
        if (!$module->subscription_id) {
            return false;
        }
        return self::hasSubscriptionsHierarchyVideoRelatedSubscription(self::find($module->subscription_id));
    }
}
