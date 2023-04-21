<?php
/**
 * Created by PhpStorm.
 * User: Var Yan
 * Date: 28.06.2017
 * Time: 16:02
 */

namespace App\Services;

use App\Http\API\V1\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Ticker;
use Carbon\Carbon;
use Log;

/**
 * Class NewsService
 * @package App\Services
 */
class NewsService
{
    /**
     * @param array $abbrArray
     * @param int $newID
     * @return array
     */
    public static function getTickersByAbbrToInsert($abbrArray, $newID)
    {
        $tickers = [];

        foreach ($abbrArray as $value) {

            if (!Ticker::where('abbreviation', '=', $value)->first()) {
                Ticker::create([
                    'abbreviation' => $value,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        }

        $ticIds = Ticker::idsByAbbr($abbrArray);
        $size = count($ticIds);

        if ($size) {
            for ($i = 0; $i < $size; $i++) {
                $tickers[] = [
                    'ticker_id' => $ticIds[$i],
                    'new_id' => $newID
                ];
            }
        }

        return $tickers;
    }

    /**
     * @param array $abbrArray
     * @param int $newID
     * @return array
     */
    public static function getCategoriesByAbbrToInsert($abbrArray, $newID)
    {
        $categories = [];

        $catIds = Category::idsByAbbr($abbrArray);
        $size = count($catIds);

        if ($size) {
            for ($i = 0; $i < $size; $i++) {
                $categories[] = [
                    'category_id' => $catIds[$i],
                    'new_id' => $newID
                ];
            }
        }

        return $categories;
    }

    /**
     * @param array $fields
     * @throws \Exception
     */
    public static function validate($fields)
    {
        $validator = \Validator::make($fields, (new NewsRequest())->rules());

        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
    }

    /**
     *
     * If transmissions id exists in news table then we should
     * 1. remove old news row
     * 2. insert new news with same transmission id
     *
     * remove/add operation is better solution in this case because we don't use news id for sorting
     * and because of all related categories tickers and other info connected with foreign keys
     * so will be deleted automatically
     *
     * @param int $transmissionsId
     * @return bool
     */
    public static function _onExistsTransmissionIdNewsDelete($transmissionsId)
    {
        News::where('transmission_id', '=', $transmissionsId)->delete();
    }

    /**
     * @param array $newsArray
     * @return bool|\Illuminate\Database\Eloquent\Model|null|static
     */
    public static function onExistsUpdateReturnNews(array $newsArray)
    {
        $news = News::where('transmission_id', '=', $newsArray['transmission_id'])->first();
        if($news){
            try{
                \DB::beginTransaction();
                $news->tickers()->detach();
                $news->categories()->detach();
                $news->images()->detach();
                $news->videos()->detach();
                foreach ($newsArray as $field => $value){
                    $news->{$field} = $value;
                }
                $news->save();
                \DB::commit();
            }catch (\PDOException $exception){
                \DB::rollback();
                // TODO::do we need to throw exception so fare method used for XML files parsing only
                //throw $exception;
                Log::error('Update existing news on TransmissionID error: ' . $exception->getMessage());
            }
            return $news;
        }
        return false;
    }

    /**
     * Remove all news from database where release_date older then 1 year
     *
     * @param int $days
     */
    public static function removeNewsOlderThen($days = 365)
    {
        $date = Carbon::now();
        $date->subDays($days);
        $formatted_date = $date->format('Y-m-d H:i:s');
        News::where('release_date', '<=', $formatted_date)->delete();
    }
}