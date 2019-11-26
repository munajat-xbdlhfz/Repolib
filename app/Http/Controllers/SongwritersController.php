<?php

namespace App\Http\Controllers;

use App\Bibliografi;
use App\Book;
use App\Songwriter;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class SongwritersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 2) {
            return abort(403);
        }

        // --Card Data--
        $total_koleksi = Bibliografi::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::where('status', '>', 2)
                                            ->where('status', '!=', 7)
                                            ->count();
        $total_anggota = User::count();

        $songwriter = Songwriter::latest('id')
                ->paginate(15);

        return view('bibliografi.cds.songwriter', [
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
            'songwriter' => $songwriter,
        ]);
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
    public function store(Request $request)
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 2) {
            return abort(403);
        }

        Songwriter::create([
            'name' => $request->get('tambah-songwriter'),
        ]);

        // Redirect to Songwriter Index
		return redirect('/bibliografi/cd/songwriter')->withStatus(__('Songwriter data successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 2) {
            return abort(403);
        }

        Songwriter::where('id', $id)->update([
            'name' => $request->get('songwriter-name'),
        ]);

        // Redirect to Songwriter Index
		return redirect('/bibliografi/cd/songwriter')->withStatus(__('Songwriter data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 2) {
            return abort(403);
        }

        Songwriter::where('id', $id)->delete();

        // Redirect to Songwriter Index
		return redirect('/bibliografi/cd/songwriter')->withStatus(__('Songwriter data successfully deleted.'));
    }
}
