<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLecture extends Model
{
    protected $table = 'course_lectures';

    protected $guarded = ['id'];
    
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
