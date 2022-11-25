<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'alias',
        'ordering'

    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
