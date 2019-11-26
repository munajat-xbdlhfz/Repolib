<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Songwriter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function cd()
    {
        return $this->hasMany(Cd::class);
    }
}
