<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bibliografi_id', 'penerbit', 'tempat_terbit',
        'tahun_terbit', 'jumlah_halaman', 'jumlah_buku',
        'karya_tulis_id', 'jenis_buku_id', 'cover',
        'file', 'opac', 'tinggi_buku',
        'klasifikasi_buku_id', 'subjek_id'
    ];

    public function bibliografi()
    {
        return $this->belongsTo(Bibliografi::class);
    }

    public function authorBook()
    {
        return $this->hasMany(AuthorBook::class);
    }

    public function writenForm()
    {
        return $this->belongsTo(WrittenForm::class);
    }

    public function bookType()
    {
        return $this->belongsTo(BookType::class);
    }

    public function bookSubject()
    {
        return $this->belongsTo(BookSubject::class);
    }

    public function bookClassification()
    {
        return $this->belongsTo(BookClassification::class);
    }
}
