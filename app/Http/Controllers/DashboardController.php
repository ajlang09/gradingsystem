<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassesRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = auth()->user()->id;

        $classes = ClassesRecord::whereHas('students',function($q) use ($studentId) {
            $q->where('student_id', $studentId);
        })->get();

        return view('modules.student.index', compact('classes'));
    }
}
