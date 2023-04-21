<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 22.05.2017
 * Time: 15:32
 */

namespace App\Additional\Models;

use Illuminate\Support\Facades\DB;

/**
 * Every Class that used this trait should define property _columns to avoid exception
 *
 * Class Filterable
 * @package App\Additional
 */
trait Sortable
{
    /**
     * @param $query
     * @return mixed
     * @throws \Exception
     */
    public function scopeSorted($query)
    {
        if (!property_exists($this, '_columns')) {
            throw new \Exception(trans('exception.sortColsMissing'));
        }

        foreach ($this->_columns as $column => $order) {
            $query->orderBy($column, $order);
        }
        return $query;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLastBySort($query)
    {
        $pColumn = array_keys($this->_columns)[0];

        return $query->where(
            $pColumn,
            DB::raw(DB::table(with($this)->getTable())->max($pColumn))
        );
    }
}