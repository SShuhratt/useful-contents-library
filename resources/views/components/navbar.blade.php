<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">Content Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('genres.index') }}">Genres</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('authors.index') }}">Authors</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contents.index') }}">Contents</a></li>

                {{-- Show Admin Dashboard only for Admins --}}
                @if(auth()->user() && auth()->user()->isAdmin())
                    <li class="nav-item"><a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @endif
            </ul>

            {{-- Authentication Links --}}
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link text-success" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-success" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
</nav>
