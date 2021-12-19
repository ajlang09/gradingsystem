<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidForKey;

class Grade extends Model
{
    use HasFactory, UuidForKey;

    protected $fillable = [
        'class_id',
        'student_id',
        'subject_id',
        'type',
        'grade',
    ];

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\StudentRecord', 'student_id');
    }

    public function class()
    {
        return $this->belongsTo('App\Models\ClassesRecord', 'class_id', 'class_id');
    }

}
