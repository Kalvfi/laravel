<ul class="ml-4 list-disc">

    @foreach ($categories as $category)
        <li class="mb-1">

            <a href="{{ route('categories.show', $category) }}">
                {{ $category->name }}
            </a>

            @if ($category->children->count())
                <x-category-tree :categories="$category->children" />
            @endif

        </li>
    @endforeach

</ul>
