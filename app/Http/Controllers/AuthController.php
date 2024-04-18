<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginIndex(){
        return view('Auth.Login.index');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'El email o contraseña introducidos no son correctos',
        ])->onlyInput('email');
    }
    public function loginNeededIndex(){
        return view('Auth.Login.loginNeeded');
    }
    public function forgotPasswordForm(){
        return view('Auth.Login.forgotPassword');
    }
    public function forgotPasswordManage(Request $request)
    {
        $email = $request->input('email');
        return view('Auth.Login.sentResetPasswordEmail', ['email' => $email]);
    }
    public function signupIndex(){
        return view('Auth.Signup.index');
    }
    public function signupForm($type=null, Request $request){
        if($type=="particular"){
            $paid = $request->input('p');
            if($paid){
                $type="Premium";
                return view('Auth.Signup.particular',['type'=>$type]);
            }else{
                $type="Básico";
                return view('Auth.Signup.particular',['type'=>$type]);
            }

        }
    }
}
