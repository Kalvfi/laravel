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
            <div class="flex flex-col gap-4 h-fit">

                <!-- Logged-in User -->
                @auth

                    <!-- User Information -->
                    <div class="flex flex-row justify-between items-center gap-4">
                        <p class="flex items-center gap-2">
                            <x-pixelicon-user /> {{ Auth::user()->name }}
                        </p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2">
                                <x-pixelicon-logout /> Logout
                            </button>
                        </form>
                    </div>

                    <!-- Functions -->
                    <div class="flex flex-row justify-between items-center gap-4">
                        <a href="{{ route('cart.index') }}" class="flex items-center gap-2">
                            <x-pixelicon-shopping-cart /> Cart
                        </a>

                        <!-- Admin -->
                        @if (Auth::user()->is_admin)
                            <a href="{{ route('admin.index') }}" class="flex items-center gap-2">
                                <x-pixelicon-edit /> Admin
                            </a>
                        @endif
                    </div>
                @endauth

                <!-- Guest User -->
                @guest
                    <div class="flex flex-row justify-between items-center gap-4">
                        <a href="{{ route('register') }}" class="flex items-center gap-2">
                            <x-pixelicon-user-plus /> Register
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center gap-2">
                            <x-pixelicon-login /> Login
                        </a>
                    </div>
                @endguest
            </div>

            <hr class="border-black" />

            <div>
                <h2 class="flex justify-between items-center text-xl font-bold mb-2">
                    Categories <a href="{{ route('home') }}"><x-pixelicon-home /> </a>
                </h2>

                <x-category-tree :categories="$sidebarCategories" />
            </div>
        </aside>

        <!-- Page Content -->
        <main class="flex-1 p-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
