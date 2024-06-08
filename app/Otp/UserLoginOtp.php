<?php

namespace App\Otp;

use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class UserLoginOtp implements Otp
{
    /**
     * Initiates the OTP with user detail
     *
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password
    ) {
    }

    /**
     * Creates the user
     */


    public function process()
    {
        // Verificar las credenciales del usuario
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Si las credenciales son válidas, se ha iniciado sesión correctamente

            // Obtener el usuario autenticado
            /** @var User $user */
            $user = Auth::user();

            // Verificar si el correo electrónico del usuario ya ha sido verificado
            if (!$user->email_verified_at) {
                // Si el correo electrónico no ha sido verificado, se marca como verificado
                $user->email_verified_at = now();
                $user->save();
            }

            // Devolver la información del usuario autenticado
            return [
                'user' => $user
            ];
        } else {
            // Si las credenciales no son válidas, devolver un mensaje de error o lanzar una excepción, según sea necesario
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }
    }
}
