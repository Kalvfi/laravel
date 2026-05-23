<x-app-layout>
    <h1 class="text-2xl font-bold">Products</h1>

    @foreach ($products as $product)
        <div>
            <h2 class="text-xl font-bold"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h2>

            <p class="text-gray-600">{{ $product->description }}</p>

            <p class="text-lg font-bold">${{ number_format($product->price, 2) }}</p>

            <p class="text-gray-500">Category: {{ $product->category->name }}</p>
        </div>
    @endforeach
</x-app-layout>
