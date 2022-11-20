<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_lecture extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'section_id',
        'title',
        'description',
        'ordering',
        'video'
    ];
}

