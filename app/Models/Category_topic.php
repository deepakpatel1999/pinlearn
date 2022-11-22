<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topics_id',
        'categories_id',
    ];
}
