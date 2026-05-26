<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-row">

        <!-- Sidebar -->
        <aside class="w-64 bg-white p-4 flex flex-col gap-4">
            <div>
                <h2 class="text-xl font-bold mb-4"><a href="{{ route('home') }}">Categories</a></h2>
                <x-category-tree :categories="$sidebarCategories" />
            </div>

            @auth
                <a href="{{ route('cart.index') }}">
                    Cart
                </a>

                Logged in as:
                {{ Auth::user()->name }}

                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">
                        Admin
                    </a>
                @endif
            @endauth

            @guest
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endguest
        </aside>

        <!-- Page Content -->
        <main class="flex-1 p-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
