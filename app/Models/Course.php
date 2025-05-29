<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $guarded = ['id'];
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withPivot('grade', 'attendance', 'status')
                    ->withTimestamps();
    }

    public function courseLectures()
    {
        return $this->hasMany(CourseLecture::class);
    }

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'course_lectures')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
