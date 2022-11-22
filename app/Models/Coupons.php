<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'discount_type',
        'targe_type',
        'discount_value',
        'limit_number_of_use',
        'tutor_name',
        'courses_id',
        'webinar_id',
        'start_date',
        'end_date',
        'status',

    ];
}
