<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 05.07.2017
 * Time: 12:10
 */

namespace App\Services;

use App\Http\API\V1\Requests\UserRequest;
use App\Models\Dashboard;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @param string $item
     * @param boolean $useUnion
     * @return array|null
     */
    public static function getUserItem($item, $useUnion)
    {
        $result = Cache::remember('user_' . $item . '_' . Auth::id(), config('cache.time'), function () use ($item, $useUnion) {
            $result = Auth::user()->{$item}();

            if ($useUnion) {
                $result = $result->union(
                    App::make('App\Models\\' . ucfirst(
                            substr($item, 0, -1))
                    )->owner());
            }

            return $result->get();
        });

        return $result;
    }

    /**
     * @param $user
     * @throws \Exception
     */
    public static function validate($user)
    {
        $validator = \Validator::make($user, (new UserRequest())->rules());

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    /**
     * @param string $username
     * @return \App\Models\User User
     */
    public static function userExists($username)
    {
        return User::where('username', $username)->first();
    }

    /**
     * Function to activate all preset dashboards that have the same subscription
     * level as the logged in user.
     *
     * @param $user
     * @param $subscription_id
     */
    public static function updateActiveDashboardsForUser($user, $subscription_id)
    {
        $dashboards = Dashboard::where('subscription_id', $subscription_id)->where('preset', true)->get();
        $dashboardIds = [];
        if (count($dashboards) > 0) {
            foreach ($dashboards as $dash) {
                $dashboardIds[] = $dash->id;
            }
        }
        if (count($dashboardIds)) {
            $user->updateDashboardList($dashboardIds, true);
        }
    }

    /**
     * @param array $user
     * @return boolean
     */
    public static function saveRemoteUserIfNotExists($user)
    {
        if (static::userExists($user['username'])) {
            return true;
        }

        $createUser = new User();
        $createUser->email = $user['email'];
        $createUser->username = $user['username'];
        $createUser->setOptions($user['options']);
        $createUser->first_name = $user['fname'];
        $createUser->last_name = $user['lname'];
        $createUser->status = $user['status'];
        $createUser->password = $user['password'];

        return $createUser->save();
    }

    /**
     * @param string $username
     * @param $password
     */
    public static function resetExistingUserPassword($username, $password)
    {
        $user = User::where('username', '=', $username)->first();
        $user->password = bcrypt($password);
        $user->save();
    }

    /**
     * @param $currentUser
     * @param $data
     * @return mixed
     */
    public static function updateUserInformation($currentUser, $data)
    {
        $subscriptions = Setting::where(['user_id' => $currentUser->id, 'key' => 'subscriptions'])->first();
        $subScriptionArray = json_decode($subscriptions->value);
        if (!is_array($data['subtype'])) {
            $data['subtype'] = [$data['subtype']];
        }
        if (count($data['subtype']) != count($subScriptionArray->abbreviations) || array_diff($data['subtype'], $subScriptionArray->abbreviations)) {
            $newSubscriptions['abbreviations'] = $data['subtype'];
            $subscriptions->value = json_encode($newSubscriptions);
            $subscriptions->save();
        }

        $currentUser->email = $data['email'];
        $currentUser->username = $data['username'];
        $currentUser->first_name = $data['fname'];
        $currentUser->last_name = $data['lname'];
        $currentUser->status = $data['status'];

        return $currentUser->save();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getUser()
    {
        static $user;
        if (!$user) {
            $user = Auth::user();
        }

        return $user;
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function resolveData($user)
    {   
        $now = Carbon::now()->toDateTimeString();
        $user['password'] = bcrypt($user['password']);
        $user['created_at'] = $now;
        $user['updated_at'] = $now;
        return $user;
    }

    public static function sendEmailsToSubscribers()
    {
        // TODO write logic to send email to subscribers.
    }
}