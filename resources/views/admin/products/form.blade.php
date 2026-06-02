<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow mt-8">

        <h2 class="text-2xl font-bold mb-6">
            {{ $product->exists ? 'Edit Product' : 'Create New Product' }}
        </h2>

        <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
            method="POST">
            @csrf

            @if ($product->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border p-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full border p-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                        class="w-full border p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="w-full border p-2" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Category</label>
                <select name="category_id" class="w-full border p-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="flex items-center gap-2 bg-blue-600 text-white p-2 rounded">
                <x-pixelicon-save />
                {{ $product->exists ? 'Update Product' : 'Save Product' }}
            </button>
        </form>
    </div>
</x-app-layout>
