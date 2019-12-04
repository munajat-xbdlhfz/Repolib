<?php

namespace App\Http\Controllers;

use App\Author;
use App\AuthorBook;
use App\Book;
use App\Cd;

// EXPORT
use App\Exports\BibliografiBookExport;
use App\Exports\BibliografiCdExport;
use App\Imports\BibliografiBookImport;
use App\Imports\BibliografiCdImport;
use Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\File;

// use Maatwebsite\Excel\Facades\Excel;

class BibliografisController extends Controller
{
    public function export_view(Request $request, $id)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        if ($id == 'book') {
            if ($bulan != null) {
                $data = Book::whereYear('tanggal_pengadaan', '=', $tahun)
                        ->whereMonth('tanggal_pengadaan', '=', $bulan)
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
                        ->get();
            } 
            else {
                $data = Book::whereYear('tanggal_pengadaan', '=', $tahun)
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
                        ->get();
            }
        } else if ($id == 'cd') {
            if ($bulan != null) {
                $data = Cd::whereYear('tanggal_pengadaan', '=', $tahun)
                        ->whereMonth('tanggal_pengadaan', '=', $bulan)
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
                        ->get();
            } 
            else {
                $data = Cd::whereYear('tanggal_pengadaan', '=', $tahun)
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
                        ->get();
            }
        }
        
        $count = Book::count();
        $authors = Author::get();
        $authorBooks = AuthorBook::get();

        if ($id == 'book') {
            return view('bibliografi.books.export', [
                'data' => $data,
                'count' => $count,
                'double' => 0,
                'authors' => $authors,
                'authorBooks' => $authorBooks,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'month' => $month
            ]);
        } else if ($id == 'cd') {
            return view('bibliografi.cds.export', [
                'data' => $data,
                'count' => $count,
                'double' => 0,
                'authors' => $authors,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'month' => $month
            ]);
        }
    }

    public function export_excel($id, $date)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        if ($id == 'book') {
            $dateArray = explode('-', $date);
            $namaFile = 'laporan_bibliografi_' . $dateArray[0] . '-' . $dateArray[1] . '.xlsx';
            return Excel::download(new BibliografiBookExport($dateArray[0], $dateArray[1]), $namaFile);
        } else if ($id == 'cd') {
            $dateArray = explode('-', $date);
            $namaFile = 'laporan_cd_' . $dateArray[0] . '-' . $dateArray[1] . '.xlsx';
            return Excel::download(new BibliografiCdExport($dateArray[0], $dateArray[1]), $namaFile);
        }
    }

    public function import_excel(Request $request, $id)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        // Validate File
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
         // Get File And Move to Public Path
         $file = $request->file('file');
         $fileName = 'file_'.time().'.'.$file->getClientOriginalExtension();
         $destinationPath = public_path('storage/import');
         $file->move($destinationPath, $fileName);
 
		if ($id == 'book') {
            // Import Data
            Excel::import(new BibliografiBookImport, public_path('storage/import/'.$fileName));
    
            // Redirect to Book Index
            return redirect('/bibliografi/book')->withStatus(__('Book data successfully imported.'));
        } else if ($id == 'cd') {
            // Import Data
            Excel::import(new BibliografiCdImport, public_path('storage/import/'.$fileName));
    
            // Redirect to Cd Index
            return redirect('/bibliografi/cd')->withStatus(__('CD data successfully imported.'));
        }
    }

    public function download_example($id)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        if ($id == 'book') {
            if (auth()->user()->level == 3) {
                return abort(401);
            }

            $fileName = "Example Bibliografi Import.xlsx";
            $filePath = public_path('argon/import/Example Bibliografi Import.xlsx');
        } else if ($id == 'cd') {
            if (auth()->user()->level == 2) {
                return abort(401);
            }
            $fileName = "Example Cd Import.xlsx";
            $filePath = public_path('argon/import/Example Cd Import.xlsx');
        }

        return response()->download($filePath, $fileName);
    }
}
