<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\onTransactionComplete;
use App\Mail\OnConfirmatedAccount;
use App\Models\User;
use App\Models\Particular;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\SuscriptionController;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\CreditCard;
use App\Models\Suscription;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use Stripe\Subscription;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('Auth.Signup.index');
    }
    public function particular(Request $request): View
    {
        if (isset($request->type)) {
            return view('Auth.Signup.particular', ['type' => 'Premium']);
        }
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
        $type = 0;
        $status = 1;
        if ($request->type === 'premium') {
            $type = 1;
            $status = 0;
        }

        $user = User::create([
            'email' => $request->email,
            'display_id' => uniqid(),
            'password' => Hash::make($request->password),
            'type' => 0,
            'phone' => $request->phone,
            'phone_code' => $request->phoneCode,
            'second_mail' => null,
            'country_code' => null,
            'profile_pic_url' => 'default.jpg', //DEFUALT TESTING IMAGE
            'profile_banner_url' => null,
            'last_login' => null,
            'name' => $request->name,
        ]);

        $subscription= new Suscription();
        $subscription->user_id=$user->id;
        $subscription->plan_id=1;
        $subscription->start_date=now();
        $subscription->end_date = now()->addMonth();
        $subscription->status = 'active';
        $subscription->renewal_date = now()->addMonth();
        $subscription->payment_method = 'card';

        if ($request->type === 'premium') {
            $subscription->subscription_type = 'particular_premium';
        }else{
            $subscription->subscription_type = 'particular_basic';
        }
        $subscription->save();

        $particular = Particular::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'plan' => $type,
            'birthdate' => $request->birthdate,
            'genre' => null,
            'verified' => 0,
            'description' => $request->description,
        ]);

        $image = $request->file('input-file');

        if ($image != null) {
            $user = Auth::user();

            $imageName = $user->display_name;

            $user->profile_pic_url = $imageName;

            // Enviar la imagen a la URL externa usando una solicitud POST
            $response = Http::attach('image', file_get_contents($image->getRealPath()), $image->getClientOriginalName())
                ->post("https://media.renthub.es/v1/profile/{$user->display_name}/update");

            if ($response->successful()) {
                $particular->description = 'imagen subida';
            } else {
                $user->profile_pic_url = 'default.jpg';
                $particular->description = 'error en la solcitud';
            }
        } else {
            $user->profile_pic_url = 'default.jpg';
            $particular->description = 'imagen null';
        }




        $user->status = $status;

        event(new Registered($user));


        $newUserName = $request->name;

        event(new Registered($particular));
        //Auth::login($user);
        if ($type === 0) {
            Mail::to($request->email)->send(new OnConfirmatedAccount($newUserName));
        }


        if ($type === 0) {
            return redirect('/signup/completed');
        } else {
            return redirect('/signup/checkout/' . $user->display_id . '/premium');
        }
    }

    public function completed()
    {
        return view('Auth.Signup.completed');
    }
    public function checkout(Request $request, $display_id)
    {
        return view('Auth.Signup.checkout', ['display_id' => $display_id]);
    }
    public static function checkoutConfirmed(Request $request, $display_id, $paymentMethodId, $status)
    {    
        $data = User::where('display_id', $display_id)->first();
        $data->status = 1;
        $data->save();


       
        $transaction = new Transaction();
        $transaction->user_id = $data->id;
        $transaction->amount = Transaction::encryptValue('990');
        $transaction->currency = Transaction::encryptValue('eur');
        $transaction->payment_method_id = Transaction::encryptValue($paymentMethodId);
        $transaction->payment_status = Transaction::encryptValue($status);
        $transaction->description = Transaction::encryptValue('Suscripción RêntHûb Particular Premium');
        $transaction->customer_email = $data->email;
        $transaction->save_card = 0;
        $transaction->save();
        

        $transVisual = new Transaction();
        $transVisual->user_id = $data->id;
        $transVisual->amount = '9,90';
        $transVisual->currency = 'eur';
        $transVisual->payment_method_id = $paymentMethodId;
        $transVisual->payment_status = $status;
        $transVisual->description = 'Suscripción RêntHûb Particular Premium';
        $transVisual->customer_email = $data->email;
        $transVisual->save_card = 0;

        $name = Particular::getParticularName($data->id);
        Mail::to($data->email)->send(new onTransactionComplete($name, $transVisual));
        Mail::to($data->email)->send(new OnConfirmatedAccount($name));
        
        return response()->json(['message' => 'Se ha compartido el documento correctamente'], 200);
    }
    public static function cancelCheckout(Request $request, $display_id)
    {
        $data = User::where('display_id', $display_id)->first();
        $data->status = 1;
        $data->save();

        $particular = Particular::getParticularData($data->id);
        $particular->plan = 0;
        $particular->save();
        Mail::to($data->email)->send(new OnConfirmatedAccount($particular->name));
        return redirect('/signup/completed');
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
