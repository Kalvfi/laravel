<x-app-layout>
    <div class="bg-white p-4 rounded shadow">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        <p class="text-gray-600 my-1">{{ $product->description }}</p>
        <div class="flex flex-row justify-between items-center">
            <div class="flex flex-row gap-4 items-center">
                <p class="flex flex-row items-center text-lg font-bold">
                    <x-pixelicon-dollar />{{ number_format($product->price, 2) }}
                </p>
                <x-add-to-cart-button :product="$product" />
            </div>
            <div class="flex flex-row gap-4">
                <p class="text-sm text-gray-500">In stock: {{ $product->stock }}</p>
                <p class="text-sm text-gray-500">Category: <a
                        href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
