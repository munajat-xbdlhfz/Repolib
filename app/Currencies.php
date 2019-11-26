<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'currency'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
