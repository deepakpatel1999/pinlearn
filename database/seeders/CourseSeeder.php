<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'tutor_name' => 'Tuter',
                'price' => '50',
                'age' => '25',
                'introduction_video_link' => 'video.com',
                'description' => 'this is test',
                'cource_title' => 'Master Logos Bible Software to Supercharge ',
                'image' => 'test.png',
                'end_of_my_course' => 'this is demo',
                'should_take' => 'this is test',
                'students_need' => 'this is test'
            ],
            [
                'tutor_name' => 'Tuter1',
                'price' => '50',
                'age' => '25',
                'introduction_video_link' => 'video.com',
                'description' => 'this is test',
                'cource_title' => 'Master Logos Bible Software to Supercharge ',
                'image' => 'test.png',
                'end_of_my_course' => 'this is demo',
                'should_take' => 'this is test',
                'students_need' => 'this is test'
            ],
        ];

        foreach ($users as $key => $user) {
            $course = Course::create($user);
        }
    }
}
