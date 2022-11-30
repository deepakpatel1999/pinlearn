<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course_subject;

class CourseSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $course_subject= [
        [
            'course_id'=>1,
            'subject_id'=>1,
        ],
        [
            'course_id'=>1,
            'subject_id'=>2
        ],
        [
            'course_id'=>1,
            'subject_id'=>3
        ],
        [
            'course_id'=>2,
            'subject_id'=>1
        ],
    ];
    foreach($course_subject as $key => $course_subjects){
        $course= Course_subject::create($course_subjects);
    }
    }
}
