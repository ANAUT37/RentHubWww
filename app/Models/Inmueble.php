<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;

    protected $table = 'inmuebles';

    public static function getAttributesFromCategory()
    {
        $categoria = $_GET['categoria'];

        $caracteristicas = '';

        if ($categoria === 'pisos') {
            $caracteristicas .= '<label for="habitaciones">Número de habitaciones:</label>';
            $caracteristicas .= '<input type="number" id="habitaciones" name="habitaciones">';
            // Otros campos para pisos...
        } elseif ($categoria === 'locales') {
            $caracteristicas .= '<label for="metros_cuadrados">Metros cuadrados:</label>';
            $caracteristicas .= '<input type="number" id="metros_cuadrados" name="metros_cuadrados">';
            // Otros campos para locales...
        } elseif ($categoria === 'compartir') {
            $caracteristicas .= '<label for="habitaciones_disponibles">Habitaciones disponibles:</label>';
            $caracteristicas .= '<input type="number" id="habitaciones_disponibles" name="habitaciones_disponibles">';
            // Otros campos para compartir...
        }

        return $caracteristicas;
    }
}
