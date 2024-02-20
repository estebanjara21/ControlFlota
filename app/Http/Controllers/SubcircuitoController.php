<?php

namespace App\Http\Controllers;

use App\Models\Subcircuito;
use Illuminate\Http\Request;

class SubcircuitoController extends Controller
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
    public function show(Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcircuito $subcircuito)
    {
        //
    }

    public function obtenerSubcircuitos(Request $request)
    {
        $idCircuito = $request->input('id_circuito');

        $subcircuitos = Subcircuito::where('id_circuito', $idCircuito)->pluck('descripcion', 'id');

        return response()->json($subcircuitos);
    }


    //
     public function registrar_subcircuito(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iSubcircuito' => 'required',
            'selCircuito' => 'required',
            'iCodSubcircuito' => 'required',
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $subcircuito= new Subcircuito();
        $subcircuito->descripcion = $request->input('iSubcircuito');
        $subcircuito->id_circuito = $request->input('selCircuito');
        $subcircuito->codigo_subcircuito = $request->input('iCodSubcircuito');
        $subcircuito->estado = '1';
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $subcircuito->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


public function eliminarCircuito($id)
{$subcircuito = Subcircuito::find($id);

    // Verifica si el circuito existe
    if ($subcircuito) {
        // Elimina el circuito
        $subcircuito->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}

    public function actualizarCircuito(Request $cont)
    {         $subcircuito = Subcircuito::find($cont->input('id'));

        if ($subcircuito) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $subcircuito->descripcion = $cont->input('subcircuito');
            $subcircuito->id_circuito = $cont->input('circuito');
            $subcircuito->codigo_subcircuito = $cont->input('cod_subcircuito');
            $subcircuito->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }


public function listado_sub_x_cir(Request $request)
    {
        $id_circuito = $request->input('idCir');

        $subcircuito = Subcircuito::where('id_circuito', $id_circuito)->pluck('descripcion', 'id');

        return response()->json($subcircuito);
    }

  public function obtener_subcircuito_total(Request $request)
    {
          $subcircuito = Subcircuito::pluck('descripcion', 'id');
        return response()->json($subcircuito);
    }
}
