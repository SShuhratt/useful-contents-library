<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Ensures only authenticated users access API
    }

    public function promote(User $user)
    {
        Gate::authorize('admin-actions'); // Restricts to admins

        $user->update(['role' => 'admin']);
        return response()->json(['message' => 'User promoted to admin'], 200);
    }

    public function demote(User $user)
    {
        Gate::authorize('admin-actions'); // Restricts to admins

        $user->update(['role' => 'user']);
        return response()->json(['message' => 'User demoted to standard user'], 200);
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin-actions'); // Restricts to admins

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
