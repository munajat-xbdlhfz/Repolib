<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WrittenForm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bentuk_karya_tulis'
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
