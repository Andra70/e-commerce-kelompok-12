<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Categories (Phone Brands)
        $categories = ['Samsung', 'iPhone', 'Xiaomi', 'Oppo', 'Vivo', 'Realme', 'Infinix', 'Google Pixel'];
        foreach ($categories as $cat) {
            ProductCategory::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'description' => 'Latest smartphones from ' . $cat, 
            ]);
        }

        // 3. Create Sellers and Stores
        $seller = User::factory()->create([
            'name' => 'Seller One',
            'email' => 'seller@example.com',
            'role' => 'member', // Sellers are members with a store
            'password' => Hash::make('password'),
        ]);

        $store = Store::create([
            'user_id' => $seller->id,
            'name' => 'Gadget Store HQ',
            'logo' => 'logo.png',
            'about' => 'Your trusted source for original smartphones.',
            'phone' => '081234567890',
            'address_id' => '123',
            'city' => 'Jakarta',
            'address' => 'Jalan Gadget No. 1',
            'postal_code' => '12345',
            'is_verified' => true,
        ]);

        // 4. Create Products for the Store
        $catSamsung = ProductCategory::where('slug', 'samsung')->first();
        
        $product1 = Product::create([
            'store_id' => $store->id,
            'product_category_id' => $catSamsung->id,
            'name' => 'Samsung Galaxy S24 Ultra',
            'slug' => 'samsung-galaxy-s24-ultra',
            'description' => 'The ultimate Galaxy smartphone with AI features, titanium frame, and S-Pen.',
            'condition' => 'new',
            'price' => 21999000,
            'weight' => 232,
            'stock' => 50,
        ]);
        
        ProductImage::create([
            'product_id' => $product1->id,
            'image' => 'products/dummy-s24.jpg', // Placeholder, user might need to upload real later or we use default
            'is_thumbnail' => true,
        ]);

        // 5. Create Buyer
        User::factory()->create([
            'name' => 'Buyer Doe',
            'email' => 'buyer@example.com',
            'role' => 'member',
            'password' => Hash::make('password'),
        ]);
    }
}
