<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bahasa'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
