<?php
/**
 * Created by PhpStorm.
 * User: edi-r
 * Date: 11/9/2017
 * Time: 4:37 PM
 */

namespace App\Services;

use App\Mail\WatchListAlerts;
use App\Models\News;
use Illuminate\Support\Facades\Mail;

/**
 * Class EmailAlertService
 * @package App\Services
 */
class EmailAlertService
{
    /**
     * Function that does the logic for watchlist based news and if they need to be sent.
     *
     * @param $alert
     * @return bool
     */
    public function handleEmailAlert ($alert) {
        if (count($alert)) {
            foreach ($alert as $data) {
                $obj = $data['data'];
                $query = app(News::class)->byModuleId($obj->module_id, $data['userId']);
                $latestNews = $query->orderBy('release_date','desc')->first();
                $latestID = $latestNews ? $latestNews->id : null;

                $newsId = $obj->user->getLatestNewsSentId();
                // NOTE: Will allow same news content sent on each iteration
                // if (!$newsId || $newsId == null || $newsId != $latestID) {
                    $obj->user->updateLatestNewsSent($latestID);
                    $lastTenNews = $query->orderBy('release_date','desc')->limit(10)->get();
                    $lastTenTopNews = News::with('images')->where('top',1)->orderBy('release_date','desc')->limit(10)->get();
                    $this->sendNewsEmail($obj->user, $lastTenNews, $lastTenTopNews);
                // }
            }
        }
        return true;
    }

    /**
     * Send Email to customers with specific news
     *
     * @param $user
     * @param $watchListNews
     * @param $topNews
     * @return string
     */
    public function sendNewsEmail($user, $watchListNews, $topNews)
    {
        $result = Mail::to($user->email)->send(new WatchListAlerts($user, $watchListNews, $topNews));
        //not sure what result will be, if boolean or object, we need to check it in if statement if returns null
        // or got to exception and got assigned to false
        if (!$result) {
            return false;
        }
        return true;
    }
}
