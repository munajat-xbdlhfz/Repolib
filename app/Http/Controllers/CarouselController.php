<?php

namespace App\Http\Controllers;

use App\Bibliografi;
use App\Book;
use App\Carousel;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level != 1) {
            return abort(401);
        }

        // --Card Data--
        $total_koleksi = Bibliografi::count();
        $total_buku = Book::count();
        $total_peminjaman = Transaction::where('status', '>', 2)
                                            ->where('status', '!=', 7)
                                            ->count();
        $total_anggota = User::count();

        $carousel = Carousel::count();
        if ($carousel == 0) {
            for ($i=0; $i < 4 ; $i++) { 
                Carousel::create([]);
            }
        }

        $carouselFirst = Carousel::where('id', 1)->value('cover');
        $carouselSecond = Carousel::where('id', 2)->value('cover');
        $carouselThird = Carousel::where('id', 3)->value('cover');
        $carouselFourth = Carousel::where('id', 4)->value('cover');

        return view('carousel', [
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
            'carouselFirst' => $carouselFirst,
            'carouselSecond' => $carouselSecond,
            'carouselThird' => $carouselThird,
            'carouselFourth' => $carouselFourth,
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
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->level != 1) {
            return abort(403);
        }

        // Validate Image
        request()->validate([
            'cover' => 'image'
        ]);

        // Cek if image is null or not
        if (request('cover') != null) {
            // ---Delete Old Image---
            $deleteImage = Carousel::where('id', $id)->value('cover');
            // Check if old image not null
            if($deleteImage != null) {
                // unlink(public_path('storage/carousel/'.$deleteImage));
                if (Storage::exists('public/carousel/'.$deleteImage)) {
                    Storage::delete('public/carousel/'.$deleteImage);
                }
            }

            // Get Image And Move to Public Path
            $file = $request->file('cover');
            $imageName = 'carousel_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/carousel');
            $file->move($destinationPath, $imageName);

            // Cut the image
            $image = Image::make(public_path("storage/carousel/{$imageName}"))->fit(1920, 1080);
            $image->save();
        } else {
            $imageName = null;
        }

        //Update Carousel
        Carousel::where('id', $id)->update(['cover' => $imageName]);

        return redirect('/carousel-event')->withStatus(__('Carousel event successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(carousel $carousel)
    {
        //
    }
}
