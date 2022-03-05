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

    public function saveConfig(Request $request)
    {
        $data = $request->all();
        $subject_id = $data['subject_id'];
        $subject = Subject::find($subject_id);


        if ('save' != $data['action']) {
            $name = $data['action'];
            $keyName = array_search($name, $data['name']);
            if (false !== $keyName) {
                $data['name'][$keyName] = null;
            }
        }


        $totalPercentage = 0;
        foreach ($data['name'] as $key => $value) {
            $name       = $data['name'][$key];
            $percentage = $data['percentage'][$key];

            if (empty($name)) {
                continue;
            }
            $totalPercentage += $percentage;
        }

        if ($totalPercentage > 100) {
            flash()->error('Invalid percentage!');
            return redirect()->back();
        }

        $subject->configurations()->delete();

        foreach ($data['name'] as $key => $value) {
            $name       = $data['name'][$key];
            $percentage = $data['percentage'][$key];

            if (empty($name)) {
                continue;
            }

            $subjectConfiguration = [
                'name' => $name,
                'percentage' => $percentage,
            ];

            $subject->configurations()->create($subjectConfiguration);
        }
        return redirect()->back();
    }

}
