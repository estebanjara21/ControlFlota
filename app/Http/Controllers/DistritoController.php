<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use Illuminate\Http\Request;

class DistritoController extends Controller
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
    public function show(Distrito $distrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distrito $distrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distrito $distrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distrito $distrito)
    {
        //
    }


     public function registrar_dis(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iCodDistrito' => 'required',
            'iDistrito' => 'required',
            'selPro' => 'required',
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $Distrito= new Distrito();
        $Distrito->descripcion = $request->input('iDistrito');
        $Distrito->codigo_distrito = $request->input('iCodDistrito');
        $Distrito->id_provincia = $request->input('selPro');
        $Distrito->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $Distrito->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


public function eliminarDistrito($id)
    {$distrito = Distrito::find($id);

    // Verifica si el circuito existe
    if ($distrito) {
        // Elimina el circuito
        $distrito->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}
 public function actualizarDistrito(Request $cont)
    {         $distrito = Distrito::find($cont->input('id'));

        if ($distrito) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $distrito->descripcion = $cont->input('distrito');
            $distrito->codigo_distrito = $cont->input('codigo_distrito');
            $distrito->id_provincia = $cont->input('provincia');
            
            $distrito->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }

      public function listado_distrito(Request $request)
    {
          $distrito = Distrito::pluck('descripcion', 'id');
    //return view('subcircuitos')->with('circuitos', $circuitos);

        return response()->json($distrito);
    }




public function obtenerDisxPro(Request $request)
    {
        $id_provincia = $request->input('idPro');

        $distri = Distrito::where('id_provincia', $id_provincia)->pluck('descripcion', 'id');

        return response()->json($distri);
    }








}
