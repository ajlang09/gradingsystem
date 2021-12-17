<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ClassesRecord;


class ClassesController extends Controller
{
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

    public function edit($class_id){
        $classesRecord = new ClassesRecord;
        $data = $classesRecord->find($class_id);
        if (empty($data)) {
            return redirect()->route('classes.admin');
        }
        return view('posts.enroll', compact('data'));
    }

    public function classview($class_name){
        $classesRecord = ClassesRecord::all();
    
        return view('posts.classview', compact('classesRecord'));
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
        $dataModel->fill($data);
        $dataModel->save();
        return redirect()->route('classes.admin');
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
}
