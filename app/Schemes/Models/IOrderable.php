<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 15.08.2017
 * Time: 22:23
 */

namespace App\Schemes\Models;

/**
 * Interface IOrderable
 * @package App\Schemes\Models
 */
interface IOrderable
{
    /**
     * @return string
     */
    public function getOrderField();
}