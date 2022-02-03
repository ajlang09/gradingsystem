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

    public function rawGradesFor($studentId, $term = '', $subjectId = '')
    {   

        $query = \App\Models\Grade::query();

        $query->where('class_id', $this->class_id);

        if ($term) {
            $query->where('term', $term);
        }

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }

        return $query->get();
    }

    public function calculateTotalGradeForSubject($studentId, $subjectId = '')
    {   

        $query = \App\Models\Grade::query();

        $query->where('class_id', $this->class_id);

        $query->where('subject_id', $subjectId);

        $query->where(function($q){
            $q->where('type','midterm')
            ->orWhere('type','finals');
        });
    
        $terms = [
            'midterm',
            'finals',
        ];

        $total = \App\Models\Grade::query();

        $total->where('subject_id', $subjectId);
        $total->where('term','total');
        $total->where('type','total')->first();

        if ($total) {
            $total->delete();
        }

        $terms = $query->get();

        $totalGrade = [
            'midterm' => 0,
            'finals' => 0,
            'total' => 0,
        ];

        foreach ($terms as $term) {
            $totalGrade[$term->type] = $term->grade;
        }

        $totalGrade['total'] = ($totalGrade['midterm'] + $totalGrade['finals']) / 2;

        $gradeData = [
            'class_id'   => $this->class_id,
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'type'       => 'total',
            'grade'      => $totalGrade['total'],
            'term'       => 'total',
        ];


        return Grade::create($gradeData);
    }

    public function mappedGrades($studentId, $subjects)
    {
        $terms = [
            'midterm',
            'finals',
        ];

        $termGrade = [];
        $gwa = 0;
        foreach ($terms as $term) {
            $initialGroup = [];
            $rawGrades = $this->rawGradesFor($studentId, $term);
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

            foreach ($subjects as $rawSubject) {
                if (!isset($initialGroup[$rawSubject->id])) {
                    $initialGroup[$rawSubject->id] = [
                        'subject'   => $rawSubject->name,
                        'subjectId' => $rawSubject->id, 
                        'userId'    => $rawSubject->user_id, 
                        'class_standing' => 0,
                        'major_exams'    => 0,
                        'studentship'    => 0,
                    ];

                    $initialGroup[$rawSubject->id][$term] = 0;
                }
            }
            
            $mappedGrade = [];

            foreach ($initialGroup as $value) {
                $mappedGrade[] = $value;
            }

            $termGrade[$term] = $mappedGrade; 
        }

        $totalAverage = 0;
        foreach ($termGrade['midterm'] as $key => $value) {
            $midterm = $termGrade['midterm'][$key]['midterm'];
            $finals = $termGrade['finals'][$key]['finals'];

            $totalAverage += ($midterm + $finals) / 2;

        }

        $gwa = $totalAverage / sizeof($termGrade['midterm']);

        return [
            'grades' => $termGrade,
            'gwa'    => number_format($gwa, 2),
        ];
    }
}
