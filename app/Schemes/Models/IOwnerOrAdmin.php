<?php

namespace App\Schemes\Models;

/**
 * Interface IOwnerOrAdmin
 * @package App\Schemes
 */
interface IOwnerOrAdmin
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeOwner($query);
}