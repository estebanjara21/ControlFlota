<?php

namespace App\Http\Controllers;

use App\Models\AsignarArmamentoPersonal;
use App\Models\Examen;
use Illuminate\Http\Request;

class AsignarArmamentoPersonalController extends Controller
{

    public function registrar_asig_armamento_per(Request $request)

    {
        $asigArmamento = new AsignarArmamentoPersonal();
        $asigArmamento->identificacion = $request->input('identificacion');
        $asigArmamento->nombres_apellidos = $request->input('nombres_apellidos');
        $asigArmamento->rango = $request->input('rango');
        $asigArmamento->distrito = $request->input('distrito');
        $asigArmamento->tipo_arma = $request->input('tipo_arma');
        $asigArmamento->descripcion_arma = $request->input('descripcion_arma');
        $asigArmamento->fecha_registro = $request->input('fecha_registro');
        $asigArmamento->hora_registro = $request->input('hora_registro');

        // Guardar el modelo en la base de datos
        $asigArmamento->save();
         // Redirigir a una vista específica o a la misma página con un mensaje de éxito
         return redirect()->back()->with('success', 'Registro exitoso');
    }
    public function editarAsignacionArmamentoPer(Request $request, $id)
    {
        // Buscar la asignación de armamento por su ID
        $asigArmamento = AsignarArmamentoPersonal::find($id);

        // Verificar si la asignación existe
        if ($asigArmamento) {
            // Actualizar los campos con los nuevos valores
            $asigArmamento->identificacion = $request->input('identificacion');
            $asigArmamento->nombres_apellidos = $request->input('nombres_apellidos');
            $asigArmamento->rango = $request->input('rango');
            $asigArmamento->distrito = $request->input('distrito');
            $asigArmamento->tipo_arma = $request->input('tipo_arma');
            $asigArmamento->descripcion_arma = $request->input('descripcion_arma');
            $asigArmamento->fecha_registro = $request->input('fecha_registro');
            $asigArmamento->hora_registro = $request->input('hora_registro');

            // Guardar los cambios en la base de datos
            $asigArmamento->save();

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'Asignación de armamento actualizada exitosamente');
        } else {
            // Si la asignación no existe, devolver un mensaje de error
            return redirect()->back()->with('error', 'La asignación de armamento no existe');
        }
    }

    public function eliminarAsignacionArmamentoPer($id)
    {
        // Buscar la asignación de armamento por su ID
        $asigArmamento = AsignarArmamentoPersonal::find($id);

        // Verificar si la asignación existe
        if ($asigArmamento) {
            // Eliminar la asignación de armamento
            $asigArmamento->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'Asignación de armamento eliminada exitosamente');
        } else {
            // Si la asignación no existe, devolver un mensaje de error
            return redirect()->back()->with('error', 'La asignación de armamento no existe');
        }

    }

    public function obtener_datos_examens(Request $request)
    {
        // Obtener las columnas 'tipoArma', 'nombre' y 'descripcion' de la tabla 'examens'
        $datos_examens = Examen::select('tipoArma', 'nombre', 'descripcion')->get();

        // Convertir los resultados en un array asociativo
        $datos_asociativos = $datos_examens->map(function ($examen) {
            return [
                'tipoArma' => $examen->tipoArma,
                'nombre' => $examen->nombre,
                'descripcion' => $examen->descripcion
            ];
        });

        // Retornar los datos en formato JSON
        return response()->json($datos_asociativos);
    }

    public function registrar_asig_armamento(Request $request)
    {
        // Crear una nueva instancia del modelo y asignar valores
        $asig = new AsignarArmamentoPersonal();
        $asig->id_personal = $request->input('id_personal');
        $asig->tipo_arma = $request->input('tipo_arma');
        $asig->descripcion_arma = $request->input('descripcion_arma');
        $asig->estado = '1';

        // Guardar el modelo en la base de datos
        $asig->save();

        // Puedes redirigir a una vista específica o a la misma página con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro exitoso');
    }
    }
