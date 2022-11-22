<?php

namespace Database\Seeders;

use App\Models\Topics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = [
            [
                'name' => 'Choking - ag',
                'alias' => 'Choking - ag',
                'ordering' => '1',


            ],
            [
                'name' => 'Workout - ss-g7Uyg',
                'alias' => 'Workout - ss-g7Uyg',
                'ordering' => '1',


            ],
            [
                'name' => 'Workout - ss-33hok',
                'alias' => 'Workout - ss-33hok',
                'ordering' => '1',

            ],

          ];

        foreach ($topics as $key => $topic) {
            Topics::create($topic);
        }
    }
}
