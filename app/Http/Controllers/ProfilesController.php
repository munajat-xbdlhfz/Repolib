<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
Use App\User;
use App\Profile;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Profile $coba)
    {
        $profile = Profile::where('user_id', auth()->user()->id)->get();
        return view('profile.edit', compact('profile', 'coba'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        // Validate Image and File
        request()->validate([
            'profile' => 'image',
        ]);

        // Cek if image is null or not
        if (request('profile') != null) {
            // ---Delete Old Image---
            $deleteImage = Profile::where('user_id', auth()->user()->id)->value('foto');
            // Check if old image not null
            if($deleteImage != null) {
                // unlink(public_path('storage/profile/'.$deleteImage));
                if (Storage::exists('public/profile/'.$deleteImage)) {
                    Storage::delete('public/profile/'.$deleteImage);
                }
            }

            // Get Image And Move to Public Path
            $file = $request->file('profile');
            $imageName = 'profile_'.auth()->user()->kode_anggota.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/profile');
            $file->move($destinationPath, $imageName);

            // Cut the image
            $image = Image::make(public_path("storage/profile/{$imageName}"))->fit(800, 800); 
            $image->save();
        } else {
            $imageName = null;
        }

        $date = $request->get('tanggal_lahir');
        if ($date != null) {
            $date = date('Y-m-d', strtotime($date));
        }

        Profile::where('user_id', auth()->user()->id)->update([
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $date,
            'no_hp' => $request->get('no_hp'),
            'pekerjaan' => $request->get('pekerjaan'),
            'pendidikan' => $request->get('pendidikan'),
        ]);

        if ($imageName != null) {
            Profile::where('user_id', auth()->user()->id)->update([
                'foto' => $imageName,
            ]);
        }
        
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
