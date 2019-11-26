<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'bibliografi_id', 'tanggal_pinjam', 
        'tanggal_batas_pinjam', 'tanggal_kembali', 'status', 
        'keterangan', 'kode_peminjaman'
    ];

    public function bibliografi()
    {
        return $this->belongsTo(Bibliografi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function fine()
    {
        return $this->hasMany(Fine::class);
    }
}
