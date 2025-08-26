<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        Admin::firstOrCreate(
            ['email' => 'admin@modashop.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'),
            ]
        );

        // Create sample categories if not exist
        $categories = [
            'ملابس رجالية',
            'ملابس نسائية',
            'أحذية',
            'حقائب',
            'إكسسوارات',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Create sample products using actual images from the project
        $products = [
            [
                'name' => 'قميص رجالي كلاسيك',
                'description' => 'قميص رجالي أنيق مناسب للمناسبات الرسمية، مصنوع من القطن عالي الجودة',
                'price' => 299.99,
                'stock' => 50,
                'category_id' => 1,
                'image' => 'product-img-1.jpg'
            ],
            [
                'name' => 'فستان نسائي أنيق',
                'description' => 'فستان نسائي أنيق مناسب للحفلات والمناسبات، تصميم عصري وجذاب',
                'price' => 599.99,
                'stock' => 30,
                'category_id' => 2,
                'image' => 'product-img-2.jpg'
            ],
            [
                'name' => 'حذاء رياضي مريح',
                'description' => 'حذاء رياضي مريح مناسب للرياضة والتنزه، يوفر الراحة والدعم المثالي',
                'price' => 199.99,
                'stock' => 100,
                'category_id' => 3,
                'image' => 'product-img-3.jpg'
            ],
            [
                'name' => 'جاكيت رجالي أنيق',
                'description' => 'جاكيت رجالي أنيق مناسب للخريف والشتاء، مصنوع من الصوف الطبيعي',
                'price' => 899.99,
                'stock' => 25,
                'category_id' => 1,
                'image' => 'product-img-4.jpg'
            ],
            [
                'name' => 'بلوزة نسائية عصرية',
                'description' => 'بلوزة نسائية عصرية بتصميم أنيق، مناسبة للعمل والمناسبات اليومية',
                'price' => 399.99,
                'stock' => 40,
                'category_id' => 2,
                'image' => 'product-img-5.jpg'
            ],
            [
                'name' => 'حذاء رسمي كلاسيك',
                'description' => 'حذاء رسمي كلاسيك مناسب للمناسبات الرسمية والعمل، جودة عالية',
                'price' => 449.99,
                'stock' => 35,
                'category_id' => 3,
                'image' => 'product-img-6.jpg'
            ],
            [
                'name' => 'بنطلون جينز رجالي',
                'description' => 'بنطلون جينز رجالي عالي الجودة، مريح ومناسب للاستخدام اليومي',
                'price' => 349.99,
                'stock' => 60,
                'category_id' => 1,
                'image' => '1.jpg'
            ],
            [
                'name' => 'تنورة نسائية أنيقة',
                'description' => 'تنورة نسائية أنيقة بتصميم عصري، مناسبة للعمل والحفلات',
                'price' => 279.99,
                'stock' => 45,
                'category_id' => 2,
                'image' => '2.jpg'
            ],
            [
                'name' => 'حقيبة يد نسائية',
                'description' => 'حقيبة يد نسائية أنيقة، مصنوعة من الجلد الطبيعي عالي الجودة',
                'price' => 799.99,
                'stock' => 20,
                'category_id' => 4,
                'image' => '3.jpg'
            ],
            [
                'name' => 'ساعة يد أنيقة',
                'description' => 'ساعة يد أنيقة بتصميم عصري، مناسبة للرجال والنساء',
                'price' => 1299.99,
                'stock' => 15,
                'category_id' => 5,
                'image' => '4.jpg'
            ],
            [
                'name' => 'نظارة شمس عصرية',
                'description' => 'نظارة شمس عصرية بتصميم أنيق، تحمي من أشعة الشمس الضارة',
                'price' => 199.99,
                'stock' => 80,
                'category_id' => 5,
                'image' => '5.jpg'
            ],
            [
                'name' => 'حزام جلد طبيعي',
                'description' => 'حزام جلد طبيعي عالي الجودة، مناسب للرجال والنساء',
                'price' => 149.99,
                'stock' => 70,
                'category_id' => 5,
                'image' => '6.jpg'
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Admin Email: admin@modashop.com');
        $this->command->info('🔑 Admin Password: password123');
        $this->command->info('🛍️  Created ' . count($products) . ' products with actual images');
    }
}
