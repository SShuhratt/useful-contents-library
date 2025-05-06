<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function promote(User $user)
    {
        Gate::authorize('admin-actions');
        $user->update(['role' => 'admin']);

        return redirect()->route('admin.users.index')->with('success', 'User promoted to admin.');
    }

    public function demote(User $user)
    {
        Gate::authorize('admin-actions');
        $user->update(['role' => 'user']);

        return redirect()->route('admin.users.index')->with('success', 'User demoted to standard user.');
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin-actions');

        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Admins cannot be deleted.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
