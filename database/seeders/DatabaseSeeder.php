<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 1 Admin user
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        // Create 10 Customer users
        $customers = User::factory(10)->create();

        // Create 5 Categories
        $categories = Category::factory(5)->create();

        // Create 20 Products distributed across categories
        $products = collect();
        foreach ($categories as $category) {
            $products = $products->merge(
                Product::factory(4)->create([
                    'category_id' => $category->id,
                ])
            );
        }

        // Create 15 Orders with OrderItems
        Order::factory(15)->create([
            'user_id' => fn () => $customers->random()->id,
        ])->each(function (Order $order) use ($products) {
            $itemCount = rand(1, 4);
            $selectedProducts = $products->random($itemCount);
            $totalAmount = 0;

            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $totalAmount += $quantity * $price;

                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        });
    }
}
