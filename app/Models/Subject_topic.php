<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topics_id',
        'subjects_id'

    ];
}
