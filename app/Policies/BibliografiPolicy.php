<?php

namespace App\Policies;

use App\User;
use App\Bibliografi;
use Illuminate\Auth\Access\HandlesAuthorization;

class BibliografiPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any bibliografis.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->user()->level === 2;
    }

    /**
     * Determine whether the user can view the bibliografi.
     *
     * @param  \App\User  $user
     * @param  \App\Bibliografi  $bibliografi
     * @return mixed
     */
    public function view(User $user, Bibliografi $bibliografi)
    {
        // return $user->level == 2;
    }

    /**
     * Determine whether the user can create bibliografis.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // return $user->level == 1;
    }

    /**
     * Determine whether the user can update the bibliografi.
     *
     * @param  \App\User  $user
     * @param  \App\Bibliografi  $bibliografi
     * @return mixed
     */
    public function update(User $user, Bibliografi $bibliografi)
    {
        //
    }

    /**
     * Determine whether the user can delete the bibliografi.
     *
     * @param  \App\User  $user
     * @param  \App\Bibliografi  $bibliografi
     * @return mixed
     */
    public function delete(User $user, Bibliografi $bibliografi)
    {
        //
    }

    /**
     * Determine whether the user can restore the bibliografi.
     *
     * @param  \App\User  $user
     * @param  \App\Bibliografi  $bibliografi
     * @return mixed
     */
    public function restore(User $user, Bibliografi $bibliografi)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the bibliografi.
     *
     * @param  \App\User  $user
     * @param  \App\Bibliografi  $bibliografi
     * @return mixed
     */
    public function forceDelete(User $user, Bibliografi $bibliografi)
    {
        //
    }
}
