<?php

namespace App\Http\Controllers;

use App\Bibliografi;
use App\Book;
use App\Author;
use App\AuthorBook;
use App\Cd;
use App\Genre;
use App\Songwriter;
use App\Transaction;
use App\User;
use App\Visit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // --Card Data--
        $total_koleksi = Bibliografi::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::where('status', '>', 2)
                                            ->where('status', '!=', 7)
                                            ->count();
        $total_anggota = User::count();

        $month1 = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $month2 = ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $thisMonth = date('M', strtotime('now'));
        $thisYear = date('Y', strtotime('now'));

        // Check Month 1 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month1[$i] == $thisMonth) {
                $valMonth[] = $month1;
                break;
            }
        }

        // Check Month 2 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month2[$i] == $thisMonth) {
                $valMonth[] = $month2;
                break;
            }
        }

        // Bibliografi Data
        $bibli = Book::join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                    ->select('bibliografis.*', 'books.*')
                    ->latest('books.buku_id')
                    ->paginate(5);

            $authorBook = AuthorBook::get();
            $authors = Author::get();

        // CD Data
        $cd = Cd::join('bibliografis', 'cds.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                    ->join('songwriters', 'cds.pencipta_id', '=', 'songwriters.id', 'left outer')
                    ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                    ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                    ->select('bibliografis.*', 'cds.*', 'songwriters.name AS pencipta', 'locations.*', 'users.name AS publisher')
                    ->latest('cds.cd_id')
                    ->paginate(7);

        $genre = Genre::orderBy('genre')->get();
        $pencipta = Songwriter::orderBy('name')->get();

        if (auth()->user()->level == 4){
            return view('welcome');
        } else {
            if (auth()->user()->level == 4) {
                return abort(401);
            }
            
            return view('dashboard', [
                'total_koleksi' => $total_koleksi,
                'total_buku' => $total_buku,
                'total_peminjaman' => $total_peminjaman,
                'total_anggota' => $total_anggota,
                'month' => $valMonth,
                'year' => $thisYear,
                'bibli' => $bibli,
                'double' => 0,
                'authors' => $authors,
                'authorBook' => $authorBook,
                'cd' => $cd,
                'genre' => $genre,
                'pencipta' => $pencipta,
            ]);
        }
    }

    public function find()
    {
        return dd("SEARCH");
    }

    public function chartVisitor()
    {
        $month1 = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $month2 = ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $thisMonth = date('M', strtotime('now'));
        $thisYear = date('Y', strtotime('now'));

        $visitor = [];

        // Check Month 1 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month1[$i] == $thisMonth) {
                $valMonth[] = $month1;
                $start = 0;
                $finish = 6;
                break;
            }
        }

        // Check Month 2 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month2[$i] == $thisMonth) {
                $valMonth[] = $month2;
                $start = 6;
                $finish = 12;
                break;
            }
        }

        for ($start; $start < $finish; $start++) {
            $thisMonth = $start + 1;
            $val = Visit::whereYear('login_date', $thisYear)
                            ->whereMonth('login_date', $thisMonth)
                            ->count();

            array_push($visitor, $val);
        }
        return response()->json($visitor);
    }

    public function chartInput()
    {
        $month1 = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $month2 = ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $thisMonth = date('M', strtotime('now'));
        $thisYear = date('Y', strtotime('now'));

        $input = [];

        // Check Month 1 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month1[$i] == $thisMonth) {
                $valMonth[] = $month1;
                $start = 0;
                $finish = 6;
                break;
            }
        }

        // Check Month 2 Array
        for ($i = 0; $i < 6; $i++) {
            if ($month2[$i] == $thisMonth) {
                $valMonth[] = $month2;
                $start = 6;
                $finish = 12;
                break;
            }
        }

        for ($start; $start < $finish; $start++) {
            $thisMonth = $start + 1;
            $val = Bibliografi::whereYear('tanggal_pengadaan', $thisYear)
                            ->whereMonth('tanggal_pengadaan', $thisMonth)
                            ->count();

            array_push($input, $val);
        }

        return response()->json($input);
    }

    public function opac()
   {
        return view('opac.search');
   }
}
