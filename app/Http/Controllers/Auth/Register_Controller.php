<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Register_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $this->validate($request, [                                       //dd($request->email);   
            'name' => 'required|max:255',                                 //dd($request->get('email'));
            'username' => 'required|max:255',                             //"{{blade syntax output or echo}}" 
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
            ]) ;               
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);    
            
            auth()->attempt($request->only('email', 'password') );
            return redirect()->route('dashboard');
            
    }
}
