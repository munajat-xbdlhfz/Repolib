<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'genre'
    ];

    public function cd()
    {
        return $this->hasMany(Cd::class);
    }
}
