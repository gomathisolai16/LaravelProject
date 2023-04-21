<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 28.05.2017
 * Time: 23:26
 */

namespace App\Services;

/**
 * Class RouteService
 * @package App\Services
 */
class RouteService
{
    /**
     * Specified except actions array for API resource controllers
     *
     * @return array
     */
    public static function optional()
    {
        return [
            'except' => ['create', 'edit']
        ];
    }

    /**
     *
     * Specified except actions array for TickerController
     *
     * @return array
     */
    public static function tickerOptional()
    {
        return [
            'except' => ['create', 'edit', 'destroy', 'store', 'update']
        ];
    }
}