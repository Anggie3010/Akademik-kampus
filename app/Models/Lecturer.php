<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = 'lecturers';

    protected $guarded = ['id'];

    public function courseLectures()
    {
        return $this->hasMany(CourseLecture::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_lectures')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
