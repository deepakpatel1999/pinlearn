<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Subject = [
            [

                'name' => 'Food & Beverages',
                'alias' => 'Food & Beverages',
                'status' => '1',

            ],

            [

                'name' => 'Rock',
                'alias' => 'Rock',
                'status' => '1',

            ],
            [

                'name' => 'First Aid',
                'alias' => 'First Aid',
                'status' => '1',
            ],

        ];

        foreach ($Subject as $key => $Subjects) {
            Subject::create($Subjects);
        }
    }
}
