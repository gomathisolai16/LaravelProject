<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 23.05.2017
 * Time: 02:25
 */

namespace App\Services;

use App\Models\Ticker;
use App\Schemes\Models\ICachable;
use App\Schemes\Models\IOrderable;
use App\Schemes\Models\IOwnerOrAdmin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelFilterService
 * @package App\Services
 */
class ModelService
{
    /**
     * @var Model $model
     */
    public static $model;

    /**
     * @param Builder $statement
     * @return int
     */
    public static function total($statement)
    {
        return self::$model instanceof ICachable ? self::$model->getCount($statement) : $statement->count();
    }

    /**
     * @param $statement
     * @return mixed
     */
    public static function getResults($statement)
    {
        return self::$model instanceof ICachable
            ? self::$model->getAll($statement)
            : $statement->get();
    }

    /**
     * Will remove cached data on create|update|delete actions
     * @return void
     */
    public static function removeCacheIfExists()
    {
        if(self::$model instanceof ICachable){
            self::$model->forgetAll();
        }
    }

    /**
     * @param Model $model
     * @return Model
     * @throws \Exception
     */
    public static function applyFields($model)
    {
        self::__prepare($model);

        $request = request();

        if ($request->filled('fields')) {

            if ($request->filled('with')) {
                throw new \Exception("You can not use 'fields' filter and 'with' filter together");
            }

            $fields = explode('|', $request->get('fields'));
            foreach ($fields as $field) {
                if (!in_array($field, self::$model->getFillable())) {
                    throw new \Exception("Field $field dose not exists or not selectable");
                }
            }
            $model = $model->select($fields);
        }

        return $model;
    }

    /**
     * @param Model $model
     * @param bool $checkOwner
     * @return Model
     * @throws \Exception
     */
    public static function applyFilters($model, $checkOwner = true)
    {
        self::__prepare($model);

        $request = request();

        $byLastNews = false;
        if ($request->filled('filters')) {

            $filters = explode('|', $request->get('filters'));
            if (in_array('bylastnews', $filters)) {
                $byLastNews = true;
            }
            foreach ($filters as $filter) {
                $params = explode(':', $filter);
                $filter = $params[0];
                if (!method_exists(self::$model, 'scope' . ucfirst($filter))) {
                    throw new \Exception("Filter $filter not found");
                }
                $value = @$params[1];
                if ($value && strpos($value, ",") !== false) {
                    $value = explode(',', $value);
                }
                $model = $model->{$filter}(@$value);
            }
        }
        if (static::$model instanceof Ticker && !$byLastNews) {
            $model = $model->orderBy('id','desc');
        }

        if (static::$model instanceof IOwnerOrAdmin && $checkOwner) {
            $model = $model->owner();
        }


        return $model;
    }

    /**
     * @param $model
     * @return mixed
     * @throws \Exception
     */
    public static function applyAdditionalFilters($model)
    {
        self::__prepare($model);

        if (static::$model instanceof IOrderable) {
            $request = request();
            $order = 'desc';
            if ($request->filled('order')) {
                $order = $request->get('order');
            }

            if ($order !== 'asc' && $order !== 'desc') {
                throw new \Exception(trans('exception.notAllowedOrderType'));
            }
            $model = $model->orderBy($model->getOrderField(), $order);
        }

        return $model;
    }

    /**
     * @param Model $model
     * @return Model
     * @throws \Exception
     */
    public static function applyRelations($model)
    {
        self::__prepare($model);

        $request = request();

        if ($request->filled('with')) {
            $relations = explode('|', $request->get('with'));
            foreach ($relations as $relation) {
                if (!method_exists(self::$model, $relation)) {
                    throw new \Exception("Relation $relation not found.");
                }
            }
           if (in_array('tickers', $relations)) {
                foreach ($relations as $key => $item) {
                    if ($item == 'tickers') {
                        unset($relations[$key]);
                    }
                }
               $model = $model->with(['tickers' => function ($query) {
                   return $query->orderBy('id','DESC');
               }]);
               $model = $model->with($relations);
            } else {
                $model = $model->with($relations);
            }

        }

        return $model;
    }

    /**
     * We need to keep static model to be able for model methods checking above
     * @param Model $model
     * @return void
     */
    private static function __prepare($model)
    {
        if (!self::$model) {
            self::$model = $model;
        }
    }
}