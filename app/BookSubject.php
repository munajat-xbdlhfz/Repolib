<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSubject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subjek'
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
