<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Grades = [
            [
              'title' => 'Grade 1',
              'alias' => 'Grade 1',
              'ordering' => '1',
              'schole_type' => 'Elementary',
              'discription' => 'this is discription',

            ],
            [
                'title' => 'Grade 2',
                'alias' => 'Grade 2',
                'ordering' => '1',
                'schole_type' => 'Elementary',
                'discription' => 'this is discription',
              ],

          ];

        foreach ($Grades as $key => $Grade) {
            Grade::create($Grade);
        }
    }
}
