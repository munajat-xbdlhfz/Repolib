<?php

namespace App\Http\Controllers;

use App\Access;
use App\Author;
use App\AuthorBook;
use App\Bibliografi;
use App\Transaction;
use App\User;
use App\Book;
use App\BookClassification;
use App\BookSubject;
use App\BookType;
use App\Categories;
use App\Currencies;
use App\Language;
use App\Location;
use App\SourceType;
use App\WrittenForm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\File;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
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

        $data = Book::join('bibliografis', 'books.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                    ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                    ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                    ->select('bibliografis.*', 'books.*', 'locations.*', 'users.name AS publisher')
                    ->latest('books.buku_id')
                    ->paginate(10);

        $count = Book::count();
        $authorBook = AuthorBook::get();
        $authors = Author::get();
        $users = User::get();
        
        return view('bibliografi.books.index', [
            'bibli' => $data,
            'count' => $count,
            'double' => 0,
            'authors' => $authors,
            'authorBook' => $authorBook,
            'month' => $month,
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
            return abort(401);
        }

        $bahasa = Language::orderBy('bahasa')->get();
        $kategori = Categories::orderBy('kategori')->get();
        $akses = Access::orderBy('akses')->get();
        $lokasi = Location::orderBy('lokasi')->get();
        $karya_tulis = WrittenForm::orderBy('bentuk_karya_tulis')->get();
        $jenis_buku = BookType::orderBy('jenis_buku')->get();
        $authorPrimary = Author::where('status', 'Primary')->orderBy('name')->get();
        $authorAdditional = Author::where('status', 'Additional')->orderBy('name')->get();
        $sumber = SourceType::orderBy('jenis_sumber')->get();
        $currency = Currencies::orderBy('currency')->get();
        $klasifikasi_buku = BookClassification::orderBy('klasifikasi_buku')->get();
        $subjek_buku = BookSubject::orderBy('subjek')->get();

        return view('bibliografi.books.create', [
            'bahasa' => $bahasa, 
            'kategori' => $kategori,
            'akses' => $akses,
            'lokasi' => $lokasi,
            'karya_tulis' => $karya_tulis,
            'jenis_buku' => $jenis_buku,
            'authorPrimary' => $authorPrimary,
            'authorAdditional' => $authorAdditional,
            'sumber' => $sumber,
            'currency' => $currency,
            'klasifikasi_buku' => $klasifikasi_buku,
            'subjek_buku' => $subjek_buku,
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
            return abort(401);
        }

        $create_token = strtotime('now');
        $bentuk_fisik = 'Buku';
        $link = '/bibliografi/book';

        // Check if Price is Null
        if ($request->get('harga') == null) {
            $request->merge(['harga' => 0]);
        }

        // Validate Image and File
        request()->validate([
            'cover' => 'image',
            'file' => 'mimes:pdf,doc,docx|max:200000',
            'harga' => 'numeric',
        ]);
        
        
        // Check if Image is Null or Not
        if (request('cover') != null) {
            // Get Image And Move to Public Path
            $file = $request->file('cover');
            $imageName = 'img_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/covers');
            $file->move($destinationPath, $imageName);

            // Cut the Image
            $image = Image::make(public_path("storage/covers/{$imageName}"))->fit(1080, 1600);
            $image->save();
        } else {
            $imageName = null;
        }

        //Check if File is Null or Not
        if (request('file') != null) {
            // Get File And Move to Public Path
            $file = $request->file('file');
            $fileName = 'file_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/file');
            $file->move($destinationPath, $fileName);
        } else {
            $fileName = null;
        }
        
        Bibliografi::create([
            'isbn' => $request->get('isbn'),
            'no_panggil' => $request->get('no_panggil'),
            'judul' => $request->get('judul'),
            'anak_judul' => $request->get('anak_judul'),
            'edisi' => $request->get('edisi'),
            'publisher_id' => auth()->user()->id,
            'jenis_sumber_id' => $request->get('jenis'),
            'nama_sumber' => $request->get('nama_sumber'),
            'bentuk_fisik' => $bentuk_fisik,
            'bahasa_id' => $request->get('bahasa'),
            'kategori_id' => $request->get('kategori'),
            'akses_id' => $request->get('akses'),
            'lokasi_id' => $request->get('lokasi'),
            'mata_uang_id' => $request->get('mata_uang'),
            'harga' => $request->get('harga'),
            'tanggal_pengadaan' => date('Y-m-d', strtotime("now")),
            'create_token' => $create_token,
        ]);

        $bibli_id = Bibliografi::where('create_token', $create_token)
            ->value('bibliografi_id');
        
        Book::create([
            'bibliografi_id' => $bibli_id,
            'penerbit' => $request->get('penerbit'),
            'tempat_terbit' => $request->get('tempat_terbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'tinggi_buku' => $request->get('tinggi_buku'),
            'jumlah_halaman' => $request->get('jumlah_halaman'),
            'jumlah_buku' => $request->get('jumlah_buku'),
            'klasifikasi_buku_id' => $request->get('klasifikasi_buku'),
            'karya_tulis_id' => $request->get('karya_tulis'),
            'jenis_buku_id' => $request->get('jenis_buku'),
            'subjek_id' => $request->get('subjek_buku'),
            'cover' => $imageName,
            'file' => $fileName,
            'opac' => $request->get('opac'),
            'deskripsi' => $request->get('deskripsi'),
        ]);

        $book_id = Book::where('bibliografi_id', $bibli_id)
            ->value('buku_id');

        // Author Primary
        if ($request->get('authorPrimary') != null) {
            AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $request->get('authorPrimary')]);
        }

        // Author Additional
        $additional = $request->get('authorAdditional');
        if ($additional != null) {
            for ($i = 0; $i < count($additional); $i++ ) {
                AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $additional[$i] ]);
            }
        }
        
        return redirect($link)->withStatus(__('Book data successfully created.'));
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
    public function edit($bibli_id)
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
            return abort(401);
        }

        $bahasa = Language::orderBy('bahasa')->get();
        $kategori = Categories::orderBy('kategori')->get();
        $akses = Access::orderBy('akses')->get();
        $lokasi = Location::orderBy('lokasi')->get();
        $karya_tulis = WrittenForm::orderBy('bentuk_karya_tulis')->get();
        $jenis_buku = BookType::orderBy('jenis_buku')->get();
        $authorPrimary = Author::where('status', 'Primary')->orderBy('name')->get();
        $authorAdditional = Author::where('status', 'Additional')->orderBy('name')->get();
        $sumber = SourceType::orderBy('jenis_sumber')->get();
        $currency = Currencies::orderBy('currency')->get();
        $klasifikasi_buku = BookClassification::orderBy('klasifikasi_buku')->get();
        $subjek_buku = BookSubject::orderBy('subjek')->get();

        $biblio = Bibliografi::where('bibliografis.bibliografi_id', $bibli_id)
                            ->join('books', 'bibliografis.bibliografi_id', '=', 'books.bibliografi_id', 'right outer')
                            ->select('bibliografis.*', 'books.*')
                            ->first();
                
        $authorBook = AuthorBook::where('buku_id', $biblio->buku_id)->get();

        return view('bibliografi.books.edit', compact(
            'biblio', 'bahasa', 'kategori', 'akses',
            'lokasi', 'karya_tulis', 'jenis_buku', 'authorPrimary',
            'authorAdditional', 'sumber', 'currency', 'authorBook',
            'klasifikasi_buku', 'subjek_buku'
        ));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bibli_id)
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
            return abort(401);
        }

        // Check if Price is Null
        if ($request->get('harga') == null) {
            $request->merge(['harga' => 0]);
        }

        // Validate Image and File
        request()->validate([
            'cover' => 'image',
            'file' => 'mimes:pdf,doc,docx|max:200000',
            'harga' => 'numeric',
        ]);
        
        // Cek if image is null or not
        if (request('cover') != null) {
            // ---Delete Old Image---
            $deleteImage = Book::where('bibliografi_id', $bibli_id)->value('cover');
            // Check if old image not null
            if($deleteImage != null) {
                // unlink(public_path('storage/covers/'.$deleteImage));
                if (Storage::exists('public/covers/'.$deleteImage)) {
                    Storage::delete('public/covers/'.$deleteImage);
                }
            }

            // Get Image And Move to Public Path
            $file = $request->file('cover');
            $imageName = 'img_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/covers');
            $file->move($destinationPath, $imageName);

            // Cut the Image
            $image = Image::make(public_path("storage/covers/{$imageName}"))->fit(1080, 1600);
            $image->save();
        } else {
            $imageName = null;
        }

        //Cek if file is null or not
        if (request('file') != null) {
            // Delete Old File
            $deleteFile = Book::where('bibliografi_id', $bibli_id)->value('file');
            // Check if old image not null
            if($deleteFile != null) {
                // unlink(public_path('storage/file/'.$deleteFile));
                if (Storage::exists('public/file/'.$deleteFile)) {
                    Storage::delete('public/file/'.$deleteFile);
                }
            }

            // Get File And Move to Public Path
            $file = $request->file('file');
            $fileName = 'file_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/file');
            $file->move($destinationPath, $fileName);
        } else {
            $fileName = null;
        }

        Bibliografi::where('bibliografi_id', $bibli_id)
                ->update([
                    'isbn' => $request->get('isbn'),
                    'no_panggil' => $request->get('no_panggil'),
                    'judul' => $request->get('judul'),
                    'anak_judul' => $request->get('anak_judul'),
                    'edisi' => $request->get('edisi'),
                    'jenis_sumber_id' => $request->get('jenis'),
                    'nama_sumber' => $request->get('nama_sumber'),
                    'bahasa_id' => $request->get('bahasa'),
                    'kategori_id' => $request->get('kategori'),
                    'akses_id' => $request->get('akses'),
                    'lokasi_id' => $request->get('lokasi'),
                    'mata_uang_id' => $request->get('mata_uang'),
                    'harga' => $request->get('harga'),
        ]);

        Book::where('bibliografi_id', $bibli_id)
            ->update([
                'penerbit' => $request->get('penerbit'),
                'tempat_terbit' => $request->get('tempat_terbit'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'tinggi_buku' => $request->get('tinggi_buku'),
                'jumlah_halaman' => $request->get('jumlah_halaman'),
                'jumlah_buku' => $request->get('jumlah_buku'),
                'klasifikasi_buku_id' => $request->get('klasifikasi_buku'),
                'karya_tulis_id' => $request->get('karya_tulis'),
                'jenis_buku_id' => $request->get('jenis_buku'),
                'subjek_id' => $request->get('subjek_buku'),
                'opac' => $request->get('opac'),
                'deskripsi' =>$request->get('deskripsi'),
        ]);

        // If Image Not Null Then Update New Image
        if ($imageName != null) {
            Book::where('bibliografi_id', $bibli_id)->update(['cover' => $imageName]);
        }

        // If File Not Null Then Update New File
        if ($fileName != null) {
            Book::where('bibliografi_id', $bibli_id)->update(['file' => $fileName]);
        }

        $book_id = Book::where('bibliografi_id', $bibli_id)
                        ->value('buku_id');

        $getAuthor = AuthorBook::where('buku_id', $book_id)->get();
        $authorPrimary = Author::where('status', 'primary')->get();
        $authorAdditional = Author::where('status', 'additional')->get();
        
            // Author Primary
        foreach ($getAuthor as $changeAp) {
            foreach ($authorPrimary as $ap) {
                if ($changeAp->buku_id == $book_id && $changeAp->authors_id == $ap->id) {
                    AuthorBook::where('buku_id', $book_id)
                            ->where('authors_id', $ap->id)
                            ->update([
                                'authors_id' => $request->get('authorPrimary')
                    ]);
                }
            }
        }

        // Author Additional
        $additional = $request->get('authorAdditional');
        if ($additional != null) {
            // Delete Old Author Additional
            foreach ($getAuthor as $changeAd) {
                foreach ($authorAdditional as $ad) {
                    if ($changeAd->buku_id == $book_id && $changeAd->authors_id == $ad->id) {
                        AuthorBook::where('buku_id', $book_id)
                                ->where('authors_id', $ad->id)
                                ->delete();
                    }
                }
            }

            for ($i = 0; $i < count($additional); $i++ ) {
                AuthorBook::create(['buku_id' => $book_id, 'authors_id' => $additional[$i] ]);
            }
        }
        
        return redirect('/bibliografi/book')->withStatus(__('Book data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bibli)
    {
        if (auth()->user()->level == 3 || auth()->user()->level == 4) {
            return abort(401);
        }

        $deleteFile = Book::where('bibliografi_id', $bibli)->value('file');
        $deleteImage = Book::where('bibliografi_id', $bibli)->value('cover');

        // Check if Image Not Null and Exist in Storage
        if($deleteImage != null) {
            if (Storage::exists('public/covers/'.$deleteImage)) {
                // unlink(public_path('storage/covers/'.$deleteImage));
                // File::delete('storage/covers/'.$deleteImage);
                Storage::delete('public/covers/'.$deleteImage);
            }
        }
        
        // Check if File Not Null and Exist in Storage
        if($deleteFile != null) {
            if (Storage::exists('public/file/'.$deleteFile)) {
                // unlink(public_path('storage/file/'.$deleteFile));
                Storage::delete('public/file/'.$deleteFile);
            }
        }

        //Delete Book Data
        Bibliografi::where('bibliografi_id', $bibli)->delete(); 

        return redirect('/bibliografi/book')->withStatus(__('Book data successfully deleted.'));
        
    }
}
