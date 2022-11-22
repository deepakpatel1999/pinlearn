<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = [
            [
              'name' => 'Juz Amma',
              'alias' => 'JuzAmma',
              'ordering' => '1',
              'image' => 'test.png',
              'status' => '1',

            ],
            [
                'name' => 'Qaida',
                'alias' => 'Qaida',
                'ordering' => '1',
                'image' => 'test.png',
                'status' => '1',

              ],
              [
                'name' => 'Business - business-related-course',
                'alias' => 'Business - business-related-course',
                'ordering' => '1',
                'image' => 'test.png',
                'status' => '1',
                 ],

          ];

        foreach ($categorie as $key => $categories) {
            Categories::create($categories);
        }
    }
}
