<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 16.08.2017
 * Time: 22:12
 */

namespace App\Http\API\V1\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Ticker;

/**
 * Class TickerController
 * @package App\Http\API\V1\Controllers
 */
class TickerController extends ApiController
{
    /**
     * Define model name controller will work with
     *
     * @var string $_modelClass
     */
    protected $_modelClass = Ticker::class;
    /**
     * @var string $_for
     */
    protected $_for = 'tickers';
}