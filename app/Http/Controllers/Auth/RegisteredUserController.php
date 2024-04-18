<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Particular;
use App\Models\Empresa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('Auth.Signup.index');
    }
    public function particular(): View
    {
        return view('Auth.Signup.particular', ['type' => 'Básico']);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeParticular(Request $request): RedirectResponse
    {   
        /*
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        */

        $user = User::create([
            'email' => $request->email,
            'display_id' => uniqid(),
            'password' => Hash::make($request->password),
            'type'=>0,
            'phone'=>null,
            'phone_code'=>null,
            'second_mail'=>null,
            'country_code'=>null,
            'profile_pic_url'=>'https://t3.ftcdn.net/jpg/03/58/90/78/360_F_358907879_Vdu96gF4XVhjCZxN2kCG0THTsSQi8IhT.jpg',//DEFUALT TESTING IMAGE
            'profile_banner_url'=>null,
            'last_login'=>null,
        ]);



        event(new Registered($user));

        $particular = Particular::create([
            'user_id' => $user->id,
            'name' => $request->nombre,
            'surname' => $request->surname,
            'plan' => 0,
            'birthdate' => $request->birthdate,
            'genre'=>null,
            'verified'=>0,
            'description'=>$request->description,
        ]);

        event(new Registered($particular));
        //Auth::login($user);

        return redirect('/');
    }

        /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeEmpresa(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }

}
