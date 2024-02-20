<?php

namespace App\Http\Controllers;

use App\Models\Parroquia;
use Illuminate\Http\Request;

class ParroquiaController extends Controller
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
    public function show(Parroquia $parroquia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parroquia $parroquia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parroquia $parroquia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parroquia $parroquia)
    {
        //
    }

   public function registrarparroquia(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iParroquia' => 'required',
            'selDistrito' => 'required',
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $parroquia= new Parroquia();
        $parroquia->descripcion = $request->input('iParroquia');
        $parroquia->id_distrito = $request->input('selDistrito');
      ;
        $parroquia->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $parroquia->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }

    public function eliminarparroquia($id)
    {$parroquia = Parroquia::find($id);

    // Verifica si el circuito existe
    if ($parroquia) {
        // Elimina el circuito
        $parroquia->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}

   public function actualizarparro(Request $cont)
    {         $Parroquia = Parroquia::find($cont->input('id'));

        if ($Parroquia) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $Parroquia->descripcion = $cont->input('parroquia');
            $Parroquia->id_distrito = $cont->input('distrito');
     
            
            $Parroquia->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }

      public function listado_parroquia(Request $request)
    {
          $parroquia = Parroquia::pluck('descripcion', 'id');
    //return view('subcircuitos')->with('circuitos', $circuitos);

        return response()->json($parroquia);
    }

    public function obtenerParrxdis(Request $request)
    {
        $id_distrito = $request->input('idDis');

        $id_distrito = Parroquia::where('id_distrito', $id_distrito)->pluck('descripcion', 'id');

        return response()->json($id_distrito);
    }



}
