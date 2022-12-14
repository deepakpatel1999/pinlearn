<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'ordering',
        'image',
        'status'

    ];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
