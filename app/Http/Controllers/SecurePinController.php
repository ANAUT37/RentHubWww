<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurePin;
use Illuminate\Support\Facades\Auth;

class SecurePinController extends Controller
{
    public function save(Request $request)
    {
        $userId = Auth::id();
    
        if ($request->validate([
            'new_pin' => 'required|min:6|max:6',
            'confirmed_pin' => 'required|same:new_pin',
        ], [
            'new_pin.required' => 'Debes rellenar este campo',
            'confirmed_pin.required' => 'Debes rellenar este campo',
            'confirmed_pin.same' => 'Los PIN introducidos no coinciden'
        ])) {
            if (SecurePin::where('user_id', $userId)->exists()) {
                $currentPin = $request->input('current_pin');
                $encryptedCurrentPin = SecurePin::encryptPin($currentPin);
    
                $pinModel = SecurePin::where('user_id', $userId)->first();
    
                if ($pinModel->pin === $encryptedCurrentPin) {
                    $pinModel->pin = SecurePin::encryptPin($request->input('new_pin'));
                    $pinModel->save();
                    
                    SecurePin::activatePinCookie();
                    return redirect()->back()->with('success', 'PIN de Acceso Seguro actualizado correctamente.');
                } else {
                    return redirect()->back()->with('error', 'PIN de Acceso Seguro actual introducido incorrecto');
                }
            } else {
                $newPinModel = new SecurePin();
                $newPinModel->user_id = $userId;
                $newPinModel->pin = SecurePin::encryptPin($request->input('new_pin'));
                $newPinModel->save();
                
                SecurePin::activatePinCookie();
                return redirect()->back()->with('success', 'PIN de Acceso Seguro activado correctamente.');
            }
        } else {
            return redirect()->back()->with('error', 'No se ha podido guardar el PIN');
        }
    }

    public function index(Request $request){
        $redirectRoute = $request->query('redirect');

        return view('Secure.index', [
            'redirectRoute' => $redirectRoute
        ]);
    }
    
}
