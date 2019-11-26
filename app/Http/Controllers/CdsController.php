<?php

namespace App\Http\Controllers;

use App\Cd;
use App\Access;
use App\Bibliografi;
use App\Transaction;
use App\User;
use App\Book;
use App\Genre;
use App\Categories;
use App\Currencies;
use App\Language;
use App\Location;
use App\SourceType;
use App\Songwriter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\File;

class CdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 2 || auth()->user()->level == 4) {
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

        $data = Cd::join('bibliografis', 'cds.bibliografi_id', '=', 'bibliografis.bibliografi_id')
                    ->join('songwriters', 'cds.pencipta_id', '=', 'songwriters.id', 'left outer')
                    ->join('locations', 'bibliografis.lokasi_id', '=', 'locations.id', 'left outer')
                    ->join('users', 'bibliografis.publisher_id', '=', 'users.id', 'left outer')
                    ->select('bibliografis.*', 'cds.*', 'songwriters.name AS pencipta', 'locations.*', 'users.name AS publisher')
                    ->latest('cds.cd_id')
                    ->paginate(15);

        $count = Cd::count();
        $genre = Genre::orderBy('genre')->get();
        $pencipta = Songwriter::orderBy('name')->get();

        return view('bibliografi.cds.index', [
            'bibli' => $data,
            'count' => $count,
            'month' =>$month,
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
            'genre' => $genre,
            'pencipta' => $pencipta,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level == 2 || auth()->user()->level == 4) {
            return abort(401);
        }

        $bahasa = Language::orderBy('bahasa')->get();
        $kategori = Categories::orderBy('kategori')->get();
        $akses = Access::orderBy('akses')->get();
        $lokasi = Location::orderBy('lokasi')->get();
        $sumber = SourceType::orderBy('jenis_sumber')->get();
        $currency = Currencies::orderBy('currency')->get();
        $genre = Genre::orderBy('genre')->get();
        $pencipta = Songwriter::orderBy('name')->get();

        return view('bibliografi.cds.create', [
            'bahasa' => $bahasa, 
            'kategori' => $kategori,
            'akses' => $akses,
            'lokasi' => $lokasi,
            'sumber' => $sumber,
            'currency' => $currency,
            'genre' => $genre,
            'pencipta' => $pencipta,
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
        if (auth()->user()->level == 2 || auth()->user()->level == 4) {
            return abort(401);
        }
        
        $create_token = strtotime('now');
        $bentuk_fisik = 'CD';
        $link = '/bibliografi/cd';

        // Check if Price is Null
        if ($request->get('harga') == null) {
            $request->merge(['harga' => 0]);
        }

        request()->validate([
            'cover' => 'image',
            'file' => 'mimes:zip|max:200000',
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
            $image = Image::make(public_path("storage/covers/{$imageName}"))->fit(1200, 1200);
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

        Cd::create([
            'bibliografi_id' => $bibli_id,
            'penerbit' => $request->get('penerbit'),
            'tempat_terbit' => $request->get('tempat_terbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_keping' => $request->get('jumlah_keping'),
            'pencipta_id' => $request->get('songwriter'),
            'genre_id' => $request->get('genre'),
            'cover' => $imageName,
            'file' => $fileName,
        ]);

        return redirect($link)->withStatus(__('CD data successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cd  $cd
     * @return \Illuminate\Http\Response
     */
    public function show(Cd $cd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cd  $cd
     * @return \Illuminate\Http\Response
     */
    public function edit($bibli_id)
    {
        if (auth()->user()->level == 2 || auth()->user()->level == 4) {
            return abort(401);
        }

        $bahasa = Language::orderBy('bahasa')->get();
        $kategori = Categories::orderBy('kategori')->get();
        $akses = Access::orderBy('akses')->get();
        $lokasi = Location::orderBy('lokasi')->get();
        $sumber = SourceType::orderBy('jenis_sumber')->get();
        $currency = Currencies::orderBy('currency')->get();
        $genre = Genre::orderBy('genre')->get();
        $pencipta = Songwriter::orderBy('name')->get();

        $biblio = Bibliografi::where('bibliografis.bibliografi_id', $bibli_id)
                ->join('cds', 'bibliografis.bibliografi_id', '=', 'cds.bibliografi_id', 'right outer')
                ->select('bibliografis.*', 'cds.*')
                ->first();

        return view('bibliografi.cds.edit', compact(
            'biblio', 'bahasa', 'kategori', 'akses',
            'lokasi', 'genre', 'pencipta', 'sumber',
            'currency'

        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cd  $cd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bibli_id)
    {
        if (auth()->user()->level == 2 || auth()->user()->level == 4) {
            return abort(401);
        }

        // Check if Price is Null
        if ($request->get('harga') == null) {
            $request->merge(['harga' => 0]);
        }

        // Validate Image and File
        request()->validate([
            'cover' => 'image',
            'file' => 'mimes:zip|max:200000',
            'harga' => 'numeric',
        ]);

        // Check if Image is Null or Not
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
            $image = Image::make(public_path("storage/covers/{$imageName}"))->fit(1200, 1200);
            $image->save();
            
        } else {
            $imageName = null;
        }

        //Check if File is Null or Not
        if (request('file') != null) {
            // Delete Old File
            $deleteFile = Book::where('bibliografi_id', $bibli_id)->value('file');
            // Check if Old Image Not Null
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

        Cd::where('bibliografi_id', $bibli_id)
            ->update([
            'penerbit' => $request->get('penerbit'),
            'tempat_terbit' => $request->get('tempat_terbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_keping' => $request->get('jumlah_keping'),
            'pencipta_id' => $request->get('songwriter'),
            'genre_id' => $request->get('genre'),
        ]);

        // If Image Not Null Then Update New Image
        if ($imageName != null) {
            Cd::where('bibliografi_id', $bibli_id)->update(['cover' => $imageName]);
        }

        // If File Not Null Then Update New File
        if ($fileName != null) {
            Cd::where('bibliografi_id', $bibli_id)->update(['file' => $fileName]);
        }

        return redirect('/bibliografi/cd')->withStatus(__('CD data successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cd  $cd
     * @return \Illuminate\Http\Response
     */
    public function destroy($bibli)
    {
        $deleteFile = Cd::where('bibliografi_id', $bibli)->value('file');
        $deleteImage = Cd::where('bibliografi_id', $bibli)->value('cover');

        // Check if Image Not Null and Exist in Storage
        if($deleteImage != null) {
            if (Storage::exists('public/covers/'.$deleteImage)) {
                // unlink(public_path('storage/covers/'.$deleteImage));
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

        // Delete CD Data
        Bibliografi::where('bibliografi_id', $bibli)->delete(); 

        return redirect('/bibliografi/cd')->withStatus(__('CD data successfully deleted.'));
    }

    public function getDownload($id) 
    {
        if (auth()->user()->level == 4 || auth()->user()->level == 2) {
            return abort(401);
        }

        $cd = Cd::where('cd_id', $id)
            ->join('bibliografis', 'cds.bibliografi_id', '=', 'bibliografis.bibliografi_id', 'left outer')
            ->first();

        $fileName = $cd->judul.".zip";
        $filePath = public_path('storage/file/'.$cd->file);
        return response()->download($filePath, $fileName);
    }
}
