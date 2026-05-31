<div class="flex flex-col gap-4 mt-4">
    @foreach ($products as $product)
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-bold"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
            </h2>
            <p class="text-gray-600">{{ $product->description }}</p>
            <div class="flex flex-row justify-between">
                <p class="text-lg font-bold">${{ number_format($product->price, 2) }}</p>
                <div class="flex flex-row gap-4">
                    <p class="text-sm text-gray-500">In stock: {{ $product->stock }}</p>
                    <p class="text-sm text-gray-500">Category: <a
                            href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
