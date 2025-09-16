<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Takes extends Model
{
    protected $table = 'takes';
    public $timestamps = false;

    protected $fillable = ['student_id', 'course_id', 'enroll_date'];
}