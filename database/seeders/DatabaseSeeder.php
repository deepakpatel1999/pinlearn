<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateUsersSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\SubjectSeeder;
//use Database\Seeders\Category_subjectSeeder;
use Database\Seeders\TopicSeeder;
use Database\Seeders\Subject_topicSeeder;
use Database\Seeders\Category_topicSeeder;
use Database\Seeders\CouponsSeeder;
use Database\Seeders\PagesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CreateUsersSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubjectSeeder::class);
       // $this->call(Category_subjectSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(Subject_topicSeeder::class);
        $this->call(Category_topicSeeder::class);
        $this->call(CouponsSeeder::class);
        $this->call(PagesSeeder::class);
    }
}
