<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category_topic;
class Category_topicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_topic = [
            [
                'topics_id' => '1',
                'categories_id' => '1',


            ],
            [
                'topics_id' => '1',
                'categories_id' => '2',


            ],
            [
                'topics_id' => '1',
                'categories_id' => '3',

            ],

          ];

        foreach ($category_topic as $key => $category_topics) {
            Category_topic::create($category_topics);
        }
    }
}
