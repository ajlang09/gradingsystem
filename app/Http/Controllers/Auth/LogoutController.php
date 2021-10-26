<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(){

        $student = auth()->guard('students')->user();

        if ($student) {
            auth()->guard('students')->logout();
        }

        Auth::logout();
        
        return redirect()->route('login');
    }
}
