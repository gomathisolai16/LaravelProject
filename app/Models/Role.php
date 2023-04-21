<?php

namespace App\Models;

use App\Additional\Models\Cachable;
use App\Schemes\Models\ICachable;
use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 * @package App\Models
 */
class Role extends EntrustRole implements ICachable
{
    use Cachable;

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
