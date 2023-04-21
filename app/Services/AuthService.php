<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 14.07.2017
 * Time: 21:54
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    const URL = '';
    const SALT = '';
    const ENCRYPTION_KEY = 'F#$';

    /**
     *
     * API access user id and password
     *
     * @var array $apiKeys
     */
    private static $_apiKeys = [
        'loginid' => '$',
        'loginpword' => '',
    ];

    /**
     *
     * Credentials for test users
     *
     * @var array $_testUsers
     */
    private static $_testUsers = [
        [
            'uname' => '',
            'pword' => 'spic',
        ],
        [
            'uname' => '',
            'pword' => '',
        ]
    ];
    /**
     * @var array $_postString
     */
    private $_postString;
    /**
     * @var int $_fieldsCount
     */
    private $_fieldsCount;

    /**
     * @param string $username
     * @param string $password
     * @return AuthService
     */
    public function apiAuth($username, $password)
    {
        $user = [
            'uname' => $username,
            'pword' => $password,
        ];
        $this->_postString = '';
        $this->_fieldsCount = 0;

        error_reporting(E_WARNING);
        foreach ($user as $key => $value) {
            $iv = substr(hash('sha256', "!$!"), 0, 16);
            $this->_postString .= $key . '=' . urlencode(openssl_encrypt($value, "AES-256-CBC", AuthService::ENCRYPTION_KEY.AuthService::SALT, 0, $iv)) . '&';
            $this->_fieldsCount++;
        }

        foreach (self::$_apiKeys as $key => $value) {
            $this->_postString .= $key . '=' . urlencode($value) . '&';
            $this->_fieldsCount++;
        }

        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getResult()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, AuthService::URL);
        curl_setopt($ch, CURLOPT_POST, $this->_fieldsCount);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $file = fopen("dump.txt",'wb');
        curl_setopt($ch, CURLOPT_STDERR, $file);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $responseJSON = curl_exec($ch);

        if(!$responseJSON){
            throw new UnauthorizedException(trans('auth.failed'));
        }

        $responseArray = json_decode($responseJSON, true);

        if(isset($responseArray['result']) && is_array($responseArray['result'])){
            $responseArray['result']['options'] = [
                'from_api' => 'self_api'
            ];
        }
        return $responseArray;
    }

    /**
     * @return boolean
     */
    public static function isTokenExpired()
    {
        $user = Auth::guard()->user();
        if (!$user) {
            return true;
        }
        $token = $user->token();

        if (Carbon::parse($token->updated_at)->diffInHours(Carbon::now()) > 24) {
            $token->delete();
            return true;
        }

        if(!Cache::has('token_exists_'. $user->id))
        {
            DB::table('oauth_access_tokens')->where('user_id', $user->id)->update([
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            Cache::put('token_exists_'. $user->id, true, 1200);
        }

        return false;
    }
}