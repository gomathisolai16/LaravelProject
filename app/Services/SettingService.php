<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 21.09.2017
 * Time: 21:46
 */

namespace App\Services;

use App\Models\Dashboard;
use App\Models\Theme;
use App\Models\Setting;

/**
 * Class SettingService
 * @package App\Services
 */
class SettingService
{
    /**
     * @var array $_subscriptions
     */
    private static $_subscriptions = ['mtx', 'pro', 'pro_gm', 'pro_na_vids', 'pro_gm_vids'];

    const ALLOW_MISSING_SETTING_UPDATE = [
        Setting::TIMEZONE_KEY => [
            'title' => Setting::TIMEZONE_LABEL,
            'key' => Setting::TIMEZONE_KEY
        ]
    ];

    /**
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public static function checkAlertsSettings($value)
    {
        $key = 'alerts_settings';
        $periods = ['daily', 'hourly', 'monthly', 'yearly'];
        $value = json_decode($value);

        // if not in JSON format
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException("Value format for key $key should be JSON");
        }

        // if stdClass don't have period property
        if (!property_exists($value, 'period')) {
            throw new \InvalidArgumentException('Parameter {period} missing for settings');
        }

        // if stdClass don't have at property
        if (!property_exists($value, 'at')) {
            throw new \InvalidArgumentException('Parameter {at} missing for settings');
        }

        // if property period not in allowed lists
        if (!in_array($value->period, $periods, true)) {
            throw new \InvalidArgumentException('Parameter {period} should have values ' . implode('|', $periods));
        }

        // cut at property to check correct format
        list($hour, $minutes) = explode(':', $value->at);

        // if hour or minutes is empty
        if (empty($hour) || empty($minutes)) {
            throw new \InvalidArgumentException('Parameter {at} should have format like 5:00|16:30|18:00|2:30');
        }

        $hour = (int)$hour;

        // if hour value is not set correct
        if ($hour < 0 || $hour > 24) {
            throw new \InvalidArgumentException('Hour can not be less then 0 or more then 24');
        }

        if ($minutes !== '00' && $minutes !== '30') {
            throw new \InvalidArgumentException('Allowed values for minutes are 00 or 30');
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public static function checkBooleanSettings($key, $value)
    {
        if ($value !== '0' && $value !== '1') {
            throw new \InvalidArgumentException('Available values for ' . $key . ' setting are 0 or 1');
        }
    }

    /**
     * @param $value
     * @throws \InvalidArgumentException
     */
    public static function checkColorTheme($value)
    {
        $theme = Theme::find($value);
        if (!$theme) {
            throw new \InvalidArgumentException(trans(trans('exception.recordNotFound', ['item' => 'Theme', 'id' => $value])));
        }
    }

    /**
     * @param $value
     * @throws \InvalidArgumentException
     */
    public static function checkActiveDashboard($value)
    {
        $dashboard = Dashboard::find($value);
        if (!$dashboard) {
            throw new \InvalidArgumentException(trans(trans('exception.recordNotFound', ['item' => 'Dashboard', 'id' => $value])));
        }
    }

    /**
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public static function checkFontSize($value){
        $fontSizes = ['small', 'medium', 'large'];
        if (!in_array($value, $fontSizes, true)) {
            throw new \InvalidArgumentException(trans('Available values for  setting are ' . implode(', ', $fontSizes)));
        }
    }

    /**
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public static function checkSubscriptions($value)
    {
        $value = json_decode($value, true);

        // if not in JSON format
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Subscription value should be in JSON format');
        }

        // if parameter abbreviations dos'nt exists then throw exception
        if (empty($value['abbreviations'])) {
            throw new \InvalidArgumentException('abbreviations parameter is required');
        }

        // if parameter abbreviations is not array then throw exception
        if (!is_array($value['abbreviations'])) {
            throw new \InvalidArgumentException('abbreviations parameter should be an array');
        }

        $criteria = [];

        foreach ($value['abbreviations'] as $abbreviation){
            if (in_array($abbreviation, self::$_subscriptions)) {
                $criteria[] = $abbreviation;
            }
        }

        // if categories not found then throw exception
        if (!count($criteria)) {
            throw new \InvalidArgumentException('There are no criteria founded by provided abbreviations');
        }
    }

    /**
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public static function checkInstanceMessageService($value)
    {
        $services = ['ice', 'symphony'];

        if(!in_array($value, $services, true)){
            throw new \InvalidArgumentException('Allowed values for Instance Message Service are ' . implode('|', $services));
        }
    }
    /**
     * @param string $key
     * @return array
     */
    public static function isSettingFieldAllowed($key) {
        /**
         * This method is an workaround to allow missing 'timezone' setting (added recently)
         * to be added if it's not part of user settings records. This will avoid issues for
         * older user accounts that doesn't have this setting and we can avoid running
         * a migration script to populate all the records on user table
         * 
         * We can patch this way all future settings if they will be added
         */
        if (isset(self::ALLOW_MISSING_SETTING_UPDATE[$key])) {
            return self::ALLOW_MISSING_SETTING_UPDATE[$key];
        }
        return null;
    }

    /**
     * Validate if provided settings data match required type of if they exist
     * 
     * @param string $key
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function validateSettingAssignment($key, $value) {
        switch ($key) {
            // check color_theme setting value is correct if not throw exception
            case 'color_theme':
                SettingService::checkColorTheme($value);
                break;
            // check instance_message_service setting value is correct if not throw exception
            case 'instance_message_service':
                SettingService::checkInstanceMessageService($value);
                break;
            // check boolean setting values is correct if not throw exception
            case 'audio_news_alert':
            case 'alerts':
            case 'headlines_only':
                SettingService::checkBooleanSettings($key, $value);
                break;
            case 'subscriptions':
                SettingService::checkSubscriptions($value);
                break;
            // check active_dashboard setting value is correct
            case 'active_dashboard':
                SettingService::checkActiveDashboard($value);
                break;
            // check font_size setting value is correct if not throw exception
            case 'font_size':
                SettingService::checkFontSize($value);
                break;
            case 'email_alert_watchlist_last_news_id':
            case 'timezone':
                break;
            // setting not found seems incorrect request throw an exception
            default:
                throw new \InvalidArgumentException(trans('exception.settingKeyNotFound', ['key' => $key]));
                break;
        }
    }
}
