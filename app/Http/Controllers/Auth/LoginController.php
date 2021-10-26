<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //multiple wheres possible
            //first executes query/command 
            //(get) command used to get multiple data at once
        
            //always array []
        //data $request from the form of regustration

        $data = $request->all();
        $studentRecord = new StudentRecord;
        $user = new User;
      

        $exist1 = $user->where('email', $data['email'])->first();
        
        if (!empty($exist1) && Hash::check($data['password'], $exist1->password)) {
            
            auth()->login($exist1);
            return redirect()->route('dashboard');
        }
        
            
        $exist2 = $studentRecord->where('email', $data['email'])->where('stud_id',$data['password'])->first();
      
        if($exist2){   
            //authenticates current login $exist2 as students
            auth()->guard('students')->login($exist2);

            flash('You have successfully logged in!')->success();
            return redirect()->route('dashboard');
        }
       
        flash('User does not exist.')->error();
        return redirect()->route('login');
    }

}

    
        
  

