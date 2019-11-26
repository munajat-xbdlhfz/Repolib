<?php

namespace App\Exports;

use App\GuestBook;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BukuTamuExport implements FromView, ShouldAutoSize
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
            return view('guestbook.export', [
                'data' => GuestBook::whereYear('guest_books.created_at', '=', $this->tahun)
                            ->whereMonth('guest_books.created_at', '=', $this->bulan)
                            ->join('guest_book_groups', 'guest_books.id', '=', 'guest_book_groups.guest_id', 'left outer')
                            ->select('guest_books.*', 'guest_book_groups.*')
                            ->orderBy('guest_books.created_at', 'ASC')
                            ->get(),
            
                'tahun' => $this->tahun,
                'bulan' => $this->bulan,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
            
        } 
        else {
            return view('guestbook.export', [
                'data' => GuestBook::whereYear('guest_books.created_at', '=', $this->tahun)
                            ->join('guest_book_groups', 'guest_books.id', '=', 'guest_book_groups.guest_id', 'left outer')
                            ->select('guest_books.*', 'guest_book_groups.*')
                            ->orderBy('guest_books.created_at', 'ASC')
                            ->get(),
            
                'tahun' => $this->tahun,
                'bulan' => 0,
                'month' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            ]);
        }
    }
}
