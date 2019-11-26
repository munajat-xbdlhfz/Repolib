<?php

namespace App\Http\Controllers;

use App\GuestBook;
use App\Bibliografi;
use App\Book;
use App\Transaction;
use App\GuestBookGroup;
use App\User;
use Illuminate\Http\Request;

// EXPORT
use App\Exports\BukuTamuExport;
use Excel;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        // --Card Data--
        $total_koleksi = Bibliografi::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::where('status', '>', 2)
                                            ->where('status', '!=', 7)
                                            ->count();
        $total_anggota = User::count();

        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $data = GuestBook::join('guest_book_groups', 'guest_books.id', '=', 'guest_book_groups.guest_id', 'left outer')
                        ->select('guest_books.*', 'guest_book_groups.*')
                        ->latest('guest_books.id')
                        ->paginate(15);

        return view('guestbook.index', [
            'guest' => $data,
            'month' => $month,
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guestbook($id)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        $pekerjaan = ['Pegawai Negeri', 'Peneliti', 'TNI/Polri', 'Pegawai Swasta', 'Dosen', 
                    'Pensiunan', 'Wiraswasta', 'Guru', 'Pelajar', 'Mahasiswa', 'Hakim',
                    'Dokter', 'Presiden', 'Pustakawan', 'Petani', 'Perawat', 'Lainnya'];

        $pendidikan = ['SD', 'SMP', 'SMA', 'SMK', 'D3', 'D4/S1', 'S2', 'S3'];
        $jenis_kelamin = ['Laki-Laki', 'Perempuan', 'Lainnya'];

        if ($id === 'member') {
            return view('guestbook.member');
        } else if ($id === 'non-member') {
            return view('guestbook.non_member', [
                'pekerjaan' => $pekerjaan,
                'pendidikan' => $pendidikan,
                'jenis_kelamin' => $jenis_kelamin,
            ]);
        } else if ($id === 'group') {
            return view('guestbook.group', [
                'pekerjaan' => $pekerjaan,
                'pendidikan' => $pendidikan,
                'jenis_kelamin' => $jenis_kelamin,
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_member(Request $request)
    {
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        // Check if Member ID Exist in Database
        $check = User::where('kode_anggota', $request->get('anggota'))->count();

        if ($check != 0) {
            $member = User::where('kode_anggota', $request->get('anggota'))
                        ->join('profiles', 'users.id', '=', 'profiles.user_id', 'left outer')
                        ->select('users.*', 'profiles.*')
                        ->first();
            
            GuestBook::create([
                'kode' => $request->get('anggota'),
                'status' => 'anggota',
                'nama' => $member->name,
                'pekerjaan' => $member->pekerjaan,
                'pendidikan' => $member->pendidikan,
                'pendidikan' => $member->pendidikan,
                'jenis_kelamin' => $member->jenis_kelamin,
                'alamat' => $member->alamat,
            ]);

            return redirect('/guestbook/member')->withStatus(__('Your ID member successfully store in guest book'));
        } else {
            return redirect('/guestbook/member')->with('fail', "Sorry, your ID member doesn't exist");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_nonMember(Request $request)
    {   
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        $kode = "BN".date("ymdhis", strtotime("now"));

        GuestBook::create([
            'kode' => $kode,
            'status' => 'non-anggota',
            'nama' => $request->get('nama'),
            'pekerjaan' => $request->get('pekerjaan'),
            'pendidikan' => $request->get('pendidikan'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'alamat' => $request->get('alamat'),
        ]);

        return redirect('/guestbook/non-member')->withStatus(__('Your data successfully store in guest book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_group(Request $request)
    {
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        // Get Time Now
        $time = date('Y-m-d H:i:s', strtotime("now"));

        $kode = "BG".date("ymdhis", strtotime("now"));

        GuestBook::create([
            'kode' => $kode,
            'status' => 'kelompok',
            'nama' => $request->get('nama'),
            'pekerjaan' => $request->get('pekerjaan'),
            'pendidikan' => $request->get('pendidikan'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'alamat' => $request->get('alamat'),
        ]);

        // Get GuestBook ID
        $data = GuestBook::where('created_at', $time)->first();

        GuestBookGroup::create([
            'guest_id' => $data->id,
            'nama_lembaga' => $request->get('instansi'),
            'no_hp_lembaga' => $request->get('hp_lembaga'),
            'email_lembaga' => $request->get('email'),
            'alamat_lembaga' => $request->get('alamat_lembaga'),
            'no_hp' => $request->get('hp'),
            'jumlah_peserta' => $request->get('peserta'),
        ]);

        return redirect('/guestbook/group')->withStatus(__('Your data successfully store in guest book'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function show(GuestBook $guestBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function edit(GuestBook $guestBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuestBook $guestBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestBook $guestBook)
    {
        //
    }

    public function export_view(Request $request)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        if ($bulan != null) {
            $data = GuestBook::whereYear('guest_books.created_at', '=', $tahun)
                            ->whereMonth('guest_books.created_at', '=', $bulan)
                            ->join('guest_book_groups', 'guest_books.id', '=', 'guest_book_groups.guest_id', 'left outer')
                            ->select('guest_books.*', 'guest_book_groups.*')
                            ->orderBy('guest_books.created_at', 'ASC')
                            ->get();
        } 
        else {
            $data = GuestBook::whereYear('guest_books.created_at', '=', $tahun)
                            ->join('guest_book_groups', 'guest_books.id', '=', 'guest_book_groups.guest_id', 'left outer')
                            ->select('guest_books.*', 'guest_book_groups.*')
                            ->orderBy('guest_books.created_at', 'ASC')
                            ->get();
        }

        return view('guestbook.export', [
            'data' => $data,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'month' => $month
        ]);
    }

    public function export_excel($date)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        $dateArray = explode('-', $date);
        $namaFile = 'laporan_buku_tamu_' . $dateArray[0] . '-' . $dateArray[1] . '.xlsx';
        return Excel::download(new BukuTamuExport($dateArray[0], $dateArray[1]), $namaFile);
    }
}
