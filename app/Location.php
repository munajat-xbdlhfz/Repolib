<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lokasi'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
