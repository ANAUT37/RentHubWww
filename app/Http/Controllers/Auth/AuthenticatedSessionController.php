<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnLogin;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('Auth.Login.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        $userGuest = $request->server('HTTP_USER_AGENT');
        $ipAddress = $request->ip(); 
        //Mail::to($request->user())->send(new OnLogin($userGuest, $ipAddress));
        
        /** 
         * @var RedirectResponse $response
         */
        $responese = redirect()->back();
        return $responese;
        //return redirect()->intended(route('dashboard', absolute: false));
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }

    public function needed(): View
    {
        return view('Auth.Login.loginNeeded');
    }
}
