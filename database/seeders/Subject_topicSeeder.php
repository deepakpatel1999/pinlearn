<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject_topic;
class Subject_topicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Subject_topic = [
            [
                'topics_id' => '1',
                'subjects_id' => '1',



            ],
            [
                'topics_id' => '1',
                'subjects_id' => '2',


            ],
            [
                'topics_id' => '1',
                'subjects_id' => '3',

            ],

          ];

        foreach ($Subject_topic as $key => $Subject_topics) {
            Subject_topic::create($Subject_topics);
        }
    }
}
