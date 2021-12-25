<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function subject()
    {
        return view('modules.teacher.subject');
    }

    public function class()
    {
        return view('modules.teacher.class');
    } 

    public function getSubjects($teacherId, Request $request)
    {
        $data = $request->all();

        $rawSubjects = \App\Models\Subject::where('user_id', $teacherId)
            ->where('year', $data['year'])->with('classes')->get();

        $subjects = [];

        foreach ($rawSubjects as $subject) {
            
            $class = $subject->classes()->first();

            if (empty($class)) {
                continue;
            }

            $studentCount = $class->students()->count();

            $subjects[]= [
                'subjectId'    => $subject->id,
                'subjectName'  => $subject->name,
                'studentCount' => $studentCount,
            ];
        }
        return response()->json($subjects);
    }

    public function getClass($teacherId, Request $request)
    {

        $data = $request->all();

        $rawClasses = \App\Models\ClassesRecord::whereHas('subjects',function($query) use ($teacherId){
            $query->where('user_id', $teacherId);
        })->where('year', $data['year'])->get();

        $subjects = [];

        foreach ($rawClasses as $class) {
            
            $studentCount = $class->students()->count();

            $subjects[]= [
                'classId'    => $class->class_id,
                'className'  => $class->class_name,
                'studentCount' => $studentCount,
            ];
        }

        return response()->json($subjects);
    }
    

    public function subjectStudents($subjectId, $teacherId) 
    {
        $subject = \App\Models\Subject::find($subjectId);
        if (empty($subject)) {
            flash()->error('Subject does not exist');
            return redirect()->back();
        }

        $classes = $subject->classes()->get();
        $students = [];

        foreach ($classes as $class) {
            $rawStudents = $class->students()->get();
            $classId = $class->class_id;
            if (!isset($students[$classId])) {
                $students[$classId]['class'] = $class;
            }
            $students[$classId]['students'] = $rawStudents;
        }

        return view('modules.teacher.subject_student', compact('subject', 'students'));
    }

    public function classStudents($classId, $teacherId)
    {
        $classRecord = \App\Models\ClassesRecord::find($classId);

        if (empty($classRecord)) {
            flash()->error('Section does not exist');
            return redirect()->back();
        }

        $students = $classRecord->students()->get();

        return view('modules.teacher.class_student', compact('classRecord', 'students'));
    }

    public function studentGrade($studentId, $classId)
    {

        $class = \App\Models\ClassesRecord::find($classId);
        $student = \App\Models\StudentRecord::find($studentId);

        if (empty($class)) {
            flash()->error('Class does not exist');
            return redirect()->back();
        }

        if (empty($student)) {
            flash()->error('Student does not exist');
            return redirect()->back();
        }

        $subjects = $class->subjects()->get();

        $grades = $class->mappedGrades($studentId, $subjects);
        

        return view('modules.teacher.student_profile', compact('class', 'student', 'subjects', 'grades'));
    }
}
