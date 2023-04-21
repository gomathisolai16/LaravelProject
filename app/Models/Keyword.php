<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Keyword
 * @package App\Models
 */
class Keyword extends Model
{

    /**
     * @var string $_relationId
     */
    protected $_relationId = "keyword_id";
    /**
     * @var array
     */
    protected $fillable = [
        'keyword'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_keyword', 'keyword_id', 'category_id');
    }

    public static function get($keyword)
    {
        return Keyword::where('keyword',$keyword)->first();
    }

    public static function add($keyword)
    {
        return Keyword::create(['keyword'=>$keyword]);
    }
}
