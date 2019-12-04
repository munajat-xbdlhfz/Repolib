<?php

namespace App\Exports;

use App\Cd;
use App\Author;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BibliografiCdExport implements FromView, ShouldAutoSize
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
            return view('bibliografi.cds.export', [
                'data' => Cd::whereYear('tanggal_pengadaan', '=', $this->tahun)
                        ->join('bibliografis', 'cds.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                        ->join('songwriters', 'cds.pencipta_id', '=', 'songwriters.id', 'left outer')
                        ->join('genres', 'cds.genre_id', '=', 'genres.id', 'left outer')
                        ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                        ->join('source_types', 'bibliografis.jenis_sumber_id', '=', 'source_types.id', 'left outer')
                        ->join('languages', 'bibliografis.bahasa_id', '=', 'languages.id', 'left outer')
                        ->join('categories', 'bibliografis.kategori_id', '=', 'categories.id', 'left outer')
                        ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                        ->select(
                            'bibliografis.*', 'cds.*', 'songwriters.name AS pencipta', 
                            'genres.*', 'locations.*', 'source_types.*', 'languages.*',
                            'categories.*', 'users.*'
                            )
                        ->orderBy('bibliografis.tanggal_pengadaan', 'ASC')
                        ->get(),
    
                'double' => 0,
                'authors' => Author::all(),
                'tahun' => $this->tahun,
                'bulan' => $this->bulan,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
        } else {
            return view('bibliografi.cds.export', [
                'data' => Cd::whereYear('tanggal_pengadaan', '=', $this->tahun)
                        ->join('bibliografis', 'cds.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                        ->join('songwriters', 'cds.pencipta_id', '=', 'songwriters.id', 'left outer')
                        ->join('genres', 'cds.genre_id', '=', 'genres.id', 'left outer')
                        ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                        ->join('source_types', 'bibliografis.jenis_sumber_id', '=', 'source_types.id', 'left outer')
                        ->join('languages', 'bibliografis.bahasa_id', '=', 'languages.id', 'left outer')
                        ->join('categories', 'bibliografis.kategori_id', '=', 'categories.id', 'left outer')
                        ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                        ->select(
                            'bibliografis.*', 'cds.*', 'songwriters.name AS pencipta', 
                            'genres.*', 'locations.*', 'source_types.*', 'languages.*',
                            'categories.*', 'users.*'
                            )
                        ->orderBy('bibliografis.tanggal_pengadaan', 'ASC')
                        ->get(),
    
                'double' => 0,
                'authors' => Author::all(),
                'tahun' => $this->tahun,
                'bulan' => 0,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
        }
    }
}
