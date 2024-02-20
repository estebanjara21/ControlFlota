<?php

namespace App\Http\Controllers;

use App\Models\Asignar_vehiculo_subcircuitos;
use Illuminate\Http\Request;

class AsignarVehiculoSubcircuitosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignar_vehiculo_subcircuitos $asignar_vehiculo_subcircuitos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignar_vehiculo_subcircuitos $asignar_vehiculo_subcircuitos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignar_vehiculo_subcircuitos $asignar_vehiculo_subcircuitos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignar_vehiculo_subcircuitos $asignar_vehiculo_subcircuitos)
    {
        //
    }


         public function reg_asig_vehi_sub(Request $request)
    {

        // Crear una nueva instancia del modelo y asignar valores
        $asig= new Asignar_vehiculo_subcircuitos();
        $asig->id_vehiculo = $request->input('id_vehiculo');
        $asig->id_subcircuito = $request->input('id_subcircuito');
        $asig->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $asig->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }
    public function eliminarAsignacionVehi($id)
        {$asignar = Asignar_vehiculo_subcircuitos::find($id);

    // Verifica si el circuito existe
    if ($asignar) {
        // Elimina el circuito
        $asignar->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}

public function actualizarAsignacionVe(Request $cont)
    {         $asignacion = Asignar_vehiculo_subcircuitos::find($cont->input('id'));

        if ($asignacion) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $asignacion->id_subcircuito = $cont->input('id_subcircuito');
      
            
            $asignacion->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }





public function obtener_vehiculo_asig(Request $request)
    { 
        $id_subcircuito = $request->input('id_sub_circuito');
    $vehiculo = Asignar_vehiculo_subcircuitos::join('vehiculos', 'asignar_vehiculo_subcircuitos.id_vehiculo', '=', 'vehiculos.id')
    ->where('asignar_vehiculo_subcircuitos.id_subcircuito', $id_subcircuito)
    ->pluck('vehiculos.placa', 'vehiculos.id');
    return response()->json($vehiculo);


    }

}
