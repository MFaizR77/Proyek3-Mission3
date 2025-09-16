<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id'; 

    protected $fillable = ['entry_year', 'user_id'];

    public function user()
    {
        // relasi ke tabel users
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'takes', 'student_id', 'course_id')
                    ->withPivot('enroll_date');
    }
}