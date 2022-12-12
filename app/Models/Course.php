<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'price',
        'age',
        'introduction_video_link',
        'description',
        'cource_title',
        'image',
        'end_of_my_course',
        'should_take',
        'students_need',
    ];
    public function subjects()
    {
        return $this->BelongsToMany(Subject::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function topics()
    {
        return $this->BelongsToMany(Topic::class);
    }
    public function grades()
    {
        return $this->BelongsToMany(Grade::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sections()
    {
        return $this->hasMany(Course_section::class);
    }

}
