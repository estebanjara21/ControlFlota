<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    //
     public function registrar(Request $request)
    {
        // Validación de datos del formulario
        $request->validate([
            'selCircuito' => 'required',
            'selSubcircuito' => 'required',
            'selTipo' => 'required',
            'taDesc' => 'required',
            'iApellidos' => 'required',
            'iNombres' => 'required',
            // Agrega más validaciones según tus campos
        ]);

        // Crear una nueva instancia del modelo y asignar valores
        $event= new Event();
        $event->id_circuito = $request->input('selCircuito');
        $event->id_subcircuito = $request->input('selSubcircuito');
        $event->tipo = $request->input('selTipo');
        $event->descripcion = $request->input('taDesc');
        $event->contactos = $request->input('iContacto');
        $event->apellidos = $request->input('iApellidos');
        $event->nombres = $request->input('iNombres');
        // Asigna otros campos según tu formulario

        // Guardar el modelo en la base de datos
        $event->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }


// ... Otros métodos del controlador

   public function filterEvents(Request $request)
{
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    $events = DB::table('events')
    ->join('circuitos', 'events.id_circuito', '=', 'circuitos.id')
    ->join('subcircuitos', 'events.id_subcircuito', '=', 'subcircuitos.id')
    ->select(
        'events.tipo',
        'circuitos.descripcion as circuito_nombre',
        'subcircuitos.descripcion as subcircuito_nombre',
        DB::raw('COUNT(events.id) as cantidad_eventos'),
        DB::raw('CASE WHEN(events.tipo) = 1 THEN "RECLAMO" WHEN (events.tipo) = 2 THEN "SUGERENCIA" ELSE "" END as tipo_evento') 
    )
    ->whereBetween(DB::raw('DATE(events.created_at)'), [$fechaInicio, $fechaFin])
    ->groupBy('events.tipo', 'circuitos.descripcion', 'subcircuitos.descripcion')
    ->get();

$heads = [
    'Fecha Inicio',
    'Fecha Fin',
    'Cantidad de Eventos',
    'Tipo de Evento',
    'Circuito',
    'Subcircuito',
];

return view('events', compact('events', 'heads', 'fechaInicio', 'fechaFin'));
}







}
