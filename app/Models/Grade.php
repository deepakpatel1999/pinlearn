<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'alias',
        'ordering',
        'school_type',
        'discription'

    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
