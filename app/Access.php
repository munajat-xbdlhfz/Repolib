<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'akses'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
