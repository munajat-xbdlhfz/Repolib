<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookClassification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klasifikasi_buku'
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
