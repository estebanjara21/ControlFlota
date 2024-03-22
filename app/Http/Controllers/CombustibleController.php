<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use Illuminate\Http\Request;

class CombustibleController extends Controller
{
    public function registrar_combustible(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'selVehiculo' => 'required|integer',
            'solicitante' => 'required|string',
            'gasolinera' => 'required|string',
            'galones_combustible' => 'required|numeric',
            'fecha_hora' => 'required|date',
            'kilometraje_actual' => 'required|numeric',
            'fecha_solicitud' => 'required|date',
        ]);

        // Crea una nueva instancia del modelo Combustible y asigna valores
        $combustible = new Combustible();
        $combustible->id_vehiculo = $request->input('selVehiculo');
        $combustible->solicitante = $request->input('solicitante');
        $combustible->gasolinera = $request->input('gasolinera');
        $combustible->galones_combustible = $request->input('galones_combustible');
        $combustible->fecha_hora = $request->input('fecha_hora');
        $combustible->kilometraje_actual = $request->input('kilometraje_actual');
        $combustible->fecha_solicitud = $request->input('fecha_solicitud');
        $combustible->estado = '1'; // Asegúrate de asignar el estado según tu lógica

        // Guarda el modelo en la base de datos
        $combustible->save();

        // Redirige a la página anterior (o a donde desees) con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro de combustible exitoso');
    }


}
