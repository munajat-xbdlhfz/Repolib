<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliografi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isbn', 'no_panggil', 'judul', 
        'anak_judul', 'edisi', 'publisher_id', 
        'jenis_sumber_id', 'nama_sumber', 'bentuk_fisik', 
        'bahasa_id', 'kategori_id', 'akses_id', 
        'lokasi_id', 'mata_uang_id', 'harga', 
        'tanggal_pengadaan', 'create_token', 'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function languages()
    {
        return $this->belongsTo(Language::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function access()
    {
        return $this->belongsTo(Access::class);
    }

    public function sourceType()
    {
        return $this->belongsTo(SourcesType::class);
    }

    public function book()
    {
        return $this->hasOne(Book::class);
    }

    public function cd()
    {
        return $this->hasOne(Cd::class);
    }
}
