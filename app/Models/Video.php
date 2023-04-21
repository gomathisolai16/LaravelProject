<?php

namespace App\Models;

use Exception;
use App\Models\News;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = ['url'];

    /**
     * Insert video records and populate pivot table between news and video modules
     * 
     * @param int $newsId
     * @param array $videos
     * @throws Exception
     */
    public static function addAndAttachToNews($newsId, $videos)
    {
        $saved = self::insert($videos);
        if (!$saved) {
            throw new Exception(trans('exception.canNotSave', ['item' => 'Videos']));
        }
        $lastAddedVideoRecords = self::lastByLimit(count($videos))->get();
        News::find($newsId)->videos()->attach($lastAddedVideoRecords);
    }
    /**
     * Get all video records bind to provided news IDs
     * 
     * @param array $ids
     * @return array
     */
    public function getByNewsIds($ids)
    {
        return \DB::table($this->getTable() . ' as vid')
            ->select('nv.news_id', 'vid.*')
            ->join('news_video as nv', 'nv.video_id', '=', 'vid.id')
            ->whereIn('nv.news_id', $ids)
            ->get();
    }

    /**
     *
     * Get last inserted videos by limit
     *
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function scopeLastByLimit($query, $limit = 1)
    {
        return $query->limit($limit)->orderBy('id', 'desc');
    }
}
