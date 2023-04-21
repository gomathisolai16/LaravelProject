<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 09.06.2017
 */

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 *
 * Use this object methods if you want to throw exception
 *
 * Class RoleService
 * @package App\Services
 */
class RoleService
{
    /**
     * @param array|string $roles
     * @param boolean $shouldHaveAll
     * @param  boolean $throw
     * @throws \Exception
     * @return bool
     */
    public static function checkRoles($roles, $shouldHaveAll = false, $throw = true)
    {
        $can = Cache::remember('user_roles_' . Auth::id(), config('cache.time'), function () use ($roles, $shouldHaveAll) {
            return Auth::user()->hasRole($roles, $shouldHaveAll);
        });

        if (!$can && $throw) {
            throw new \Exception(trans('exception.access.permission'));
        }

        return $can;
    }

    /**
     * @param array|string $permissions
     * @param boolean $shouldHaveAll
     * @throws \Exception
     */
    public static function checkPermissions($permissions, $shouldHaveAll = false)
    {
        $can = Cache::remember('user_permissions_' . Auth::id(), config('cache.time'), function () use ($permissions, $shouldHaveAll) {
            return Auth::user()->can($permissions, $shouldHaveAll);
        });

        if (!$can) {
            throw new \Exception(trans('exception.access.permission'));
        }
    }
}