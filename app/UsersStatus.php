<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class UsersStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
