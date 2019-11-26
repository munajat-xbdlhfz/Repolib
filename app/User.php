<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level', 'name', 'email', 
        'password', 'status', 'alamat', 
        'provinsi', 'kode', 'kode_pos', 
        'warga_negara', 'kode_anggota', 'jenis_kelamin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'level',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //method ini apabila sudah registrasi tetapi ada data foreignkey yang harus ditampilkan
    //maka akan mengisi data foreignkey yang tidak nullable --user_id--
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'user_id' => $user->id,
            ]);
        });
    }

    public function usersstatus()
    {
        return $this->belongsTo(UsersStatus::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function bibliografi()
    {
        return $this->hasMany(Bibliografi::class);
    }

    public function visit()
    {
        return $this->hasMany(Visit::class);
    }
}
