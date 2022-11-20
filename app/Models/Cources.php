<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cources extends Model
{
    use HasFactory;
    protected $fillable = [
        'tutor_name',
        'price',
        'age',
        'introduction_video_link',
        'description',
        'cource_title',
        'image',
        'end_of_my_course',
        'should_take'

    ];
}
