<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'subject_id'

    ];
}
