<?php
/**
 * Created by IntelliJ IDEA.
 * User: Var Yan
 * Date: 15.01.2018
 * Time: 12:39
 */

namespace App\Schemes\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface ICachable
 * @package App\Schemes\Models
 */
interface ICachable
{
    /**
     * @param Builder $statement
     * @return int
     */
    public function getCount($statement);

    /**
     * @param Builder $statement
     * @return array|null
     */
    public function getAll($statement);

    /**
     * @param Builder $statement
     * @param int $id
     * @return object|null
     */
    public function getOne($statement, $id);

    /**
     * @return void
     */
    public function forgetAll();
}