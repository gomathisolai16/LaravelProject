<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 23.05.2017
 * Time: 04:42
 */

namespace App\Additional\Models;

/**
 * Class ActivePassive
 * @package App\Additional\Models
 */
trait PublicOrPrivate
{
    /**
     * @param $query
     * @param bool $flag
     * @return mixed
     */
    public function scopePublic($query,$flag = true)
    {
        return $query->where('public',$flag);
    }
}