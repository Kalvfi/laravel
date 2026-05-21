<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::create([
            'name' => 'Electronics',
        ]);

        Category::factory()
            ->count(5)
            ->childOf($electronics)
            ->create();

        $books = Category::create([
            'name' => 'Books',
        ]);

        Category::factory()
            ->count(5)
            ->childOf($books)
            ->create();

        Category::factory()
            ->count(5)
            ->childOf($books->children()->first())
            ->create();
    }
}
