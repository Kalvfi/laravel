<div class="flex flex-col gap-4 mt-4">
    @foreach ($products as $product)
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-bold"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
            </h2>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-lg font-bold">${{ number_format($product->price, 2) }}</p>
        </div>
    @endforeach
</div>
