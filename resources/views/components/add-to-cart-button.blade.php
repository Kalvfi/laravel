@if ($product->stock > 0)
    <form action="{{ route('cart.add') }}" method="POST" class="flex items-center">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">

        <button type="submit" class="flex items-center gap-2 p-2">
            <x-pixelicon-plus /> Add to Cart
        </button>
    </form>
@else
    <button disabled class="flex items-center gap-2 bg-gray-400 rounded text-white p-2 cursor-not-allowed">
        <x-pixelicon-times /> Out of Stock
    </button>
@endif
