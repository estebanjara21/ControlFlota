<?php

namespace App\Http\Controllers;

use App\Models\Registro_dependencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroDependenciasController extends Controller
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
    public function show(Registro_dependencias $registro_dependencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registro_dependencias $registro_dependencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registro_dependencias $registro_dependencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registro_dependencias $registro_dependencias)
    {
        //
    }

 public function registrardepe(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
           'selPro' => 'required',
           'selDistrito' => 'required',
            'selParroquia' => 'required',
            'selCircuito' => 'required',
            'selSubcircuito' => 'required',
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $registro_dependencias= new Registro_dependencias();
        $registro_dependencias->id_provincia = $request->input('selPro');
        $registro_dependencias->id_distrito = $request->input('selDistrito');
        $registro_dependencias->id_parroquia = $request->input('selParroquia');
        $registro_dependencias->circuito = $request->input('selCircuito');
        $registro_dependencias->id_subcircuito = $request->input('selSubcircuito');
        $registro_dependencias->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $registro_dependencias->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


 public function obtenerdepengroup(Request $request)
    {
$depend = DB::table('registro_dependencias')
        ->leftJoin('provincias', 'registro_dependencias.id_provincia', '=', 'provincias.id')
        ->leftJoin('parroquias', 'registro_dependencias.id_parroquia', '=', 'parroquias.id')
        ->leftJoin('distritos', 'registro_dependencias.id_distrito', '=', 'distritos.id')
        ->leftJoin('circuitos', 'registro_dependencias.circuito', '=', 'circuitos.id')
        ->leftJoin('subcircuitos', 'registro_dependencias.id_subcircuito', '=', 'subcircuitos.id')
        ->select(
            'registro_dependencias.id',
              DB::raw("CONCAT(provincias.descripcion, ' / ', parroquias.descripcion,' / ',distritos.descripcion,' / ',circuitos.descripcion,' / ',subcircuitos.descripcion ) as provincia"))
      
        ->get();


    // Transform the result to a simple array
    $resultArray = $depend->toArray();

    // Map the data to an associative array suitable for a combo box
    $comboData = [];
    foreach ($resultArray as $row) {
        $comboData[$row->id] = $row->provincia;
    }

    return response()->json(   $comboData);
    
}
  
}
