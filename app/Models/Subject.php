<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'alias',
        'status',

    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
