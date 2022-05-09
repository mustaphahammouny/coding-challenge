<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        Product::factory()
            ->count(50)
            ->sequence(function ($sequence) {
                return ['name' => 'Product ' . ($sequence->index + 1)];
            })
            ->create()
            ->each(function ($product, $key) {
                if (rand(0, 1)) {
                    $random = Category::inRandomOrder()->limit(rand(1, 5))->get();
                    $product->categories()->sync($random);
                }
            });
    }
}
