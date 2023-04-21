<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 13.08.2017
 * Time: 08:54
 */

namespace App\Additional\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Trait CommonFilters
 * @package App\Additional\Models
 */
trait CommonFilters
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateFrom($query, $date)
    {
        $date = Carbon::createFromTimestamp($date / 1000, Auth::guard('api')->user()->timezone)->toDateTimeString();
        return $query->where('created_at', '>', $date);
    }

    /**
     * @return int
     */
    public function total()
    {
        $result = \DB::select('SELECT FOUND_ROWS() as total');

        if(count($result) && isset($result[0]->total)){
            return $result[0]->total;
        }

        if (method_exists($this, 'count')){
            return $this->count();
        }

        return 0;
    }

}