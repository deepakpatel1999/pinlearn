<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_subject extends Model
{
    use HasFactory;
    // protected $table = "category_subject";
    protected $fillable = [
        'subject_id',
        'category_id',
    ];
}
