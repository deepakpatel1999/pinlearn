<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category_subject;

class Category_subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_subjects = [

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

        foreach ($category_subjects as $key => $category_subject) {
            Category_subject::create($category_subject);
        }
    }
}
