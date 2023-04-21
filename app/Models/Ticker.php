<?php

namespace App\Models;

use App\Additional\Models\ActivePassive;
use App\Additional\Models\CommonFilters;
use App\Additional\Models\OwnerOrAdmin;
use App\Schemes\Models\IOrderable;
use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    use OwnerOrAdmin,
        CommonFilters,
        ActivePassive;


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'abbreviation'
    ];

    /**
     * @param $query
     */
    public function scopeByLastNews($query)
    {
        return $query
            ->select('tickers.id', 'tickers.abbreviation', 'tickers.created_at', 'tickers.updated_at', \DB::raw('MAX(' . \DB::getTablePrefix() . 'n.release_date) as last_news_created_at'))
            ->join('new_ticker as nt', 'nt.ticker_id', 'tickers.id')
            ->join('news as n', 'nt.new_id', 'n.id')
            ->orderBy('last_news_created_at', 'desc')
            ->groupBy('tickers.id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'new_ticker', 'ticker_id', 'new_id');
    }

    /**
     * @param array $newsIds
     * @return array
     */
    public function getByNewsIds(array $newsIds)
    {
        if (count($newsIds) === 0) {
            return [];
        }
        return \DB::table($this->getTable() . ' as t')
            ->select('nt.new_id', 't.*')
            ->join('new_ticker as nt', 't.id', '=', 'nt.new_id')
            ->whereIn('nt.new_id', $newsIds)->get();
    }

    /**
     * @param $query
     * @param $abbrArray
     * @return array
     */
    public function scopeIdsByAbbr($query, $abbrArray)
    {
        if (!is_array($abbrArray)) {
            return [];
        }
        return $query->whereIn('abbreviation', $abbrArray)->pluck('id');
    }

}
