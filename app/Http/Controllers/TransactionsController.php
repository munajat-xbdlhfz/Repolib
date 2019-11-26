<?php

namespace App\Http\Controllers;

use App\AuthorBook;
use App\Transaction;
use App\TransactionStatus;
use Illuminate\Http\Request;
use App\Bibliografi;
use App\Book;
use App\Author;
use App\Fine;
use App\User;

use DateTime;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $data = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
                ->join('bibliografis', 'transactions.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                ->join('transaction_statuses', 'transactions.status', '=', 'transaction_statuses.id')
                ->join('fines', 'transactions.peminjaman_id', '=', 'fines.peminjaman_id', 'left outer')    
                ->select('bibliografis.*', 'users.*', 'transactions.*', 'transaction_statuses.*', 'fines.denda', 'fines.status AS status_denda')
                ->latest('transactions.peminjaman_id')
                ->paginate(15);
        
        $count = Transaction::count();
        return view('transactions.index', [
            'peminjaman' => $data,
            'count' => $count,
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = date("Y-m-d", strtotime("now"));
        $min_date = date("Y-m-d", strtotime("+1 day"));
        $bibli = Bibliografi::where('bentuk_fisik', 'Buku')
                ->orderBy('bibliografis.bibliografi_id', 'DESC')
                ->join('books', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id', 'left outer')
                ->select('bibliografis.*', 'books.*')
                ->paginate(10);

        $users = User::where('level', 4)->orderBy('id', 'DESC')->paginate(10);
        $author = Author::get();
        $authorBook = AuthorBook::get();

        $null = true;
        return view('transactions.pinjam', compact('bibli', 'users', 'now', 'min_date', 'null', 'author', 'authorBook'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromOpac($id)
    {
        $now = date("Y-m-d", strtotime("now"));
        $min_date = date("Y-m-d", strtotime("+1 day"));
        $bibli = Bibliografi::where('bentuk_fisik', 'Buku')
                ->orderBy('bibliografis.bibliografi_id', 'DESC')
                ->join('books', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id', 'left outer')
                ->select('bibliografis.*', 'books.*')
                ->paginate(10);

        $users = User::where('level', 4)->orderBy('id', 'DESC')->paginate(10);
        $data = Bibliografi::where('bibliografis.bibliografi_id', $id)
                ->join('books', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id', 'left outer')
                ->join('author_books', 'books.buku_id', '=', 'author_books.buku_id', 'left outer')
                ->select('bibliografis.*', 'books.*', 'author_books.*')
                ->first();

        $dataAuthor = Author::where('id', $data->authors_id)
                    ->where('status', 'primary')
                    ->select('authors.*')
                    ->first();
        
        $author = Author::get();
        $authorBook = AuthorBook::get();
        
        $null = false;
        return view('transactions.pinjam', compact('bibli', 'users', 'now', 'min_date', 'data', 'null', 'author', 'authorBook', 'dataAuthor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = date("Y-m-d", strtotime("now"));
        $stats0 = 'Pending';
        $stats1 = 'Cancel';
        $stats2 = 'Pinjam';
        $stats3 = 'Kembali';
        $stats4 = 'Kembali - Telat';
        $stats5 = 'Hilang';
        $stats6 = 'Ditolak';

        if(TransactionStatus::count() == 0) {
           for ($i=0; $i < 7 ; $i++) { 
               TransactionStatus::create([
                'status' => ${ 'stats'.$i },
               ]);
           }
        }

        $data = Bibliografi::join('books', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id', 'left outer')
            ->where([
                ['judul', '=', $request->get('judul')],
                ['anak_judul', '=', $request->get('anak_judul')],
                ['isbn', '=', $request->get('isbn')],
                ['edisi', '=', $request->get('edisi')],
                ['penerbit', '=', $request->get('penerbit')],
        ])->first();

        if(auth()->user()->level == 4) {
            $status = 1;
            $user_id = auth()->user()->id;
        } else {
            $status = 3;
            $user = User::where('kode_anggota', $request->get('kode_anggota'))
                    ->first();
                    
            $user_id = $user->id;
        }

        $kode_peminjaman = date("ymd-his", strtotime("now"));
        $kode_peminjaman = $kode_peminjaman.'-'.$user_id.'-'.$data->bibliografi_id;

        Transaction::create([
            'user_id' => $user_id,
            'kode_peminjaman' => $kode_peminjaman,
            'bibliografi_id' => $data->bibliografi_id,
            'tanggal_pinjam' => $now,
            'tanggal_batas_pinjam' => $request->get('batas'),
            'status' => $status,
        ]);

        return redirect('/peminjaman')->withStatus(__('Transaction successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $status = 'Transaction code '.$kode.' successfully deleted.';
        Transaction::where('kode_peminjaman', $kode)->delete();

        return redirect('/peminjaman')->withStatus($status);
    }

    public function cancel($kode) 
    {
        $status = 'Transaction code '.$kode.' has been cancel.';

        Transaction::where('kode_peminjaman', $kode)->update([
            'status' => 2
        ]);
        
        return redirect('/peminjaman')->withStatus($status);
    }

    public function pinjam($kode, $id)
    {
        $status = 'Transaction code '.$kode.' successfully updated.';

        if ($id === 'pinjam') {
            Transaction::where('kode_peminjaman', $kode)->update([
                'status' => 3
            ]);
            
            return redirect('/peminjaman')->withStatus($status);
        } else if ($id === 'ditolak') {
            Transaction::where('kode_peminjaman', $kode)->update([
                'status' => 7
            ]);
            
            return redirect('/peminjaman')->withStatus($status);
        } else {
            //Jika Buku Dikembalikan
            if ($id === 'kembali') {
                $data = Transaction::where('kode_peminjaman', $kode)->first();
                $day_batas = new DateTime($data->tanggal_batas_pinjam);
                $day_kembali = new DateTime('now');
                
                //Cek Batas Peminjaman
                if ($day_kembali > $day_batas) {
                    $lewat = true;
                } else {
                    $lewat = false;
                }
                
                //Perhitungan Denda Telat Pengembalian
                if ($lewat) {
                    $days = $day_kembali->diff($day_batas)->format("%a");
                    $denda = 1000 * $days;

                    Transaction::where('kode_peminjaman', $kode)->update([
                        'status' => 5,
                        'tanggal_kembali' => date('Y-m-d', strtotime("now")),
                    ]);
                    
                    Fine::create([
                        'peminjaman_id' => $data->peminjaman_id,
                        'denda' => $denda,
                        'status' => 'belum lunas',
                    ]);

                    return redirect('/peminjaman')->withStatus($status);
                } else {
                    Transaction::where('kode_peminjaman', $kode)->update([
                        'status' => 4,
                        'tanggal_kembali' => date('Y-m-d', strtotime("now")),
                    ]);

                    return redirect('/peminjaman')->withStatus($status);
                }
            } else if ($id === 'hilang') {
                //Jika Buku Hilang
                $hilang = Transaction::where('kode_peminjaman', $kode)
                    ->join('bibliografis', 'transactions.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                    ->select('transactions.*', 'bibliografis.*')
                    ->first();

                Transaction::where('kode_peminjaman', $kode)->update([
                    'status' => 6,
                    'tanggal_kembali' => date('Y-m-d', strtotime("now")),
                ]);

                Fine::create([
                    'peminjaman_id' => $hilang->peminjaman_id,
                    'denda' => $hilang->harga,
                    'status' => 'belum lunas',
                ]);

                $book = Book::where('bibliografi_id', $hilang->bibliografi_id)->first();
                Book::where('bibliografi_id', $hilang->bibliografi_id)->update([
                    'jumlah_buku' => $book->jumlah_buku - 1,
                ]);

                return redirect('/peminjaman')->withStatus($status);
            } else {
                return abort(404);
            }
        } 
    }

    public function bayar($id)
    {
        Fine::where('peminjaman_id', $id)->update([
            'status' => 'lunas'
        ]);

        return redirect('/peminjaman')->withStatus('Transaction data succesfully updated.');
    }
}
