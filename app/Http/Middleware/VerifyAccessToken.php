<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 16.07.2017
 * Time: 19:06
 */

namespace App\Http\Middleware;

use App\Services\AuthService;
use Illuminate\Validation\UnauthorizedException;

/**
 * Class VerifyAccessToken
 * @package App\Http\Middleware
 */
class VerifyAccessToken
{
    /**
     * @param $request
     * @param \Closure $next
     * @param null $guard
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        // This action will check is token expired or not
        // if it is expired then token will be revoked and function will return false
        // if it is not expired then token expire time will be updated by defined minutes
        if(AuthService::isTokenExpired()){
            throw new UnauthorizedException('Access token expired.');
        }
        return $next($request);
    }
}