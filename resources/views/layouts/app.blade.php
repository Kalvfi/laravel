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

        <!-- Sidebars -->
        <aside class="w-64 bg-white p-4">
            <h2 class="text-xl font-bold mb-4">Categories</h2>

            @include('components.category-tree', [
                'categories' => $sidebarCategories,
            ])
        </aside>

        <!-- Page Content -->
        <main class="flex-1 p-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
