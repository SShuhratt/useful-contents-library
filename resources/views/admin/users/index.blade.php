@extends('layout')

@section('title', 'Manage Users')

@section('content')
    <div class="container py-5">
        <h1 class="mb-3">User Management</h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if ($user->role !== 'admin')
                            <form method="POST" action="{{ route('admin.users.promote', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Promote to Admin</button>
                            </form>

                            <form method="POST" action="{{ route('admin.users.demote', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">Demote to User</button>
                            </form>

                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete User
                                </button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Admin users cannot be deleted</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {!! $users->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
