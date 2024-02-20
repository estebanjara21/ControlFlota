<?php

namespace App\Http\Controllers;

use App\Models\Personals;
use Illuminate\Http\Request;

class PersonalsController extends Controller
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
    public function show(Personals $personals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personals $personals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personals $personals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personals $personals)
    {
        //
    }

    public function registrar_personal(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'iIden' => 'required',
            'iNomApe' => 'required',
            'ifechanac' => 'required',
            'iTipoSangre' => 'required',
            'iCiudad' => 'required',
            'iTelefono' => 'required',
            'selRango' => 'required',
            'selDependecia' => 'required',
        
        
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $personal= new Personals();
        $personal->identificacion = $request->input('iIden');
        $personal->nom_ape = $request->input('iNomApe');
        $personal->fecha_nac = $request->input('ifechanac');
        $personal->tipo_sangre = $request->input('iTipoSangre');
        $personal->ciudad = $request->input('iCiudad');
        $personal->telefono = $request->input('iTelefono');
        $personal->rango = $request->input('selRango');
        $personal->dependencia = $request->input('selDependecia');
        $personal->estado = '1';
        
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $personal->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


public function eliminarPersonal($id)
{$personal = Personals::find($id);

    // Verifica si el circuito existe
    if ($personal) {
        // Elimina el circuito
        $personal->delete();

        // Devuelve una respuesta JSON indicando el éxito de la eliminación
        return redirect()->back()->with('success', 'Registro exitoso');

    } else {
        // Devuelve una respuesta JSON indicando que el circuito no existe
        return response()->json(['success' => false, 'message' => 'El circuito no existe']);
    }
}

 public function actualizarPersonal(Request $cont)

    { 

        $personal = Personals::find($cont->input('id'));

        if ($personal) {
            $personal->identificacion = $cont->input('identificacion');
            $personal->nom_ape = $cont->input('nom_ape');
            $personal->fecha_nac = $cont->input('fecha_nac');
            $personal->tipo_sangre = $cont->input('tipo_sangre');
            $personal->ciudad = $cont->input('ciudad');
            $personal->telefono = $cont->input('telefono');
            $personal->rango = $cont->input('rango');
            $personal->dependencia = $cont->input('dependencia');
            
            $personal->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }


}
