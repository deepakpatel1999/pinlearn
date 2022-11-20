<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = [
        //     [
        //        'name'=>'Admin User',
        //        'email'=>'admin@gmail.com',
        //        'type'=>1,
        //        'password'=> bcrypt('12345678'),
        //     ],
        //     [
        //        'name'=>'Manager User',
        //        'email'=>'manager@gmail.com',
        //        'type'=> 2,
        //        'password'=> bcrypt('12345678'),
        //     ],
        //     [
        //        'name'=>'User',
        //        'email'=>'user@gmail.com',
        //        'type'=>0,
        //        'password'=> bcrypt('12345678'),
        //     ],
        // ];
        $users = [
            [
              'name' => 'Admin',
              'type' => '1',
              'user_name' => 'deepak',
              'timezone' => 'test',
              'email' => 'admin@gmail.com',
              'email_verified_at' => 'admin@gmail.com',
              'password' => bcrypt('12345678'),
              'image' => 'test.png',
              'Zoom_activation' => 'test',
              'Phone' => '12345678',
              'country' => 'india',
              'city' => 'indore',
              'address' => 'indore',
              'Zipcode' => '451002',
              'language' => 'english',
              'video_id' => 'youtub.com',
              'commition_rate' => '10',
              'biography' => 'test',
              'status' => '1',
              'phone_verified_at' => '1',
              'in_hone_page' => '1',
              'featured' => '1',
            ],
            
            [
                'name' => 'Tutor',
                'type' => '1',
                'user_name' => 'dipesh',
                'timezone' => 'test',
                'email' => 'tutor@gmail.com',
                'email_verified_at' => 'tutor@gmail.com',
                'password' => bcrypt('12345678'),
                'image' => 'test.png',
                'Zoom_activation' => 'test',
                'Phone' => '12345678',
                'country' => 'india',
                'city' => 'indore',
                'address' => 'indore',
                'Zipcode' => '451002',
                'language' => 'english',
                'video_id' => 'youtub.com',
                'commition_rate' => '10',
                'biography' => 'test',
                'status' => '1',
                'phone_verified_at' => '1',
                'in_hone_page' => '1',
                'featured' => '1',
            ],
            [
                'name' => 'User',
                'type' => '1',
                'user_name' => 'user',
                'timezone' => 'test',
                'email' => 'user@gmail.com',
                'email_verified_at' => 'user@gmail.com',
                'password' => bcrypt('12345678'),
                'image' => 'test.png',
                'Zoom_activation' => 'test',
                'Phone' => '12345678',
                'country' => 'india',
                'city' => 'indore',
                'address' => 'indore',
                'Zipcode' => '451002',
                'language' => 'english',
                'video_id' => 'youtub.com',
                'commition_rate' => '10',
                'biography' => 'test',
                'status' => '1',
                'phone_verified_at' => '1',
                'in_hone_page' => '1',
                'featured' => '1',
            ],
          ];
        
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
