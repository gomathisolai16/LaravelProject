<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 16.01.2018
 * Time: 17:09
 */

namespace App\Models;

/**
 * Class Token
 * @package App\Models
 */
class Token extends \Laravel\Passport\Token
{
    /**
     * Token constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}