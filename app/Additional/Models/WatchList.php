<?php
/**
 * Created by PhpStorm.
 * User: edi-r
 * Date: 6/14/2017
 * Time: 12:39 PM
 */

namespace App\Additional\Models;


use Illuminate\Support\Facades\DB;

trait WatchList
{
    /**
     * @param bool $toArray
     * @return mixed
     */
    public function tickers($watchListId, $toArray = false)
    {
        $query = DB::table('user_ticker')
            ->where('user_id', $this->id)
            ->where('watch_list_id', $watchListId)
            ->get();
        if ($toArray) {
            return $query->toArray();
        }
        return $query;
    }


    /**
     * @return array
     */
    public function watchListItems($watchListId)
    {
        $result = [];
        $result['tickers'] = $this->tickers($watchListId, true);
        return $result;
    }


    /**
     * Get watch list item ids so we can use them to get latest news for watch list in email alert functions
     * @todo add static cache to not make several requests to DB in method was executed several times in one request
     *
     * @return mixed
     */
    public function watchListItemsIds($watchListId)
    {
        $watchListItems = $this->watchListItems($watchListId);
        $tickers = [];
        foreach ($watchListItems['tickers'] as $ticker) {
            $tickers[] = $ticker->ticker_id;
        }
        $result['tickers'] = $tickers;
        return $result;
    }

    public function getWatchListItem($id, $watchListId)
    {
        return DB::table('user_ticker')
            ->where('id', $id)
            ->where('watch_list_id', $watchListId)
            ->first();
    }

    /**
     * @param $tickers
     * @return mixed
     */
    public function tickersExist($tickers, $watchListId)
    {
        return DB::table('user_ticker')
            ->where('user_id', $this->id)
            ->where('watch_list_id', $watchListId)
            ->whereIn('id', $tickers)->get();
    }
}