<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MantenimientoController;
use Illuminate\Http\Request;
use PDF;
use App\Models\Mantenimiento;

class PdfController extends Controller
{
    public function descargarPdf(Request $request)
    {
        // Lógica para obtener la información desde la base de datos o cualquier otra fuente
        $placa = $request->input('placa');
        $chasis = $request->input('chasis');
        $fecha_hora = $request->input('fecha_hora');
        $Kilometraje = $request->input('Kilometraje');
        $obs = $request->input('obs');  
         $nom_ape = $request->input('nom_ape');
    
        


        // Lógica para generar el contenido del PDF
        $pdf = PDF::loadView('pdf.solicitud', compact('placa', 'chasis', 'fecha_hora', 'Kilometraje', 'obs', 'nom_ape'));

        // Descargar el PDF
       return $pdf->download('solicitud.pdf');
    }

    public function descargarPdf_man(Request $request)
    {
        $id = $request->input('id');
           $detalles = Mantenimiento::join('solicituds', 'solicituds.id', '=', 'mantenimientos.id_solicitud')
        ->join('personals', 'personals.id', '=', 'solicituds.id_personal')
        ->join('vehiculos', 'vehiculos.id', '=', 'solicituds.id_vehiculo')
        ->select(
            'mantenimientos.*',
            'solicituds.id as solicitud_id',
            'personals.identificacion as identificacion',
            'personals.nom_ape as apellido_personal',
                'vehiculos.tipo_vehiculo',
            'vehiculos.placa as placa_vehiculo',
            'vehiculos.marca as marca_vehiculo',
            'mantenimientos.detalle',
            'mantenimientos.asunto',
            'mantenimientos.tipo_mantenimiento'
            // Agrega más columnas según sea necesario
        )
        ->where('mantenimientos.id', $id)
        ->first();
        $pdf = PDF::loadView('pdf.mantenimiento', compact('detalles'));

        // Descargar el PDF
       return $pdf->download('Detalle mantenimiento.pdf');
    }

        public function descargarPdf_det_man(Request $request)
    {
        $id = $request->input('id');
           $detalles = Mantenimiento::join('solicituds', 'solicituds.id', '=', 'mantenimientos.id_solicitud')
        ->join('personals', 'personals.id', '=', 'solicituds.id_personal')
        ->join('vehiculos', 'vehiculos.id', '=', 'solicituds.id_vehiculo')
        ->select(
            'mantenimientos.*',
            'solicituds.id as solicitud_id',
            'personals.identificacion as identificacion',
            'personals.nom_ape as apellido_personal',
                'vehiculos.tipo_vehiculo',
            'vehiculos.placa as placa_vehiculo',
            'vehiculos.marca as marca_vehiculo',
            'mantenimientos.detalle',
            'mantenimientos.asunto',
            'mantenimientos.tipo_mantenimiento',
            'solicituds.fecha_hora as solicitud_fecha',
            // Agrega más columnas según sea necesario
        )
        ->where('mantenimientos.id', $id)
        ->first();
        $pdf = PDF::loadView('pdf.mantenimiento_det', compact('detalles'));

        // Descargar el PDF
       return $pdf->download('Detalle mantenimiento.pdf');
    }
}
