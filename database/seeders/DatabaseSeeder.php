<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\LikedProduct;
use App\Models\User;
use App\Models\Category;
use App\Models\Admin\AdminSubCategory as SubCategory;
use App\Models\Admin\AdminRekening;

class DatabaseSeeder extends Seeder
{
    /**
     *  Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'name' => 'Admin1',
            'email' => 'admin1@yahoo.co.jp',
            'phone' => '089049572831',
            'date_of_birth' => now(),
            'role' => 'admin'
        ]);

        Category::create([
            'category_name' => 'Desain Arsitektur',
            // 'image' => 'Vintage.jpg'
        ]);

        Category::create([
            'category_name' => 'Desain Interior',
            // 'image' => 'Modern.jpg'
        ]);
        SubCategory::create([
            'subcategory_name' => 'Vintage',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'subcategory_name' => 'Modern',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'subcategory_name' => 'Skandinavia',
            'category_id' => 2,
        ]);
        SubCategory::create([
            'subcategory_name' => 'Classic',
            'category_id' => 2,
        ]);

        $product = Product::create([
            'product_name' => 'Desain Interior',
            // 'image' => 'Desain-Interior-Jawa-Modern.jpg',
            'price' => 200000,
            'discount' => 0.00,
            'sold' => 5500000,
            'viewers' => 100,
            'subcategory_id' => 1,
            'user_id' => 1,
        ]);

        ImageProduct::create([
            'product_id' => $product->id,
            'image' => 'karakter-interior-vintage-cover.jpg',
        ]);

        LikedProduct::create([
            'product_id' => 1,
            'user_id' => 1,
            'is_liked' => 1
        ]);

        $product1 = Product::create([
            'product_name' => 'Karakter Interior',
            'price' => 100000,
            'discount' => 0.00,
            'sold' => 152,
            'viewers' => 1500,
            'subcategory_id' => 2,
            'user_id' => 1,
        ]);

        ImageProduct::create([
            'product_id' => $product1->id,
            'image' => 'karakter-interior-vintage-cover.jpg',
        ]);

        $product2 = Product::create([
            'product_name' => 'Desain Interior 2',
            'price' => 50000,
            'discount' => 0.00,
            'sold' => 30500,
            'viewers' => 20100,
            'subcategory_id' => 2,
            'user_id' => 1,
        ]);

        ImageProduct::create([
            'product_id' => $product2->id,
            'image' => 'Desain-Interior-Jawa-Modern.jpg',
        ]);

        $product3 = Product::create([
            'product_name' => 'Karakter Interior 2',
            'price' => 120000,
            'discount' => 0.00,
            'sold' => 49,
            'viewers' => 150000,
            'subcategory_id' => 3,
            'user_id' => 1,
        ]);

        ImageProduct::create([
            'product_id' => $product3->id,
            'image' => 'karakter-interior-vintage-cover.jpg',
        ]);

        $product4 = Product::create([
            'product_name' => 'Interior Jawa',
            'price' => 440000,
            'discount' => 0.00,
            'sold' => 190230,
            'viewers' => 1200000,
            'subcategory_id' => 4,
            'user_id' => 1,
        ]);

        ImageProduct::create([
            'product_id' => $product4->id,
            'image' => 'Desain-Interior-Jawa-Modern.jpg',
        ]);

        AdminRekening::create([
            'bank' => 'BRI',
            'no_rek' => '1510203050',
            'atas_nama' => 'Udin'
        ]);

        AdminRekening::create([
            'bank' => 'BCA',
            'no_rek' => '1015030591',
            'atas_nama' => 'Ujang'
        ]);

        AdminRekening::create([
            'bank' => 'BNI',
            'no_rek' => '0041516744',
            'atas_nama' => 'Asep'
        ]);
    }
}
