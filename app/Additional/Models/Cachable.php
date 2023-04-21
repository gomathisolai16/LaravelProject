<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 15.01.2018
 * Time: 12:34
 */

namespace App\Additional\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Make model cachable
 *
 * Trait Cachable
 * @package App\Additional\Models
 */
trait Cachable
{
    /**
     * @param Builder $statement
     * @return mixed
     */
    public function getCount($statement)
    {
        $count = Cache::remember($statement->toSql() . '_count_' . Auth::id(), config('cache.time'), function () use ($statement) {
            return $statement->count();
        });

        return $count;
    }

    /**
     * @param $statement
     * @return mixed
     */
    public function getAll($statement)
    {
        $data = Cache::remember($statement->toSql() . '_' . Auth::id(), config('cache.time'), function () use ($statement) {
            return $statement->get();
        });

        return $data;
    }

    /**
     * @param Builder $statement
     * @param $id
     * @return mixed
     */
    public function getOne($statement, $id)
    {
        $data = Cache::remember($statement->toSql() . '_' . $id . '_' . Auth::id(), config('cache.time'), function () use ($statement, $id) {
            return $statement->find($id);
        });

        return $data;
    }

    /**
     * Forget cached list of results
     */
    public function forgetAll()
    {
        Cache::flush();
    }
}