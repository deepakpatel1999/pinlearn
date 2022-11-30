<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'grades_id'
    ];
}
