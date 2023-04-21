<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 23.05.2017
 * Time: 23:59
 */

namespace App\Additional\Models;

use Mockery\Exception;

/**
 * Every Class that used this trait should define property _relationId to avoid exception
 *
 * Class Nestedable
 * @package App\Additional\Models
 */
trait Nestedable
{
    /**
     * Working with category sub category like structure
     * Just pass an array Or Collection object to the method and it will return nested (tree like) array
     *
     * @param array $elements
     * @param int $categoryId
     * @return array
     */
    public function getTree($elements, $categoryId = 0)
    {
        if (!property_exists($this, '_relationId')) {
            throw new Exception(trans('exception.propMissing', ['prop' => 'relationId']));
        }

        if (!is_array($elements)) {
            $elements = $elements->toArray();
        }

        $branch = array();

        foreach ($elements as $element) {
            if ($element[$this->_relationId] == $categoryId) {
                $children = $this->getTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * @param $query
     * @param int|null $id
     * @return mixed
     */
    public function scopeParent($query, $id = null)
    {
        return $query->where($this->_relationId, $id);
    }
}