<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;
use App\Models\Subject;
use App\Models\ClassesRecord;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        //call out data from records
        $studentRecords = StudentRecord::all();

        //compact - to use data to external page
        return view('posts.student', compact('studentRecords'));
    }

    public function store(Request $request)
    {
        //always array []
        //data $request from the form of regustration

        $data = $request->all();
        $studentRecord = new StudentRecord;

            //multiple wheres possible
            //first executes query/command
            //(get) command used to get multiple data at once
            $exist = $studentRecord->where('email', $data['email'])->first();
            if($exist){
                flash('Sorry! The email inputted already exists')->error();
                return redirect()->route('student');
            }
             $exist2 = $studentRecord->where('stud_id',$data['stud_id'])->first();
             if ($exist2) {
                 flash('Sorry! The student ID inputted already exists')->error();
                return redirect()->route('student');
             }

            flash('You have successfully added a student!')->success();
            $studentRecord->create($data);

            return redirect()->route('student');

    }

    public function add()
    {
        return view('posts.studentform');
    }

    public function edit($id)
    {
        $studentRecord = new StudentRecord;
        $data = $studentRecord->find($id);
        if (empty($data)) {
            return redirect()->route('student');
        }
        return view('posts.student_edit', compact('data'));
    }

    public function update(Request $request)
    {
        $studentRecord = new StudentRecord;
        $data = $request->all();
        $dataModel = StudentRecord::find($data['id']);
        if (empty($dataModel)) {
            return redirect()->route('student');
        }
        //FIX FOR EDIT IF WANTED
         /*$exist = $studentRecord->where('email', $data['email'])->first();
            if($exist){

                flash('Sorry! The email inputted already exists')->error();
                return redirect()->route('student');
            }
         $exist2 = $studentRecord->where('stud_id',$data['stud_id'])->first();
             if ($exist2) {

                 flash('Sorry! The student ID inputted already exists')->error();
                return redirect()->route('student');
             }
             */


        $dataModel->fill($data);
        $dataModel->save();
        return redirect()->route('student');
    }


    public function delete(Request $request){
        $data = $request->all();
        $dataModel = StudentRecord::find($data['id']);
        if (empty($dataModel)) {
            return redirect()->route('student');
        }
        $dataModel->delete();

        return redirect()->route('student');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $search = isset($data['search']) ? $data['search'] : '';
        $classId = isset($data['classId']) ? $data['classId'] : '';

        $class = ClassesRecord::find($classId);
        $exception = [];
        $students = $class->students()->get();

        if ($students) {
            $exception = $students->pluck('id')->toArray();
        }

        $students = StudentRecord::whereNotIn('id', $exception)->where(function($query) use ($data) {
            $query->where('name','like','%'.$data['search'].'%')
            ->orWhere('email','like','%'.$data['search'].'%')
            ->orWhere('stud_id','like','%'.$data['search'].'%');
        })->get();

        return response()->json($students);
    }

    public function grades($classId, $studentId)
    {
        $class = ClassesRecord::find($classId);

        if (empty($class)) {
            flash()->error('Class does not exist');
            return redirect()->back();
        }

        $students  = $class->students()->get();
        $exception = [];
        if ($students) {
            $exception = $students->pluck('id')->toArray();
        }
        if (!in_array($studentId, $exception)) {
            flash()->error('Student does not belong to this class');
            return redirect()->back();
        }

        $student = StudentRecord::find($studentId);

        $subjects = $class->subjects()->get();

        $grades = $class->mappedGrades($studentId, $subjects);


        return view('modules.class.student_profile', compact('class', 'student', 'subjects', 'grades'));
    }

    public function studentGrade(Request $request)
    {
        $data = $request->all();

        $class = ClassesRecord::find($data['class_id']);
        $term  = $data['term'];
        $grades = $class->rawGradesFor($data['student_id'], $term, $data['subject_id']);

        foreach ($grades as $grade) {
            $grade->delete();
        }

        $classId   = $data['class_id'];
        $studentId = $data['student_id'];
        $subjectId = $data['subject_id'];

        $subject = Subject::find($subjectId);

        $getConfigurations = $subject->getConfiguration();

        $breakDown = [];

        foreach ($getConfigurations as $configuration) {
            $breakDown[$configuration['slug']] = $configuration['percentage'];
        }
        
        // $breakDown = [
        //     'class_standing' => 0.6,
        //     'major_exams' => 0.3,
        //     'studentship' => 0.1,
        // ];

        foreach ($breakDown as $type => $percentage) {
            $grade = $data[$type];

            $gradeData = [
                'class_id'   => $classId,
                'student_id' => $studentId,
                'subject_id' => $data['subject_id'],
                'type'       => $type,
                'grade'      => $grade,
                'term'       => $term,
            ];

            $this->saveGrade($gradeData);
        }

        $totalGrade = 0;

        foreach ($breakDown as $type => $percentage) {
            $totalGrade += $data[$type] * $percentage;
        }

        $gradeData = [
            'class_id'   => $classId,
            'student_id' => $studentId,
            'subject_id' => $data['subject_id'],
            'type'       => $term,
            'grade'      => $totalGrade,
            'term'       => $term,
        ];

        $this->saveGrade($gradeData);

        $class->calculateTotalGradeForSubject($data['student_id'], $data['subject_id']);

        flash()->success('Grades updated!');
        return redirect()->back();

    }

    private function saveGrade($gradeData)
    {
        return \App\Models\Grade::create($gradeData);
    }
}
