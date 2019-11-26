<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use App\Profile;
use App\UsersStatus;
use App\Bibliografi;
use App\Book;
use App\Transaction;
use App\Fine;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;

use PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index($id)
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

        if ($id === 'user') {
            $data = User::where('level', 4)
                ->latest('id')
                ->paginate(15);
        } else if ($id === 'admin') {
            $data = User::whereIn('level', [2, 3])
                ->latest('id')
                ->paginate(15);
        } else {
            return abort(404);
        }
        
        
        return view('users.index', [
            'users' => $data,
            'id' => $id,
            'total_koleksi' => $total_koleksi,
            'total_buku' => $total_buku,
            'total_peminjaman' => $total_peminjaman,
            'total_anggota' => $total_anggota,
        ]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        return view('users.create', ['id' => $id]);
    }

    public function show($id)
    {
        
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        $id = strtotime('now');

        User::create([
            'kode_anggota' => $id,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'alamat' => $request->get('alamat'),
            'provinsi' => $request->get('provinsi'),
            'kode' => $request->get('kode'),
            'kode_pos' => $request->get('kode_pos'),
            'warga_negara' => $request->get('warga_negara'),
            'level' => $request->get('level'),
            'staus' => 'active',
        ]);

        if ($request->get('level') == 4) {
            $link = '/data/user';
        } else {
            $link = '/data/admin';
        }
        
        // $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect($link)->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        if (auth()->user()->level == 4) {
            return abort(401);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        $level = $user->level;
        if ($level == 4) {
            $link = '/data/user';
        } else {
            $link = '/data/admin';
        }

        User::where('id', $user->id)->update([
            'name' => $request->get('name'),
            'alamat' => $request->get('alamat'),
            'provinsi' => $request->get('provinsi'),
            'kode' => $request->get('kode'),
            'kode_pos' => $request->get('kode_pos'),
            'email' => $request->get('email'),
        ]);
        
        // $user->update(
        //     $request->merge(['password' => Hash::make($request->get('password'))])
        //         ->except([$request->get('password') ? '' : 'password']
        // ));

        return redirect($link)->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $user_id)
    {
        if (auth()->user()->level == 4) {
            return abort(403);
        }

        User::where('id', $user_id)->delete();
        if ($id === 'admin') {
            return redirect('/data/admin')->withStatus(__('User successfully deleted.'));
        } else {
            return redirect('/data/user')->withStatus(__('User successfully deleted.'));
        }
        

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function error($data) {
        return abort(404);
    }

    public function updateStatus($user, $status, $id)
    {
        if (auth()->user()->level != 1) {
            return abort(403);
        }

        if ($user != 'user' && $user != 'admin') {
            return abort(404);
        }

        User::where('id', $id)->update([
            'status' => $status
        ]);

        // Return to master data index
        if ($user === 'user') {
            $statusSession = "User status successfully " . $status;

            return redirect('/data/user')->withStatus($statusSession);
        } else if ($user === 'admin') {
            $statusSession = "Admin status successfully " . $status;

            return redirect('/data/admin')->withStatus($statusSession);
        }
    }

    public function id_card($id)
    {
        $user = User::where('id', $id)->first();
        $profile = Profile::where('user_id', $id)->first();

        return view('users.card', [
            'user' => $user,
            'profile' => $profile
        ]);

        // $print = PDF::loadView('users.card', [
        //     'user' => $user,
        //     'profile' => $profile
        // ]);

        // return $print->download('medium.pdf');

        // return $print->download('laporan-pegawai-pdf');
    }
}
