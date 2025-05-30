<header class="bg-white shadow p-4 flex flex-wrap justify-between items-center">
    <a href="/" class="text-xl font-bold mr-4">Logo</a>
    @include('components.navbar')
    <div class="mt-2 sm:mt-0">
        <a href="{{ route('login') }}" class="border px-4 py-2 rounded mr-2">Login</a>
        <a href="{{ route('register') }}" class="border px-4 py-2 rounded">Register</a>
    </div>
</header>

