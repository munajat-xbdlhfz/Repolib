<?php

namespace App\Http\Controllers;

use App\Author;
use App\Bibliografi;
use App\Book;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 3) {
            return abort(401);
        }

        // --Card Data--
        $total_koleksi = Bibliografi::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::count();
        $total_anggota = User::count();

        $author = Author::latest('id')
                ->paginate(15);

        return view('bibliografi.books.author', [
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
            'author' => $author,
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
        if (auth()->user()->level == 4 || auth()->user()->level == 3) {
            return abort(403);
        }
        
        Author::create([
            'name' => $request->get('tambah-author'),
            'status' => $request->get('author-status')
        ]);

        // Redirect to Book Author Index
		return redirect('/bibliografi/book/author')->withStatus(__('Author data successfully created.'));
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
        if (auth()->user()->level == 4 || auth()->user()->level == 3) {
            return abort(403);
        }

        Author::where('id', $id)->update([
            'name' => $request->get('author-name'),
            'status' => $request->get('author-status'),
        ]);

        // Redirect to Book Author Index
		return redirect('/bibliografi/book/author')->withStatus(__('Author data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 3) {
            return abort(403);
        }

        Author::where('id', $id)->delete();

        // Redirect to Book Author Index
		return redirect('/bibliografi/book/author')->withStatus(__('Author data successfully deleted.'));
    }
}
