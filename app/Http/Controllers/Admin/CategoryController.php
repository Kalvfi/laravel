<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form', [
            'category' => new Category(),
            'categories' => Category::where('id', '!=', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        Category::create($validated);

        return redirect()->route('admin.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $forbiddenIds = $this->getDescendantIds($category);

        $forbiddenIds[] = $category->id;

        $availableCategories = Category::whereNotIn('id', $forbiddenIds)->get();

        return view('admin.categories.form', [
            'category' => $category,
            'categories' => $availableCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($category->id === 1) {
            return redirect()->route('admin.index')->with('error', 'You cannot edit the default root category.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        if ($validated['parent_id']) {
            $forbiddenIds = $this->getDescendantIds($category);

            $forbiddenIds[] = $category->id;

            if (in_array($validated['parent_id'], $forbiddenIds)) {
                return redirect()->back()
                    ->withErrors(['parent_id' => 'Cycle detected: A category cannot be assigned as a child of itself or any of its own subcategories.'])
                    ->withInput();
            }
        }

        $category->update($validated);

        return redirect()->route('admin.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->id === 1) {
            return redirect()->route('admin.index')->with('error', 'You cannot delete the default root category.');
        }

        DB::transaction(function () use ($category) {
            $fallbackCategoryId = $category->parent_id ?? 1;

            Product::where('category_id', $category->id)
                ->update(['category_id' => $fallbackCategoryId]);

            $this->reassignAndDeleteDescendants($category, $fallbackCategoryId);

            $category->delete();
        });

        return redirect()->route('admin.index')->with('success', 'Category tree deleted and products reassigned.');
    }

    /**
     * Recursively fetches all descendant IDs to prevent circular nesting.
     */
    private function getDescendantIds(Category $category)
    {
        $ids = [];
        $subcategories = Category::where('parent_id', $category->id)->get();

        foreach ($subcategories as $sub) {
            $ids[] = $sub->id;
            $ids = array_merge($ids, $this->getDescendantIds($sub));
        }

        return $ids;
    }

    /**
     * Recursively travels to the bottom of the category tree, reassigns products, and deletes categories from the bottom-up.
     */
    private function reassignAndDeleteDescendants(Category $category, int $fallbackCategoryId)
    {
        $subcategories = Category::where('parent_id', $category->id)->get();

        foreach ($subcategories as $sub) {
            $this->reassignAndDeleteDescendants($sub, $fallbackCategoryId);

            Product::where('category_id', $sub->id)
                ->update(['category_id' => $fallbackCategoryId]);

            $sub->delete();
        }
    }
}
