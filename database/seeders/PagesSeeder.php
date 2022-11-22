<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pages;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Pages = [
            [
                'title' => 'Terms and Conditions',
                'alias' => 'terms',
                'content' => 'Lorem Ipsum is simpl...',

            ],
            [

                'title' => 'refund-policy',
                'alias' => 'refund-policy',
                'content' => 'Lorem Ipsum is simpl...',


            ],

        ];

        foreach ($Pages as $key => $Page) {
            Pages::create($Page);
        }
    }
}
