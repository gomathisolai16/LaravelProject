<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWatchList extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_watch_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name'];

    public $timestamps = false;

    public function tickers() {
        return $this->hasMany(UserTicker::class, 'watch_list_id', 'id');
    }

    public function userWatchListRecords($userId, $asArray = false) {
        $records = UserWatchList::where(['user_id' => $userId])->with(['tickers'])->get();
        if ($asArray) {
            return $records->toArray();
        }
        return $records;
    }

    public function canUserAddWatchList($userId) {
        $records = UserWatchList::where(['user_id' => $userId])->count();
        if ($records > 2) {
            return false;
        }
        return true;
    }

    public function userWatchListTickers($userId, $watchListId, $asArray = false) {
        $records = UserWatchList::where(['user_id' => $userId, 'id' => $watchListId])->first()->tickers;
        if ($asArray) {
            return $records->toArray();
        }
    }
}
