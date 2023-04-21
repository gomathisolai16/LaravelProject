<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 05.10.2017
 * Time: 23:00
 */

namespace App\Services;

use App\Models\Category;
use App\Models\Ticker;
use App\Models\User;
use App\Models\UserTicker;

/**
 * Class WatchListService
 * @package App\Services
 */
class WatchListService
{
    /**
     * @param User $user
     * @param $request
     * @return bool
     */
    public static function storeTickers(User $user, $request, $watchListId)
    {
        $tickers = self::_getValidatedData_($request['tickers']);
        $tickersExist = $user->tickersExist($tickers, $watchListId);
        self::_checkItems_($tickersExist, "symbol", "symbols");
        $tickersData = [];
        foreach ($tickers as $ticker) {
            $tic = Ticker::find($ticker);
            if ($tic) {
                $tickersData[] = [
                    'user_id' => $user->id,
                    'ticker_id' => $tic->id,
                    'symbol' => $tic->abbreviation,
                    'watch_list_id' => $watchListId
                ];
            }
        }
        UserTicker::insert($tickersData);
    }

    /**
     * @param $value
     * @return mixed
     */
    private static function _getValidatedData_($value)
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value should be [] format');
        }

        return $value;
    }

    /**
     * @param $result
     * @param $code
     * @param $plural
     * @throws \Exception
     */
    private static function _checkItems_($result, $code, $plural)
    {
        $items = "";
        if (sizeof($result) !== 0) {
            foreach ($result as $index => $item) {
                if ($index == sizeof($result) - 1) {
                    $items .= $item->{$code};
                } else {
                    $items .= $item->{$code} . ",";
                }
            }
            throw new \Exception(trans('message.itemExists', ['itemCode' => sizeof($result) == 1 ? ucfirst($code) : ucfirst($plural), 'item' => $items]));
        }
    }
}