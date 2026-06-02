<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow mt-8">

        <h2 class="text-2xl font-bold mb-6">
            {{ $category->exists ? 'Edit Category' : 'Create New Category' }}
        </h2>

        <form
            action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
            method="POST">
            @csrf

            @if ($category->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border p-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Parent Category</label>
                <select name="parent_id" class="w-full border p-2">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="flex items-center gap-2 bg-green-600 text-white p-2 rounded">
                <x-pixelicon-save />
                {{ $category->exists ? 'Update Category' : 'Save Category' }}
            </button>
        </form>
    </div>
</x-app-layout>
