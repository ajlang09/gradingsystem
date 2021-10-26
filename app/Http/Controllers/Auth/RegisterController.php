<?php

namespace App\Http\Controllers\Auth;


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