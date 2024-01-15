<?php

namespace App\Http\Controllers;

use App\Models\Circuito;
use Illuminate\Http\Request;

class CircuitoController extends Controller
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
    public function show(Circuito $circuito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Circuito $circuito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Circuito $circuito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Circuito $circuito)
    {
        //
    }


    public function listado()
    {
    // Obtener todos los circuitos desde la base de datos
   $circuitos = Circuito::pluck('descripcion', 'id');
    return view('events-create')->with('circuitos', $circuitos);
    }


 //
     public function registrar_circuito(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iCircuito' => 'required',
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $circuito= new Circuito();
        $circuito->descripcion = $request->input('iCircuito');
        $circuito->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $circuito->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


// LISTAR CIRCUITOS

    public function filterCircuitos(Request $request)
    {
    $circuitos = DB::table('circuitos')
    ->select(
        'circuitos.id',
        'circuitos.descripcion'
    )
    
    ->get();

    $heads = [
        'ID',
        'Descripcion'];

return view('circuitos', compact('circuitos', 'heads'));
}


public function eliminarCircuito($id)
{$circuito = Circuito::find($id);

    // Verifica si el circuito existe
    if ($circuito) {
        // Elimina el circuito
        $circuito->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}


// app/Http/Controllers/CircuitoController.php

    public function actualizarCircuito($id,Request $cont)
    {
        $circuito = Circuito::find($id);

        if ($circuito) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $circuito->descripcion = $cont->input('circuito');
            $circuito->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }




}