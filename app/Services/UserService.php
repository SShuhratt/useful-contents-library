<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getPaginatedUsers()
    {
        $currentUser = auth()->user();

        if ($currentUser->hasRole('superadmin')) {
            return User::paginate(10);
        }

        return User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->paginate(10);
    }


    public function promote(User $user)
    {
        if(auth()->user()->roles->pluck('name')->first()=='superadmin'){
            if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
                throw new \Exception('(Super)admin cannot be promoted');
            }
            $user->assignRole('admin');
        }
    }

    public function demote(User $user)
    {
        if(auth()->user()->roles->pluck('name')->first()=='superadmin'){
            if ($user->hasRole('superadmin') || $user->hasRole('user')) {
                throw new \Exception('(Super)admin and users cannot be demoted');
            }
            $user->assignRole('user');
        }
    }

    public function delete(User $user)
    {
        if (($user->hasRole('admin') || $user->hasRole('superadmin')) && (auth()->user()->roles->pluck('name')->first()!='superadmin')) {
            return '(Super)admin cannot be deleted';
        }
        elseif ($user->hasRole('superadmin') && auth()->user()->roles->pluck('name')->first()=='superadmin') {
            return 'Superadmin cannot be deleted';
        }
        $user->delete();
        return true;
    }
}
