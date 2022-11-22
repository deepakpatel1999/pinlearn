<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupons;
class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Coupons = [
            [
              'name' => 'ABEDD',
              'code' => '3030',
              'discount_type' => 'percent',
              'targe_type' => '50',
              'discount_value' => '10',
              'limit_number_of_use' => '11',
              'tutor_name' => 'dipesh',
              'courses_id' => '1',
              'webinar_id' => 'NULL',
              'start_date' => '12/12/2022',
              'end_date' => '20/12/2022y',
              'status' => '1',

            ],


          ];

        foreach ($Coupons as $key => $Coupon) {
            Coupons::create($Coupon);
        }
    }
}
