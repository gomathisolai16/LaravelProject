<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 13.08.2017
 * Time: 11:26
 */

namespace App\Additional\Models;

/**
 * Trait Orderable
 * @package App\Additional\Models
 */
trait Orderable
{
    /**
     * @return string
     */
    public function getOrderField()
    {
        if(!property_exists($this, '_orderField')){
            $orderField = ' created_at';
        }else{
            $orderField = $this->_orderField;
        }
        return $orderField;
    }
}