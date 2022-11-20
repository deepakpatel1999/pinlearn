<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_section extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'ordering',
        'trial_video'
    ];
}
