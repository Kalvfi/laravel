<x-app-layout>
    <div class="grid grid-cols-2 gap-8 p-6">

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Products</h2>
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2 bg-blue-600 text-white p-2 rounded">
                    <x-pixelicon-plus />
                    Add Product
                </a>
            </div>

            <table class="w-full text-left border-collapse border bg-white border-gray-300 shadow">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Price</th>
                        <th class="border p-2">Stock</th>
                        <th class="border p-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border p-2">{{ $product->id }}</td>
                            <td class="border p-2">{{ $product->name }}</td>
                            <td class="border p-2">{{ $product->category->name ?? 'None' }}</td>
                            <td class="border p-2">${{ $product->price }}</td>
                            <td class="border p-2">{{ $product->stock }}</td>
                            <td class="border p-2 flex flex-row justify-evenly space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="flex items-center gap-1 text-blue-600">
                                    <x-pixelicon-pencil />
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 text-red-600"
                                        onclick="return confirm('Delete this product?')">
                                        <x-pixelicon-trash />
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Categories</h2>
                <a href="{{ route('admin.categories.create') }}"
                    class="flex items-center gap-2 bg-green-600 text-white p-2 rounded">
                    <x-pixelicon-plus />
                    Add Category
                </a>
            </div>

            <table class="w-full text-left border-collapse border bg-white border-gray-300 shadow">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Parent</th>
                        <th class="border p-2 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="border p-2">{{ $category->id }}</td>
                            <td class="border p-2">{{ $category->name }}</td>
                            <td class="border p-2">{{ $category->parent->name ?? 'None' }}</td>
                            <td class="border p-2 flex flex-row justify-evenly space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="flex items-center gap-1 text-blue-600">
                                    <x-pixelicon-pencil />
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 text-red-600"
                                        onclick="return confirm('Delete this category?')">
                                        <x-pixelicon-trash />
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
