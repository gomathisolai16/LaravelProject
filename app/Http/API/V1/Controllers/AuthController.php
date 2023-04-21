<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 20.05.2017
 * Time: 02:28
 */

namespace App\Http\API\V1\Controllers;

use App\Events\GenerateUserToken;
use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var array $_content
     */
    protected $_content = [];

    /**
     * @param Request $request
     * @param AuthService $authService
     * @param ResponseService $responseService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function login(Request $request, AuthService $authService, ResponseService $responseService)
    {
        $this->_validateLogin($request);

        $password = $request->get('password');
        $username = $request->get('username');

        DB::beginTransaction();
        try{
            if (($user = UserService::userExists($username))) {

                if($user->getOption('from_api') === 'self_api'){
                    $authService->apiAuth($username, $password);
                    $response = $authService->getResult();

                    if($response['error'] == 703){
                        throw new UnauthorizedException(trans('auth.failed'));
                    }

                    if ($response['error'] != 0) {
                        throw new UnauthorizedException($response['result']);
                    }
                    if (!is_array($response['result']['subtype'])) {
                        $subscription = Subscription::where('abbreviation',$response['result']['subtype'])->first();
                        if (!$subscription) {
                            throw new UnauthorizedException(trans('auth.subscription-error'));
                        }
                    } else {
                        $subscription = Subscription::where('abbreviation',$response['result']['subtype'][0])->first();
                        if (!$subscription) {
                            throw new UnauthorizedException(trans('auth.subscription-error'));
                        }
                    }
                    UserService::resetExistingUserPassword($username,$password);
                    Auth::guard()->attempt(['username'=>$username,'password' => $password]);

                    if ($this->_userInfoChanged(Auth::user(), $response['result'])) {
                        UserService::updateUserInformation(Auth::user(), array_merge($response['result'], [
                            'username' => $username,
                        ]));
                    }
                }else{
                    Auth::guard()->attempt(['username'=>$username,'password' => $password]);
                }

            } else {
                $authService->apiAuth($username, $password);
                $response = $authService->getResult();

                if($response['error'] == 703){
                    throw new UnauthorizedException(trans('auth.failed'));
                }

                if ($response['error'] != 0) {
                    throw new UnauthorizedException($response['result']);
                }
                if (!is_array($response['result']['subtype'])) {
                    $subscription = Subscription::where('abbreviation',$response['result']['subtype'])->first();
                    if (!$subscription) {
                        throw new UnauthorizedException(trans('auth.subscription-error'));
                    }
                } else {
                    $subscription = Subscription::where('abbreviation',$response['result']['subtype'][0])->first();
                    if (!$subscription) {
                        throw new UnauthorizedException(trans('auth.subscription-error'));
                    }
                }
                if (!empty($response['result']['status']) && (strtolower($response['result']['status']) == 'canceled' || strtolower($response['result']['status']) == 'suspended')
                || strtolower($response['result']['status']) == 'trial-incomplete') {
                    $status = $response['result']['status'];
                    $deactivatedUser = User::where('username', '=', $username)->first();
                    if ($deactivatedUser !== null) {
                        $deactivatedUser->status = $status;
                        $deactivatedUser->save();
                    }
                    throw new UnauthorizedException(trans("message.status.$status"));
                }

                $success = UserService::saveRemoteUserIfNotExists(array_merge($response['result'], [
                    'username' => $username,
                    'password' => bcrypt($password)
                ]));

                $credentials = ['username' => $username, 'password' => $password];

                if (!$success || !Auth::guard()->attempt($credentials)) {
                    throw new UnauthorizedException(trans('auth.failed'));
                }
                if (is_array($response['result']['subtype'])) {
                    $subscriptions['abbreviations'] = $response['result']['subtype'];
                } else {
                    $subscriptions['abbreviations'] = [$response['result']['subtype']];
                }
                UserService::updateActiveDashboardsForUser(Auth::user(), $subscription->id);
                $status = null;
                if (!empty($response['result']['status'])) {
                    if ($response['result']['status'] == 'trial' || $response['result']['status'] == 'regular' || $response['result']['status'] == 'demo') {
                        $status = 'regular';
                    } else {
                        $status = $response['result']['status'];
                    }
                } else {
                    $status = 'regular';
                }
                event(new UserCreatedEvent(Auth::user(), [
                    'subscriptions' => $subscriptions,
                    'status' => $status
                ]));
            }

            $user = Auth::user();
            $this->_checkUserStatus($user);

            // remove old tokens
            //event(new GenerateUserToken($user));


            // generate new token
            $token = $user->createToken($user->first_name)->accessToken;



        }catch (\Exception $e){
            // transaction failed rollback all queries
            DB::rollBack();
            throw $e;
        }

        // transaction success commit
        DB::commit();
        return $responseService
            ->single($token, 'token');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return response()->json(['success' => true]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tokenStatus()
    {
        $isExpired = AuthService::isTokenExpired();

        return response()->json([
            "success" => $isExpired,
            "message" => $isExpired ? "Access token expired." : "Access token is valid."
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function _validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:60|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     */
    public function _userInfoChanged($user, $data) {
        $infoChanged = false;
        if ($user->email !== $data['email']  || $user->username !== $data['username'] || $user->first_name !== $data['fname'] ||
            $user->last_name !== $data['lname'] || $user->status !== $data['status']) {
            $infoChanged = true;
        }
        if (!$infoChanged) {
            $subscriptions = Setting::where(['user_id' => $user->id, 'key' => 'subscriptions'])->first();
            $subScriptionArray = json_decode($subscriptions->value);
            if (!is_array($data['subtype'])) {
                $data['subtype'] = [$data['subtype']];
            }
            if (count($data['subtype']) != count($subScriptionArray->abbreviations) || array_diff($data['subtype'], $subScriptionArray->abbreviations)) {
                $infoChanged = true;
            }
        }

        return $infoChanged;
    }
    /**
     * @throws UnauthorizedException
     * @param User $user
     * @return void
     */
    protected function _checkUserStatus($user)
    {
        $statuses = ['canceled','suspended'];

        if(!$user){
            throw new UnauthorizedException('User not found.');
        }

        $status = $user->status;
        if(in_array($status,$statuses,true)){
            throw new UnauthorizedException(trans("message.status.$status"));
        }

        // get timezone offset from frontend
        if(request()->filled('tz')){
            $offset = request()->get('tz') . ':00';
            // get hours minutes from string
            list($hours, $minutes) = explode(':', $offset);
            $seconds = $hours * 60 * 60 + $minutes * 60;
            // Get timezone name from seconds
            $tz = timezone_name_from_abbr('', $seconds, FALSE);
        }

        // if timezone not founded then set it to default UTC
        if(empty($tz)){
            $tz = 'UTC';
        }
        $user->timezone = $tz;
        $user->save();
    }
}