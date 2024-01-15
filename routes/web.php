<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CircuitoController;
use App\Http\Controllers\SubcircuitoController;
use App\Http\Controllers\EventController;
/*
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
    Route::get('/actualizar-circuito/{id}/{cont}', [CircuitoController::class, 'actualizarCircuito'])->name('actualizar-circuito');

    Route::get('/circuitos', function(){
         //Obtenemos los circuitos de la BD;
         $circuitos = DB::table('circuitos')
        
        ->select(
            'circuitos.id',
            'circuitos.descripcion'
         
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
