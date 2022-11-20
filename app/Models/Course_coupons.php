<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_coupons extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'name',
        'coupon_code',
        'maximum_number',
        'start_date',
        'end_date',
        'money_discount',

    ];
}
