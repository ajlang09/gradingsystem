<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassesRecord;
use App\Models\User;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();
        return view('modules.subject.index', compact('subjects'));
    }

    public function create()
    {
        
        $teachers = User::whereHas('roles', function($query) {
            $query->where('name','teacher');
        })->get();

        return view('modules.subject.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        Subject::create($data);

        flash()->success('Subject created!');
        
        return redirect()->route('subject.index');
    }

    public function edit($id)
    {
        $subject = Subject::find($id);


        if (empty($subject)) {
            flash()->error('Subject does not exist!');
            return redirect()->route('subject.index');
        }

        $teachers = User::whereHas('roles', function($query) {
            $query->where('name','teacher');
        })->get();

        return view('modules.subject.edit', compact('subject','teachers'));
    }


    public function destroy($id)
    {

        $subject = Subject::find($id);

        if (empty($subject)) {
            flash()->error('Subject does not exist!');
            return redirect()->route('subject.index');
        }

        $subject->delete();

        flash()->success('Subject deleted!');
        
        return redirect()->route('subject.index');

    }

    public function update(Request $request)
    {
        $data = $request->all();
        
        $subject = Subject::find($data['id']);

        if (empty($subject)) {
            flash()->error('Subject does not exist!');
            return redirect()->route('subject.index');
        }

        $subject->fill($data);
        $subject->save();
        flash()->success('Subject updated!');
        
        return redirect()->route('subject.index');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $search = isset($data['search']) ? $data['search'] : '';
        $classId = isset($data['classId']) ? $data['classId'] : '';

        $class = ClassesRecord::find($classId);
        $exception = [];
        $subjects = $class->subjects()->get();

        if ($subjects) {
            $exception = $subjects->pluck('id')->toArray();
        }

        $subjects = Subject::whereNotIn('id', $exception)->where('name','like','%'.$search.'%')->get();


        return response()->json($subjects);

    }


}
