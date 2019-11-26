<?php

namespace App\Exports;

use App\Author;
use App\AuthorBook;
use App\Bibliografi;
use App\Book;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BibliografiBookExport implements FromView, ShouldAutoSize
{
    public $tahun;
    public $bulan;
    
    public function __construct($bulan, $tahun)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if ($this->bulan !== 'all') {
            return view('bibliografi.books.export', [
                'data' => Book::whereYear('tanggal_pengadaan', '=', $this->tahun)
                        ->whereMonth('tanggal_pengadaan', '=', $this->bulan)
                        ->join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                        ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                        ->join('written_forms', 'books.karya_tulis_id', '=', 'written_forms.id', 'left outer')
                        ->join('book_types', 'books.jenis_buku_id', '=', 'book_types.id', 'left outer')
                        ->join('source_types', 'bibliografis.jenis_sumber_id', '=', 'source_types.id', 'left outer')
                        ->join('languages', 'bibliografis.bahasa_id', '=', 'languages.id', 'left outer')
                        ->join('categories', 'bibliografis.kategori_id', '=', 'categories.id', 'left outer')
                        ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                        ->join('book_classifications', 'books.klasifikasi_buku_id', '=', 'book_classifications.id', 'left outer')
                        ->join('book_subjects', 'books.subjek_id', '=', 'book_subjects.id', 'left outer')
                        ->select(
                            'bibliografis.*', 'books.*',
                            'locations.*', 'written_forms.*', 
                            'book_types.*', 'source_types.*', 'languages.*',
                            'categories.*', 'users.*', 'book_classifications.*',
                            'book_subjects.*'
                            )
                        ->orderBy('bibliografis.tanggal_pengadaan', 'ASC')
                        ->get(),
    
                'double' => 0,
                'authors' => Author::all(),
                'authorBooks' => AuthorBook::all(),
                'tahun' => $this->tahun,
                'bulan' => $this->bulan,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
        } else {
            return view('bibliografi.books.export', [
                'data' => Book::whereYear('tanggal_pengadaan', '=', $this->tahun)
                        ->join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                        ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                        ->join('written_forms', 'books.karya_tulis_id', '=', 'written_forms.id', 'left outer')
                        ->join('book_types', 'books.jenis_buku_id', '=', 'book_types.id', 'left outer')
                        ->join('source_types', 'bibliografis.jenis_sumber_id', '=', 'source_types.id', 'left outer')
                        ->join('languages', 'bibliografis.bahasa_id', '=', 'languages.id', 'left outer')
                        ->join('categories', 'bibliografis.kategori_id', '=', 'categories.id', 'left outer')
                        ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                        ->join('book_classifications', 'books.klasifikasi_buku_id', '=', 'book_classifications.id', 'left outer')
                        ->join('book_subjects', 'books.subjek_id', '=', 'book_subjects.id', 'left outer')
                        ->select(
                            'bibliografis.*', 'books.*',
                            'locations.*', 'written_forms.*', 
                            'book_types.*', 'source_types.*', 'languages.*',
                            'categories.*', 'users.*', 'book_classifications.*',
                            'book_subjects.*'
                            )
                        ->orderBy('bibliografis.tanggal_pengadaan', 'ASC')
                        ->get(),
    
                'double' => 0,
                'authors' => Author::all(),
                'authorBooks' => AuthorBook::all(),
                'tahun' => $this->tahun,
                'bulan' => 0,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
        }
    }
}
