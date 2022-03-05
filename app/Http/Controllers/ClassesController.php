<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ClassesRecord;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\Models\Grade;


class ClassesController extends Controller
{

    public function student_grades($classId)
    {
        $studentId = auth()->id();
        $class = \App\Models\ClassesRecord::find($classId);

        if (empty($class)) {
            flash()->error('Class does not exist');
            return redirect()->back();
        }

        $student = \App\Models\StudentRecord::find($studentId);

        if (empty($student)) {
            flash()->error('Student does not exist');
            return redirect()->back();
        }

        $subjects = $class->subjects()->get();

        $grades = $class->mappedGrades($studentId, $subjects);

        return view('modules.student.grade', compact('class', 'student', 'subjects', 'grades'));
    }

    public function index(){
        $classesRecord = ClassesRecord::all();
        return view('posts.classes', compact('classesRecord'));
    }

    public function store(Request $request){
       $data = $request->all();
      
       $classesRecord = new ClassesRecord;
      
       $exist = $classesRecord->where('class_name', $data['class_name'])->first();
       if($exist){
           flash('Sorry! The data inputted already exists')->error();
           
           return redirect()->route('classes.admin');
       }
      
       flash('You have successfully added a Class!')->success();
       $classesRecord->create($data);
       
       return redirect()->route('classes.admin');
    }

    public function add(){
        return view('posts.classesform');
 
    }

    public function edit($class_id)
    {
        $classesRecord = new ClassesRecord;
        $data = $classesRecord->find($class_id);
    
        if (empty($data)) {
            return redirect()->route('classes.admin');
        }
    
        return view('posts.enroll', compact('data'));
    }

    public function enroll()
    {
        return view('modules.class.enroll');
    }

    public function classview($classId)
    {
        $class    = ClassesRecord::find($classId);
        $students = $class->students()->get();
        $subjects = $class->subjects()->get();

        if (empty($class)) {
            flash()->error('Class does not exist');
            return redirect()->route('classes.admin');
        }
        return view('posts.classview', compact('class','students', 'subjects'));
        /*$data = $classesRecord->find($class_id);
        if (empty($data)) {
            return redirect()->route('classes.admin');
        }*/
       
    }

    public function update(Request $request){
       
        $data = $request->all();
  
        $dataModel = ClassesRecord::find($data['class_id']);

        if (empty($dataModel)) {
            return redirect()->route('classes.admin');
        }

        if ('update-class' == $data['action']) {
            $dataModel->fill($data);
            $dataModel->save();
            flash()->success('Class updated!');
        }else if ('update-class-enrollment' == $data['action']) {
            $dataModel->students()->attach($data['student_id']);
            flash()->success('Student enrolled!');
        }else if ('update-class-subject' == $data['action']) {
            $dataModel->subjects()->attach($data['subject_id']);
            flash()->success('Subject added!');
        }

        return redirect()->back();
    }

    public function delete(Request $request){
        $data = $request->all();
        $dataModel = ClassesRecord::find($data['id']);
        if (empty($dataModel)) {
            return redirect()->route('classes.admin');
        }
        $dataModel->delete();
        
        return redirect()->route('classes.admin');
    }

    public function removeStudent(Request $request)
    {
        $data= $request->all();

        $dataModel = ClassesRecord::find($data['class_id']);

        if (empty($dataModel)) {
            flash()->error('Class does not exist!');
            return redirect()->back();
        }

        $student = StudentRecord::find($data['student_id']);
        
        if (empty($student)) {
            flash()->error('Student does not exist!');
            return redirect()->back();
        }

        $dataModel->students()->detach($data['student_id']);

        flash()->success('Student removed from class!');
        return redirect()->back();
    }

    public function removeSubject(Request $request)
    {
        $data= $request->all();

        $dataModel = ClassesRecord::find($data['class_id']);

        if (empty($dataModel)) {
            flash()->error('Class does not exist!');
            return redirect()->back();
        }

        $subject = Subject::find($data['subject_id']);
        
        if (empty($subject)) {
            flash()->error('Subject does not exist!');
            return redirect()->back();
        }

        $grades = Grade::where('subject_id', $subject->id)
        ->where('class_id', $dataModel->id)->get();

        foreach ($grades as $grade) {
            $grade->delete();
        }
        
        $dataModel->subjects()->detach($data['subject_id']);

        flash()->success('Subject removed from class!');
        return redirect()->back();
    }
}
