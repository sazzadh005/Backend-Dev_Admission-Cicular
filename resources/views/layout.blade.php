@php
    $user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Circular Manager</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Roboto', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    @section('header')
    <nav class="bg-blue-700">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center">
            <a class="text-white font-bold text-xl tracking-wide" href="{{ route('circulars.index') }}">Admission Circular Manager</a>
            <div class="ml-auto flex items-center space-x-4">
                @auth
                    {{-- Links for logged-in users --}}
                    <a href="{{ route('users.show', $user->id) }}" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                        Profile
                    </a>
                    <a href="{{ route('circulars.create') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                        Create Post
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                            Logout
                        </button>
                    </form>
                @else
                    {{-- Links for guests (not logged in) --}}
                    <a href="{{ route('login') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                        Log In
                    </a>
                    <a href="{{ route('users.create') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    @show

    <div class="flex flex-1">
        <aside class="hidden md:block w-64 bg-white shadow min-h-screen py-8">
            <ul class="space-y-2 px-4">
                @auth
                    {{-- Links for logged-in users --}}
                    @if ($user->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-4 py-2 rounded-lg font-medium transition
                               {{ request()->is('admin/dashboard') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                               class="block px-4 py-2 rounded-lg font-medium transition
                               {{ request()->is('users') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                                Users
                            </a>
                        </li>
                    @else
                        {{-- Profile link for regular users --}}
                        <li>
                            <a href="{{ route('users.show', $user->id) }}"
                               class="block px-4 py-2 rounded-lg font-medium transition
                               {{ request()->is('users/' . $user->id) ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                                My Profile
                            </a>
                        </li>
                    @endif
                    {{-- Circulars link for all logged-in users --}}
                    <li>
                        <a href="{{ route('circulars.index') }}"
                           class="block px-4 py-2 rounded-lg font-medium transition
                           {{ request()->is('circulars*') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                            Circulars
                        </a>
                    </li>
                @else
                    {{-- Links for guests (not logged in) --}}
                    <li>
                        <a href="{{ route('login') }}"
                           class="block px-4 py-2 rounded-lg font-medium transition
                           {{ request()->is('login') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                            Log In
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}"
                           class="block px-4 py-2 rounded-lg font-medium transition
                           {{ request()->is('users/create') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                            Register
                        </a>
                    </li>

                @endauth
            </ul>
            @if(auth()->check() && auth()->user()->role === 'admin')
            <ul class="px-4 mt-auto">
                <li>
                    <a href="{{ url('/settings') }}"
                       class="block px-4 py-2 rounded-lg font-medium transition text-blue-700 hover:bg-blue-50
                       {{ request()->is('settings*') ? 'bg-blue-100 text-blue-800' : 'text-blue-700 hover:bg-blue-50' }}">
                        Settings
                    </a>
                </li>
            </ul>
            @endif
        </aside>
        
        <main class="flex-1 p-8">
            {{-- Session alerts section --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    <footer class="bg-blue-700 text-white text-center py-4 mt-auto">
        &copy; {{ date('Y') }} Admission Circular Manager. All rights reserved.
    </footer>
</body>
</html>