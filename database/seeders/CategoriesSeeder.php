<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [['name'=>'Category A' ,'sub_category_id'=>null] , ['name'=>'Category B' ,'sub_category_id'=>null]];
        Category::query()->insert($data);
    }
}
