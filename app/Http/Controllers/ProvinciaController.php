<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
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
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        //
    } 


      public function registrar_pro(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iProv' => 'required',
    
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $provincia= new Provincia();
        $provincia->descripcion = $request->input('iProv');
        $provincia->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $provincia->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }

public function eliminarpro($id)
{$provincia = Provincia::find($id);

    // Verifica si el circuito existe
    if ($provincia) {
        // Elimina el circuito
        $provincia->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}


// app/Http/Controllers/CircuitoController.php

    public function actualizarpro(Request $cont)
    {         $provincia = Provincia::find($cont->input('id'));

        if ($provincia) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $provincia->descripcion = $cont->input('provincia');
     
            
            $provincia->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }


      public function listado_provincia(Request $request)
    {
          $provincia = provincia::pluck('descripcion', 'id');
    //return view('subcircuitos')->with('circuitos', $circuitos);

        return response()->json($provincia);
    }

       public function listado()
    {
    // Obtener todos los circuitos desde la base de datos
   $provincia = Provincia::pluck('descripcion', 'id');
    return view('registro_dependencia')->with('provincia', $provincia);
    }
    
}
