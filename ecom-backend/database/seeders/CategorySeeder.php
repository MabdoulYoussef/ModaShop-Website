<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories
        Category::truncate();

        // Create new categories
        $categories = [
            [
                'name' => 'حقائب',
                'image' => null, // You can add image paths here later
            ],
            [
                'name' => 'طقم مكون من قطعتين',
                'image' => null,
            ],
            [
                'name' => 'عباية',
                'image' => null,
            ],
            [
                'name' => 'فساتين',
                'image' => null,
            ],
            [
                'name' => 'كيمونوا',
                'image' => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
