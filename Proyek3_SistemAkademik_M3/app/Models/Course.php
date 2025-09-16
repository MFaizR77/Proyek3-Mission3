<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $keyType = 'int';

    protected $fillable = [
        'course_name',
        'credits',
        'description',
        'semester',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'takes', 'course_id', 'student_id')
                    ->withPivot('enroll_date');
    }
}