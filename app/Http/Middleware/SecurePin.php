<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SecurePin as Model;

class SecurePin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario ha establecido un PIN
        if (!Model::isPinActivated(auth()->id())) {
            // Redirigir al usuario a la página de configuración de PIN
            return redirect()->route('account.security')->with('error', 'Por favor, establece un PIN para acceder a esta página.');
        }

        // Continuar con la solicitud si el usuario ha establecido un PIN
        return $next($request);
    }
}
