<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode', 'status', 'nama',
        'pekerjaan', 'pendidikan', 'jenis_kelamin',
        'alamat'
    ];

    public function guestBookGroup()
    {
        return $this->hasOne(GuestBookGroup::class);
    }
}
