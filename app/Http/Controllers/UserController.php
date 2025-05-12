<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getPaginatedUsers();
        return view('admin.users.index', compact('users'));
    }

    public function promote(User $user)
    {
        Gate::authorize('promote-user');
        $this->userService->promote($user);

        return redirect()->route('admin.users.index')->with('success', 'User promoted to admin.');
    }

    public function demote(User $user)
    {
        Gate::authorize('demote-user');
        $this->userService->demote($user);

        return redirect()->route('admin.users.index')->with('success', 'User demoted to standard user.');
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete-user');

        $result = $this->userService->delete($user);

        if ($result === 'admin_blocked') {
            return redirect()->route('admin.users.index')->with('error', 'Admins cannot be deleted.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
