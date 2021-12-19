<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
//in order to use auth login extend authenticatable
class StudentRecord extends Authenticatable

{
    protected $fillable = [
        'stud_id',
        'name',
        'contact_no',
        'yearandsection',
        'email'
    ];
//many to many connecting to other database
    public function classes()
    {
        return $this->belongsToMany('App\Models\ClassesRecord','classes_record_student_record', 'student_id', 'class_id');
    }

}
