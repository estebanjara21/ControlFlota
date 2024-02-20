<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
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
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
  public function registrar_vehiculo(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'selTipoV' => 'required',
            'iPlaca' => 'required',
            'iChasis' => 'required',
            'iMarca' => 'required',
            'iModelo' => 'required',
            'iMotor' => 'required',
            'iKilometraje' => 'required',
            'iCilindraje' => 'required',
            'iCapacidadC' => 'required',
            'iCapacidadP' => 'required',
        
        
            // Agrega más validaciones según tus campos
        ]);
 
        $vehiculo= new Vehiculo();
        $vehiculo->tipo_vehiculo = $request->input('selTipoV');
        $vehiculo->placa = $request->input('iPlaca');
        $vehiculo->chasis = $request->input('iChasis');
        $vehiculo->marca = $request->input('iMarca');
        $vehiculo->modelo = $request->input('iModelo');
        $vehiculo->motor = $request->input('iMotor');
        $vehiculo->kilometraje = $request->input('iKilometraje');
        $vehiculo->cilindraje = $request->input('iCilindraje');
        $vehiculo->capcarga = $request->input('iCapacidadC');
        $vehiculo->cappasejeros = $request->input('iCapacidadP');
        $vehiculo->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $vehiculo->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }



public function eliminarVehiculo($id)
{$vehiculo = Vehiculo::find($id);

    // Verifica si el circuito existe
    if ($vehiculo) {
        // Elimina el circuito
        $vehiculo->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}


public function actualizarVehiculo(Request $cont)

    { 

        $vehiculo = Vehiculo::find($cont->input('id'));

        if ($vehiculo) {
            
            $vehiculo->tipo_vehiculo = $cont->input('tipo_vehiculo');
            $vehiculo->placa = $cont->input('placa');
            $vehiculo->chasis = $cont->input('chasis');
            $vehiculo->marca = $cont->input('marca');
            $vehiculo->modelo = $cont->input('modelo');
            $vehiculo->motor = $cont->input('motor');
            $vehiculo->kilometraje = $cont->input('kilometraje');
            $vehiculo->cilindraje = $cont->input('cilindraje');
            $vehiculo->capcarga = $cont->input('capcarga');
            $vehiculo->cappasejeros = $cont->input('cappasejeros');
            
            
            $vehiculo->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }


}
