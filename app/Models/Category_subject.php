<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subjects_id',
        'categories_id',
    ];
}
