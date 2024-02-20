<?php

namespace App\Http\Controllers;

use App\Models\Asignar_personal_vehiculos;
use Illuminate\Http\Request;

class AsignarPersonalVehiculosController extends Controller
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
    public function show(Asignar_personal_vehiculos $asignar_personal_vehiculos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignar_personal_vehiculos $asignar_personal_vehiculos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignar_personal_vehiculos $asignar_personal_vehiculos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignar_personal_vehiculos $asignar_personal_vehiculos)
    {
        //
    }

  public function registrar_asig_vehiculo_per(Request $request)
    {

        // Crear una nueva instancia del modelo y asignar valores
        $asig= new Asignar_personal_vehiculos();
        $asig->id_personal = $request->input('id_personal');
        $asig->id_vehiculo = $request->input('id_vehiculo');
        $asig->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $asig->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }

      public function eliminarAsignacionVehiPer($id)
      
        {$asignar = Asignar_personal_vehiculos::find($id);

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


public function buscardato_personal_vehiculo(Request $request)
{ 

 
$dato=$request->input('dato');
$personal = Asignar_personal_vehiculos::join('vehiculos', 'asignar_personal_vehiculos.id_vehiculo', '=', 'vehiculos.id')
    ->join('personals', 'asignar_personal_vehiculos.id_personal', '=', 'personals.id') // Corregir INNER JOIN con personal
    ->where(function ($query) use ($dato) {
        $query->where('personals.identificacion', $dato)
              ->orWhere('personals.nom_ape', 'like', "$dato");
    })
->select('vehiculos.tipo_vehiculo', 'vehiculos.placa', 'vehiculos.chasis', 'personals.id','asignar_personal_vehiculos.id_vehiculo','personals.nom_ape') // Agrega las columnas adicionales que desees recuperar
    ->get();
   
   return response()->json($personal);


}



}
 