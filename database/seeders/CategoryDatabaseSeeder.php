<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            [
                'name' => 'Men',
                'sub_categories' => [
                    'Clothes',
                    'Glasses',
                    'Watches',
                ]
            ], [
                'name' => 'Women',
                'sub_categories' => [
                    'Accessories',
                    'Makeup',
                ]
            ], [
                'name' => 'Kids',
                'sub_categories' => [
                    'Clothes',
                    'Games',
                ]
            ],
        ];

        foreach ($categories as $category) {
            $row = Category::create([
                'name' => $category['name'],
            ]);

            foreach ($category['sub_categories'] as $sub_category) {
                Category::create([
                    'name' => $sub_category,
                    'parent_category' => $row->id,
                ]);
            }
        }
    }
}
