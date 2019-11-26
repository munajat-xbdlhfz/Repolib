<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
