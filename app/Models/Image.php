<?php

namespace App\Models;

use App\Additional\Models\Cachable;
use App\Schemes\Models\ICachable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageModel
 * @package App\Models
 */
class Image extends Model
{
    use Cachable;
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'new_id', 'path', 'size', 'author'
    ];
    /**
     * @var array $hidden
     */
    protected $hidden = ['deleted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news()
    {
        return $this->belongsToMany(News::class, "new_image", "image_id", "new_id");
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

        return \DB::table($this->getTable() . ' as i')
            ->select('ni.new_id', 'i.*')
            ->join('new_image as ni', 'i.id', '=', 'ni.image_id')
            ->whereIn('ni.new_id', $newsIds)->get();
    }

    /**
     *
     * Get last inserted images by limit
     *
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function scopeLastByLimit($query, $limit = 3)
    {
        return $query->limit($limit)->orderBy('id', 'desc');
    }

    /**
     *
     * Get images where deleted column is true|false
     *
     * @param $query
     * @param bool $flag
     * @return mixed
     */
    public function scopeDeleted($query, $flag = false)
    {
        return $query->where($this->getTable().'.deleted', '=', (int)$flag);
    }

    /**
     * @param $query
     * @param string $size
     * @return mixed
     */
    public function scopeSize($query, $size)
    {
        if (!in_array($size, ['original', 'medium', 'small'])) {
            $size = 'original';
        }
        return $query->where('size', 'LIKE', "%$size%");
    }

    /**
     * @param $query
     * @param string $title
     * @return mixed
     */
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }

    /**
     * @param $query
     * @param $order
     * @return $this
     */
    public function scopeOrder($query, $order)
    {
        if ($order !== 'desc' && $order !== 'asc') {
            $order = 'desc';
        }
        return $query->orderBy('created_at', $order);
    }

    /**
     * @param $query
     * @param $path
     * @return mixed
     */
    public function scopeOriginal($query, $path)
    {
        return $query->where([
            "path" => $path,
            "size" => 'original'
        ]);
    }
}
