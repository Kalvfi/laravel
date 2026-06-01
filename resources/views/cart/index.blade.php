<x-app-layout>
    <div class="flex flex-row gap-4 min-h-full">

        <!-- Cart Items -->
        <div class="flex flex-col flex-[2] gap-4 bg-white p-4 rounded shadow">
            <div class="flex flex-row justify-between items-center">
                <h2 class="text-2xl font-semibold">Your Cart</h2>
                <div class="flex flex-row gap-4 items-center">
                    <p class="text-lg text-gray-500">
                        {{ $cart->cartItems->count() }} items
                    </p>
                    <p class="text-lg font-bold">
                        Total: ${{ number_format($total, 2) }}
                    </p>
                </div>
            </div>
            <div class="flex justify-center h-full">
                @if ($cart && $cart->cartItems->count() > 0)
                    <div class="flex flex-col gap-2 w-full">
                        @foreach ($cart->cartItems as $item)
                            <div
                                class="flex flex-row justify-between items-center w-full bg-gray-100 p-4 rounded shadow">
                                <div>
                                    <h3 class="text-lg font-bold">{{ $item->product->name }}</h3>
                                    <p class="flex items-center gap-2 text-sm text-gray-500">Price:
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </p>
                                </div>
                                <x-cart-item-quantity :cartItem="$item" />
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="self-center">Your cart is empty.</p>
                @endif
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="flex flex-col flex-1 bg-white p-4 rounded shadow">
            <h2 class="text-2xl font-semibold">Checkout form</h2>

            <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Contact Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Shipping Address</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Street Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" required
                                placeholder="123 Main St, Apt 4B"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700">State /
                                    Province (Optional)</label>
                                <input type="text" name="state" id="state" value="{{ old('state') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="zip" class="block text-sm font-medium text-gray-700">ZIP / Postal
                                    Code</label>
                                <input type="text" name="zip" id="zip" value="{{ old('zip') }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input type="text" name="country" id="country" value="{{ old('country') }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-4 rounded shadow-lg text-xl transition-colors duration-200 ease-in-out">
                        Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
