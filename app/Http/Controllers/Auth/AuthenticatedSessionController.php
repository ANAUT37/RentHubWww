<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorAuthentication;
use App\Models\User;

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
    public function store(Request $request): View
    {
        //$request->authenticate();

        //$request->session()->regenerate();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Generar un código de autenticación en dos pasos
            $twoFactorCode = mt_rand(100000, 999999);

            $email = $request->email;

            // Guardar el código de autenticación en la sesión del usuario
            $request->session()->put('two_factor_code', $twoFactorCode);

            // Enviar el código de autenticación por correo electrónico
            Mail::to($request->user()->email)->send(new TwoFactorAuthentication($twoFactorCode));

            // Redirigir al usuario a la página de verificación del código de autenticación
            return view('Auth.Login.verificationCode');
        } else {
            // Si las credenciales no son válidas, redirigir de vuelta al formulario de inicio de sesión con un mensaje de error
            return redirect()->route('login')->with('error', 'Credenciales no válidas.');
        }

    }

    public function saveSession(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6', // Suponiendo que el código de verificación tiene seis dígitos
        ]);

        $request->session()->regenerate();

        $userGuest = $request->server('HTTP_USER_AGENT');
        $ipAddress = $request->ip();
        //Mail::to($request->user())->send(new OnLogin($userGuest, $ipAddress));

        /** 
         * @var RedirectResponse $response
         */
        $responese = redirect()->back();
        return $responese;
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
