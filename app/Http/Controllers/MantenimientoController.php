<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
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
    public function show(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        //
    }

    public function guardar(Request $request)
    {
       // Obtener datos del formulario
        $iSoli = $request->input('iSoli');
        $fecha_hora = $request->input('fecha_hora');
        $kilometraje = $request->input('Kilometraje');
        $asunto = $request->input('iAsunto');
        $detalle = $request->input('iDetalle');
           $tipo = $request->input('tipo_mante');
        // ... Otros campos ...

        // Guardar en la base de datos
        $mantenimiento = new Mantenimiento();
        $mantenimiento->id_solicitud = $iSoli;
        $mantenimiento->fecha_hora = $fecha_hora;
        $mantenimiento->kilometraje = $kilometraje;
        $mantenimiento->asunto = $asunto;
        $mantenimiento->detalle = $detalle;
        $mantenimiento->tipo_mantenimiento = $tipo;
         $mantenimiento->estado = '1';
        // ... Otros campos ...
 
        // Guardar imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('mantenimientos');
            $mantenimiento->imagen = $imagenPath;
        }

        $mantenimiento->save();

        // Puedes agregar más lógica o redirección aquí

        return redirect()->back()->with('success', 'Mantenimiento guardado exitosamente.');
    }



      public function actualizar_estado_mant(Request $cont)
    {         $mantenimiento = Mantenimiento::find($cont->input('id'));

        if ($mantenimiento) {
            // Actualiza la descripción del circuito con la nueva información proporcionada
            $mantenimiento->persona_retira = $cont->input('iPersona_r');
            $mantenimiento->estado='3';
           
            $mantenimiento->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }
}
