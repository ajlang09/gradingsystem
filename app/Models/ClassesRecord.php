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
        'students',
        'year',
    ];

    public function students()
    {
        return $this->belongsToMany('App\Models\StudentRecord', 'classes_record_student_record', 'class_id', 'student_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'class_record_subject', 'class_id', 'subject_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Models\Grade', 'class_id', 'class_id');
    }

    public function rawGradesFor($studentId)
    {   
        return \App\Models\Grade::where('class_id', $this->class_id)->where('student_id', $studentId)->get();
    }

    public function mappedGrades($studentId)
    {
        $rawGrades = $this->rawGradesFor($studentId);
        $initialGroup = [];
        $gwa = 0;
        foreach ($rawGrades as $rawGrade) {

            if (empty($rawGrade->subject_id)) {
                $gwa = $rawGrade->grade;
                continue;
            }

            if (!isset($initialGroup[$rawGrade->subject_id])) {
                $subject = $rawGrade->subject()->first();
                $initialGroup[$rawGrade->subject_id] = [
                    'subject'   => $subject->name,
                    'subjectId' => $subject->id, 
                    'userId'    => $subject->user_id, 
                ];
            }
            $initialGroup[$rawGrade->subject_id][$rawGrade->type] =  $rawGrade->grade;
        }

        $mappedGrade = [];
        foreach ($initialGroup as $value) {
            $mappedGrade[] = $value;
        }

        return [
            'grades' => $mappedGrade,
            'gwa'    => $gwa,
        ];
    }
}
