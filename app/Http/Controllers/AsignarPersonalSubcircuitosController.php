<?php

namespace App\Http\Controllers;

use App\Models\Asignar_personal_subcircuitos;
use Illuminate\Http\Request;

class AsignarPersonalSubcircuitosController extends Controller
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
    public function show(Asignar_personal_subcircuitos $asignar_personal_subcircuitos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignar_personal_subcircuitos $asignar_personal_subcircuitos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignar_personal_subcircuitos $asignar_personal_subcircuitos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignar_personal_subcircuitos $asignar_personal_subcircuitos)
    {
        //
    }

      public function reg_asig_per_sub(Request $request)
    {

        // Crear una nueva instancia del modelo y asignar valores
        $asig= new Asignar_personal_subcircuitos();
        $asig->id_personal = $request->input('id_personal');
        $asig->id_subcircuito = $request->input('id_subcircuito');
        $asig->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $asig->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }

    public function eliminarAsignacion($id)
        {$asignar = Asignar_personal_subcircuitos::find($id);

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


   public function actualizarAsignacion(Request $cont)
    {         $asignacion = Asignar_personal_subcircuitos::find($cont->input('id'));

        if ($asignacion) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $asignacion->id_subcircuito = $cont->input('id_subcircuito');
      
            
            $asignacion->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }
}
