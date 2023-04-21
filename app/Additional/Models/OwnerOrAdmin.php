<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 24.05.2017
 * Time: 02:02
 */

namespace App\Additional\Models;

use App\Services\RoleService;
use Illuminate\Support\Facades\Auth;

/**
 * Class Ownerable
 * @package App\Additional\Models
 */
trait OwnerOrAdmin
{
    /**
     * Use this scope with any model that uses this trait
     * Just add ModelName::owner()
     * The first $query parameter is injectable
     * If you want to do some action for owner and admin only pass parameter to owner method like owner(true)
     *
     * @param $query
     * @param boolean $checkOnlyUser
     * @throws \Exception
     * @return mixed
     */
    public function scopeOwner($query, $checkOnlyUser = false)
    {
        if (!RoleService::checkRoles('admin', false, false)) {
            $query = $query->where('user_id', Auth::guard('api')->id());

            if (!$checkOnlyUser) {
                $query = $query->orWhere(function ($q){
                    $q->where('preset', '=', true)
                        ->where('public', '=', true);
                });
            }
        }
        return $query;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param int|null $userId
     * @return mixed
     */
    public function scopeForUserOnly($query, $userId = null)
    {

        if (is_null($userId)) {
            $userId = Auth::guard('api')->id();
        }

        return $query->where('user_id', $userId);
    }
}