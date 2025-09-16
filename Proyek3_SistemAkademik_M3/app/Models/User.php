<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id'; 

    protected $fillable = ['username', 'password', 'role', 'full_name', 'email', 'is_active'];
    protected $hidden = ['password'];

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'user_id');
    }
}
