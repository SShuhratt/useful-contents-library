<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getPaginatedUsers()
    {
        return User::paginate(10);
    }

    public function promote(User $user)
    {
        // Ensure the user isn't already a superadmin
        if ($user->hasRole('superadmin')) {
            throw new \Exception('Superadmin cannot be promoted');
        }

        // Assign admin role
        $user->assignRole('admin');
    }

    public function demote(User $user)
    {
        // Demote user to 'user' role
        $user->syncRoles(['user']);
    }

    public function delete(User $user)
    {
        if ($user->hasRole('admin')) {
            return 'admin_blocked';  // Prevent deleting admins
        }

        $user->delete();
        return true;
    }
}
