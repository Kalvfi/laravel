<x-app-layout>
    <h1 class="text-2xl font-bold">{{ $category->name }}</h1>

    <x-product-list :products="$products" />
</x-app-layout>
