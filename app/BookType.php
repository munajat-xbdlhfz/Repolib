<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_buku'
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
