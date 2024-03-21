<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
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
    public function show(examen $examen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(examen $examen)
    {
        return view('editar_rastrillo', compact('examen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, examen $examen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(examen $examen)
    {
        $examen->delete();

        // Puedes redirigir a la vista de listado o a donde sea necesario
        return redirect()->route('list_rastrillo')->with('success', 'Eliminación exitosa');
    }
    public function registrar_rastrillo(Request $request)
{
    // Validación de datos del formulario
    $request->validate([
        'dependenciaRastrillo' => 'required',
        'tipoArma' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'codigo' => 'required',
    ]);

    // Crear una nueva instancia del modelo y asignar valores
    $rastrillo = new Examen();
    $rastrillo->dependenciaRastrillo = $request->input('dependenciaRastrillo');
    $rastrillo->tipoArma = $request->input('tipoArma');
    $rastrillo->nombre = $request->input('nombre');
    $rastrillo->descripcion = $request->input('descripcion');
    $rastrillo->codigo = $request->input('codigo');

    // Guardar el modelo en la base de datos
    $rastrillo->save();


    return redirect()->back()->with('success', 'Registro exitoso');
}
public function listarRastrillos()
{
    $registros = Examen::all();
    $heads = [
        'ID',
        'Dependencia Rastrillo',
        'Tipo de Arma',
        'Nombre',
        'Descripción',
        'Código',
        'Acciones',
    ];

    return view('list_rastrillo', compact('registros', 'heads'));
}
}
