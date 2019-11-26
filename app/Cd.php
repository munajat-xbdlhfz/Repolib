<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cd extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bibliografi_id', 'penerbit', 'tempat_terbit',
        'tahun_terbit', 'jumlah_keping', 'pencipta_id',
        'genre_id', 'cover', 'file', 
    ];

    public function bibliografi()
    {
        return $this->belongsTo(Bibliografi::class);
    }

    public function genre()
    {
        return $this->hasMany(Genre::class);
    }

    public function songWritter()
    {
        return $this->belongsTo(songWritter::class);
    }
}
