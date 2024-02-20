<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CircuitoController;
use App\Http\Controllers\SubcircuitoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\ParroquiaController;
use App\Http\Controllers\RegistroDependenciasController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AsignarPersonalSubcircuitosController;
use App\Http\Controllers\AsignarVehiculoSubcircuitosController;
use App\Http\Controllers\AsignarPersonalVehiculosController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\MantenimientoController;
/*AsignarVehiculoSubcircuitosController
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('circuitos', 'CircuitoController');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/events-create', [CircuitoController::class, 'listado'])->name('events-create');
    Route::get('/obtener-subcircuitos', [SubcircuitoController::class, 'obtenerSubcircuitos']);
    Route::post('/registrar', [EventController::class, 'registrar'])->name('registrar');
    Route::post('/registrar_circuito', [CircuitoController::class, 'registrar_circuito'])->name('registrar_circuito');
    Route::post('/events', [EventController::class, 'filterEvents']);
    Route::get('/eliminar-circuito/{id}', [CircuitoController::class, 'eliminarCircuito'])->name('eliminarCircuito');
    Route::post('/actualizar-circuito', [CircuitoController::class, 'actualizarCircuito'])->name('actualizar-circuito');
    //FALTANTES
     Route::post('/actualizar-dependencia', [RegistroDependenciasController::class, 'actualizarDependencia'])->name('actualizar-dependencia');
    Route::get('/obtener-provinncia', [ProvinciaController::class, 'listado_provincia'])->name('obtener-provinncia');
     Route::get('/eliminar-dependecia/{id}', [RegistroDependenciasController::class, 'eliminarDependencia'])->name('eliminar-dependecia');
    //listado MP
      Route::get('/descargar-pdf-det-mant', [PdfController::class, 'descargarPdf_det_man'])->name('descargar-pdf-det-mant');
       Route::post('/actualizar_estado_mant', [MantenimientoController::class, 'actualizar_estado_mant'])->name('actualizar_estado_mant');
       Route::get('/descargar-pdf-mant', [PdfController::class, 'descargarPdf_man'])->name('descargar-pdf-mant');


    Route::get('/list_mps', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('mantenimientos')
          ->join('solicituds', 'solicituds.id', '=', 'mantenimientos.id_solicitud')
          ->join('personals', 'solicituds.id_personal', '=', 'personals.id')
        ->join('vehiculos', 'solicituds.id_vehiculo', '=', 'vehiculos.id')



        ->select(

            'personals.identificacion',
            'personals.nom_ape',
            'vehiculos.tipo_vehiculo',
            'vehiculos.placa',
            'mantenimientos.tipo_mantenimiento',
            'mantenimientos.id',
            'mantenimientos.estado',
             'mantenimientos.persona_retira',




           // 'asignar_personal_subcircuitos.id_subcircuito',


        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'Identificacion',
        'Nombre y Apellido',
        'Tipo Vehiculo',
        'Placa',
        'Tipo Mantenimiento',
         'Observaciones',
        'OPCIONES',
    ];

    // Retornar la vista con los parámetros
    return view('list_mps', compact('events', 'heads'));

    });

    //RECEPREG
    Route::post('/guardar_mantenimiento', [MantenimientoController::class, 'guardar'])->name('guardar_mantenimiento');
    Route::post('/actualizar_estado_solicitud', [SolicitudController::class, 'actualizar_estado_solicitud'])->name('actualizar_estado_solicitud');
    Route::get('/recepreg', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('solicituds')
          ->join('personals', 'solicituds.id_personal', '=', 'personals.id')
        ->join('vehiculos', 'solicituds.id_vehiculo', '=', 'vehiculos.id')
        ->leftJoin('mantenimientos', 'solicituds.id', '=', 'mantenimientos.id_solicitud')


        ->select(

            'personals.identificacion',
            'personals.nom_ape',
            'vehiculos.tipo_vehiculo',
            'vehiculos.placa',
            'solicituds.estado',
            'solicituds.id',
            'vehiculos.marca',
            'vehiculos.modelo',
            'solicituds.id as id_soli',
            'mantenimientos.estado as estado_man',



           // 'asignar_personal_subcircuitos.id_subcircuito',


        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'Identificacion',
        'Nombre y Apellido',
        'Tipo Vehiculo',
        'Placa',
        'OPCIONES',
    ];

    // Retornar la vista con los parámetros
    return view('recepreg', compact('events', 'heads'));

    });

    // ficha SOLICITUD
    Route::get('/descargar-pdf', [PdfController::class, 'descargarPdf'])->name('descargar-pdf');
         Route::post('/registrar_solicitud', [SolicitudController::class, 'registrar_solicitud'])->name('registrar_solicitud');
         Route::get('/buscardato_personal_vehiculo', [AsignarPersonalVehiculosController::class, 'buscardato_personal_vehiculo']);

        Route::get('/solicituds', function(){
        return view ('solicituds');

    });

    //Proceso de Asignacion  de Vehiculo a Personal
    Route::get('/eliminar-asignacion-vehiculos/{id}', [AsignarPersonalVehiculosController::class, 'eliminarAsignacionVehiPer'])->name('eliminar-asignacion-vehiculos');

     Route::post('/registrar_asig_vehiculo_per', [AsignarPersonalVehiculosController::class, 'registrar_asig_vehiculo_per'])->name('registrar_asig_vehiculo_per');
    Route::get('/obtener-subcircuito-x-per-vehi', [AsignarVehiculoSubcircuitosController::class, 'obtener_vehiculo_asig']);


    Route::get('/asignar_peronal_vehiculos', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('personals')
          ->leftJoin('asignar_personal_subcircuitos', 'asignar_personal_subcircuitos.id_personal', '=', 'personals.id')
        ->leftJoin('asignar_personal_vehiculos', 'asignar_personal_vehiculos.id_personal', '=', 'personals.id')
        ->leftJoin('vehiculos', 'asignar_personal_vehiculos.id_vehiculo', '=', 'vehiculos.id')

        ->select(
            'personals.id',
            'personals.identificacion',
            'personals.nom_ape',
            'asignar_personal_subcircuitos.id_subcircuito as id_subcircuito',
            'asignar_personal_vehiculos.id as id_personal_vehi',
            'vehiculos.placa',
            'vehiculos.tipo_vehiculo'

           // 'asignar_personal_subcircuitos.id_subcircuito',


        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Identificacion',
        'Nombre y Apellido',
        'Datos Vehiculo',

        'Opciones',
        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('asignar_peronal_vehiculos', compact('events', 'heads'));

    });



    //Proceso Asignacion Vehiculo a Sub circuito
    Route::post('/actualizar-asignacion_vehi', [AsignarVehiculoSubcircuitosController::class, 'actualizarAsignacionVe'])->name('actualizar-asignacion_vehi');
        Route::get('/eliminar-asignacion-vehi/{id}', [AsignarVehiculoSubcircuitosController::class, 'eliminarAsignacionVehi'])->name('eliminar-asignacion-vehi');
     Route::post('/registrar_asig_vehiculo_subc', [AsignarVehiculoSubcircuitosController::class, 'reg_asig_vehi_sub'])->name('registrar_asig_vehiculo_subc');
    Route::get('/asignar_vehiculo_subcircuitos', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('vehiculos')
         ->leftJoin('asignar_vehiculo_subcircuitos', 'asignar_vehiculo_subcircuitos.id_vehiculo', '=', 'vehiculos.id')
       ->leftJoin('subcircuitos', 'asignar_vehiculo_subcircuitos.id_subcircuito', '=', 'subcircuitos.id')
        ->leftJoin('circuitos', 'circuitos.id', '=', 'subcircuitos.id_circuito')
        ->leftJoin('distritos', 'circuitos.id_distrito', '=', 'distritos.id')
         ->leftJoin('provincias', 'provincias.id', '=', 'distritos.id_provincia')
        ->select(
            'vehiculos.*',
             'asignar_vehiculo_subcircuitos.id_subcircuito',
             'subcircuitos.descripcion as subcircuito',
            'circuitos.descripcion as circuito',
            'distritos.descripcion as distrito',
            'provincias.descripcion as provincia',
            'asignar_vehiculo_subcircuitos.id as id_asig',
        )
        ->get();


    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Tipo Vehiculo',
        'Placa',
        'Datos Asignacion',
        'Opciones'


        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('asignar_vehiculo_subcircuitos', compact('events', 'heads'));

    });



    //Proceso Asignacion Personal a Sub circuito
    Route::post('/actualizar-asignacion', [AsignarPersonalSubcircuitosController::class, 'actualizarAsignacion'])->name('actualizar-asignacion');
    Route::get('/eliminar-asignacion/{id}', [AsignarPersonalSubcircuitosController::class, 'eliminarAsignacion'])->name('eliminar-asignacion');
    Route::post('/registrar_asig_per_subc', [AsignarPersonalSubcircuitosController::class, 'reg_asig_per_sub'])->name('registrar_asig_per_subc');
     Route::get('/obtener-subcircuito-asig', [SubcircuitoController::class, 'obtener_subcircuito_total']);
    Route::get('/asignar_peronal_subcircuitos', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('personals')
        ->leftJoin('asignar_personal_subcircuitos', 'asignar_personal_subcircuitos.id_personal', '=', 'personals.id')
        ->leftJoin('subcircuitos', 'asignar_personal_subcircuitos.id_subcircuito', '=', 'subcircuitos.id')
        ->leftJoin('circuitos', 'circuitos.id', '=', 'subcircuitos.id_circuito')
        ->leftJoin('distritos', 'circuitos.id_distrito', '=', 'distritos.id')
         ->leftJoin('provincias', 'provincias.id', '=', 'distritos.id_provincia')
        ->select(
            'personals.id',
            'personals.identificacion',
            'personals.nom_ape',
            'asignar_personal_subcircuitos.id_subcircuito',
            'subcircuitos.descripcion as subcircuito',
            'circuitos.descripcion as circuito',
            'distritos.descripcion as distrito',
            'provincias.descripcion as provincia',
            'asignar_personal_subcircuitos.id as id_asig',


        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Identificacion',
        'Nombre y Apellido',
        'Datos de Asignacion',
        'Opciones',
        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('asignar_peronal_subcircuitos', compact('events', 'heads'));

    });


    //VEHICULO
          Route::post('/actualizar-vehiculo', [VehiculoController::class, 'actualizarVehiculo'])->name('actualizar-vehiculo');
       Route::get('/eliminarvehiculo/{id}', [VehiculoController::class, 'eliminarVehiculo'])->name('eliminarvehiculo');
    Route::get('/list_vehiculos', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('vehiculos')

        ->select(
            'vehiculos.*',

        )
        ->get();


    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Tipo Vehiculo',
        'Placa',
        'Chasis',
        'Marca',
        'Modelo',
        'Motor',
        'kilometraje',
        'Cilindraje',
        'Capacidad Carga',
        'Capacidad Pasajeros',
         'Opciones',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('list_vehiculos', compact('events', 'heads'));

    });

       Route::post('/registrar_vehiculo', [VehiculoController::class, 'registrar_vehiculo'])->name('registrar_vehiculo');
       Route::get('/vehiculos', function(){
       return view ('vehiculos');

    });


    // PERSONAL
        Route::post('/actualizar-personal', [PersonalsController::class, 'actualizarPersonal'])->name('actualizar-personal');
     Route::get('/eliminarpersonal/{id}', [PersonalsController::class, 'eliminarPersonal'])->name('eliminarpersonal');
       Route::get('/list_personals', function(){
        //Obtenemos los eventos de la BD;
         $events = DB::table('personals')
        ->join('registro_dependencias', 'registro_dependencias.id', '=', 'personals.dependencia')
        ->join('provincias', 'provincias.id', '=', 'registro_dependencias.id_provincia')
        ->select(
            'personals.id',
            'personals.identificacion',
            'personals.nom_ape',
            'personals.fecha_nac',
            'personals.tipo_sangre',
            'personals.ciudad',
            'personals.telefono',
            'personals.rango',
            'provincias.descripcion as prov',
            'registro_dependencias.id as dep',
        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Identificacion',
        'Nombre y Apellido',
        'Fecha Nacimiento',
        'Tipo Sangre',
        'Ciudad',
        'telefono',
        'Rango',
        'Dependencia',
         'Opciones',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('list_personals', compact('events', 'heads'));

    });

    Route::post('/registrar_personal', [PersonalsController::class, 'registrar_personal'])->name('registrar_personal');
     Route::get('/obtener-dependencia-group', [RegistroDependenciasController::class, 'obtenerdepengroup'])->name('obtener-dependencia-group');
     Route::get('/personals', function(){
        return view ('personals');

    });

    //DEPENDENCIA
      Route::get('/listado_dependencias', function(){
        //Obtenemos los eventos de la BD;
         $depend = DB::table('registro_dependencias')
        ->join('provincias', 'registro_dependencias.id_provincia', '=', 'provincias.id')
        ->join('parroquias', 'registro_dependencias.id_parroquia', '=', 'parroquias.id')
        ->join('distritos', 'registro_dependencias.id_distrito', '=', 'distritos.id')
        ->join('circuitos', 'registro_dependencias.circuito', '=', 'circuitos.id')
         ->join('subcircuitos', 'registro_dependencias.id_subcircuito', '=', 'subcircuitos.id')
        ->select(
            'provincias.descripcion as provincia',
            'parroquias.descripcion as parroquia',
            'distritos.codigo_distrito',
            'distritos.descripcion as distrito',
            'circuitos.codigo_circuito',
            'circuitos.descripcion as circuito',
            'subcircuitos.codigo_subcircuito',
            'subcircuitos.descripcion as subcircuitos',
            'subcircuitos.id',
            'registro_dependencias.id as id_depe',
        )

        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'Provincia',
        'Parroquia',
        'Cod Distrito',
        'Distrito',
        'Cod Circuito',
        'Circuito',
        'Cod Subircuito',
        'Subircuito',
        'Opciones',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('listado_dependencias', compact('depend', 'heads'));

    });


    Route::get('/registro_dependencia', [ProvinciaController::class, 'listado'])->name('registro_dependencia');
    Route::get('/obtener-distrito-x-pro', [DistritoController::class, 'obtenerDisxPro'])->name('obtener-distrito-x-pro');
    Route::get('/obtener-parro-x-dis', [ParroquiaController::class, 'obtenerParrxdis'])->name('obtener-parro-x-dis');
    Route::get('/obtener-cir-x-dis', [CircuitoController::class, 'obtenerCirxdis'])->name('obtener-cir-x-dis');
    Route::post('/registrar_dependencia', [RegistroDependenciasController::class, 'registrardepe'])->name('registrar_dependencia');
    //PARROQUIAS
    Route::post('/actualizarparro', [ParroquiaController::class, 'actualizarparro'])->name('actualizarparro');
    Route::get('/obtener-dis-act', [DistritoController::class, 'listado_distrito'])->name('obtener-dis-act');
    Route::get('/eliminarparroquia/{id}', [ParroquiaController::class, 'eliminarparroquia'])->name('eliminarparroquia');
    Route::post('/registrarparroquia', [ParroquiaController::class, 'registrarparroquia'])->name('registrarparroquia');
    Route::get('/obtener-distrito', [DistritoController::class, 'listado_distrito'])->name('obtener-distrito');
     Route::get('/parroquias', function(){
         //Obtenemos los circuitos de la BD;
         $parroquias = DB::table('parroquias')
        ->join('distritos', 'distritos.id', '=', 'parroquias.id_distrito')


        ->select(
            'parroquias.id',
            'parroquias.descripcion',
            'distritos.descripcion as des_cir',
            'distritos.id as id_dis'

        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'descripcion',
        'Distritos',
        'OPCIONES',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('parroquias', compact('parroquias', 'heads'));

    });

    //PROVINCIAS
    Route::post('/actualizarpro', [ProvinciaController::class, 'actualizarpro'])->name('actualizarpro');
    Route::get('/eliminarpro/{id}', [ProvinciaController::class, 'eliminarpro'])->name('eliminarpro');
   Route::post('/registrar_pro', [ProvinciaController::class, 'registrar_pro'])->name('registrar_pro');
    Route::get('/provincias', function(){
         //Obtenemos los circuitos de la BD;
         $provincias = DB::table('provincias')

        ->select(
            'provincias.id',
            'provincias.descripcion',
        )
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'descripcion',
        'OPCIONES',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('provincias', compact('provincias', 'heads'));

    });
    //DISTRITOS
    Route::post('/actualizar-distrito', [DistritoController::class, 'actualizarDistrito'])->name('actualizar-distrito');
     Route::get('/obtener-prov-act', [ProvinciaController::class, 'listado_provincia'])->name('obtener-prov-act');
    Route::get('/eliminar-distrito/{id}', [DistritoController::class, 'eliminarDistrito'])->name('eliminar-distrito');
     Route::post('/registrardist', [DistritoController::class, 'registrar_dis'])->name('registrardist');
    Route::get('/obtener-prov', [ProvinciaController::class, 'listado_provincia'])->name('obtener-prov');
     Route::get('/distritos', function(){
         //Obtenemos los circuitos de la BD;
         $provincias = DB::table('distritos')
        ->join('provincias', 'provincias.id', '=', 'distritos.id_provincia')

        ->select(
            'distritos.id',
            'distritos.codigo_distrito',
            'distritos.descripcion',
            'provincias.descripcion as des_cir',
            'provincias.id as id_pro'


        )

        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Cod-Distrito',
        'descripcion',
        'provincia',
        'OPCIONES',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('distritos', compact('provincias', 'heads'));

    });

    //Subcircuitos
    Route::get('/obtener-sub-x-cir', [SubcircuitoController::class, 'listado_sub_x_cir'])->name('obtener-sub-x-cir');
    Route::get('/obtener-circuitos', [CircuitoController::class, 'listado_subcircuitos'])->name('obtener-circuitos');
   Route::post('/actualizar-subcircuito', [SubcircuitoController::class, 'actualizarCircuito'])->name('actualizar-subcircuito');
    Route::get('/obtener-circuitos_act', [CircuitoController::class, 'listado_subcircuitos'])->name('obtener-circuitos');
    Route::post('/registrar_subcircuito', [SubcircuitoController::class, 'registrar_subcircuito'])->name('registrar_subcircuito');
    Route::get('/eliminar-subcircuito/{id}', [SubcircuitoController::class, 'eliminarCircuito'])->name('eliminarCircuito');
    Route::get('/subcircuitos', function(){
         //Obtenemos los circuitos de la BD;
         $subcircuitos = DB::table('subcircuitos')
        ->join('circuitos', 'subcircuitos.id_circuito', '=', 'circuitos.id')

        ->select(
            'subcircuitos.id',
            'subcircuitos.codigo_subcircuito',
            'subcircuitos.descripcion',
            'circuitos.descripcion as des_cir',
            'circuitos.id as id_circuito'


        )

        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Cod-Subcircuito',
        'descripcion',
        'Circuitos',
        'OPCIONES',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('subcircuitos', compact('subcircuitos', 'heads'));

    });


    Route::get('/circuitos', function(){
         //Obtenemos los circuitos de la BD;
         $circuitos = DB::table('circuitos')
        ->select(
            'circuitos.id',
            'circuitos.descripcion',
            'circuitos.codigo_circuito'

        )

        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'ID',
        'Cod-Circuito',
        'Descripcion',
        'OPCIONES',

        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('circuitos', compact('circuitos', 'heads'));

    });





    Route::get('/events', function(){
        //Obtenemos los eventos de la BD;
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
        ->groupBy('events.tipo', 'circuitos.descripcion', 'subcircuitos.descripcion')
        ->get();

    // Asignar la cabecera de tu datatable
    $heads = [
        'Fecha Inicio',
        'Fecha Fin',
        '#',
        'Tipo',
        'Circuito',
        'Subcircuito',
        // Nueva columna para la cantidad de eventos
    ];

    // Retornar la vista con los parámetros
    return view('events', compact('events', 'heads'));

    });

    Route::get('/events/create', function(){
        return view ('events-create');

    });



});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
