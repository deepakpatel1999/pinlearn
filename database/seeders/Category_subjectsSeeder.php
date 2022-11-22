<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category_subject;

class Category_subjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_subject = [

            [
                'subjects_id' => '1',
                'categories_id' => '1',


              ],
              [
                  'subjects_id' => '1',
                  'categories_id' => '2',


                ],
                [
                  'subjects_id' => '1',
                  'categories_id' => '3',

                   ],

        ];

        foreach ($category_subject as $key => $category_subjects) {
            Category_subject::create($category_subjects);
        }
    }
}
