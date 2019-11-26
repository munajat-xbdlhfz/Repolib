<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_sumber'
    ];

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }
}
