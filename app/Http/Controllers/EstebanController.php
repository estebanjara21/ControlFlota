<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
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
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
     public function registrar_solicitud(Request $request)
    {       $solicitud= new Solicitud();
              $solicitud->id_personal = $request->input('id_personal');
              $solicitud->id_vehiculo = $request->input('id_vehiculo');
              $solicitud->fecha_hora = $request->input('fecha_hora');
              $solicitud->Kilometraje = $request->input('Kilometraje');
              $solicitud->observacion = $request->input('obs');
              $solicitud->estado = '1';

            $solicitud->save();


return response()->json(['success' => true, 'message' => 'Registro exitoso']);


    }


    public function actualizar_estado_solicitud(Request $cont)

    {

        $solicitud = Solicitud::find($cont->input('id'));

        if ($solicitud) {

            $solicitud->estado = $cont->input('estado');
            $solicitud->save();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Circuito no encontrado'], 404);
        }
    }




}
