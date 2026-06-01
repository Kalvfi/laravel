<div class="flex flex-row items-center gap-2">
    <form action="{{ route('cart.remove') }}" method="POST">
        @csrf
        @method('DELETE') <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
        <input type="hidden" name="quantity" value="1">

        <button type="submit" class="flex items-center justify-center">
            <x-pixelicon-angle-down />
        </button>
    </form>

    <span class="font-bold text-lg">{{ $cartItem->quantity }}</span>

    <form action="{{ route('cart.add') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
        <input type="hidden" name="quantity" value="1">

        <button type="submit" class="flex items-center justify-center">
            <x-pixelicon-angle-up />
        </button>
    </form>
</div>
