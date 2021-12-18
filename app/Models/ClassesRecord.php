<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ClassesRecord extends Authenticatable

{
    protected $primaryKey = 'class_id';
    protected $fillable = [
        'class_id',
        'class_name',
        'students'
    ];
//many to many connecting to other database
    public function students()
    {
        return $this->belongsToMany('App\Models\StudentRecord', 'classes_record_student_record', 'class_id', 'student_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'class_record_subject', 'class_id', 'subject_id');
    }
}
