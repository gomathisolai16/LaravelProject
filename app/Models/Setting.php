<?php

namespace App\Models;

use App\Additional\Models\Cachable;
use App\Additional\Models\OwnerOrAdmin;
use App\Schemes\Models\ICachable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 */
class Setting extends Model implements ICachable
{
    use OwnerOrAdmin, Cachable;

    const THEME_LABEL = "Color theme";
    const THEME_KEY = "color_theme";

    const TIMEZONE_LABEL = "Timezone";
    const TIMEZONE_KEY = "timezone";

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'key', 'value', 'user_id', 'title'
    ];
    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @param $query
     * @param $key
     */
    public function scopeKey($query, $key)
    {
        return $query->where('key',$key);
    }

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
