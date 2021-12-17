<?php

namespace App\Http\Controllers\Auth;

use App\Model\StudentRecord;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //validation
        $this->validate($request, [
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' =>'required|confirmed' 

        ]);
        $data = $request->all();
        $user = new User;
        $studentRecord = new User;
        $exist1 = $user->where('email', $data['email'])->first();
        $exist2 = $studentRecord->where('email', $data['email'])->first();
        if($exist1){
            if($exist2){
               
                flash('Email already exists')->error();
                return redirect()->route('register');
            }
            
        }

        
        //store the user
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'username' =>$request->username,
            'password' =>Hash::make($request->password),

        ]);

         //sign the user in
        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');
        
        
        //redirect
        

       
    }
}
