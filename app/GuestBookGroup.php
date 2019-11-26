<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestBookGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guest_id', 'no_hp', 'nama_lembaga',
        'no_hp_lembaga', 'email_lembaga', 'alamat_lembaga',
        'jumlah_peserta'
    ];

    public function guestBook()
    {
        return $this->belongsTo(GuestBook::class);
    }
}
