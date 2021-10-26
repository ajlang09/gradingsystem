<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;
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
            $exist = $studentRecord->where('email', $data['email'])->where('stud_id',$data['stud_id'])->first();
            if($exist){
                flash('Sorry! The data inputted already exists')->error();
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
        $data = $request->all();
        $dataModel = StudentRecord::find($data['id']);
        if (empty($dataModel)) {
            return redirect()->route('student');
        }
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
}
