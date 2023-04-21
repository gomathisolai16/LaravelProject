<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Theme
 * @package App\Models
 */
class Theme extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'abbreviation', 'name', 'active'
    ];
}
