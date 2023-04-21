<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 22.05.2017
 * Time: 23:40
 */

namespace App\Additional\Models;

use App\Models\User;

/**
 * Class Authorable
 * @package App\Additional
 */
trait Authorable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}