<?php

namespace App\Http\Controllers;

use App\Models\Subcircuito;
use Illuminate\Http\Request;

class SubcircuitoController extends Controller
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
    public function show(Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcircuito $subcircuito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcircuito $subcircuito)
    {
        //
    }

    public function obtenerSubcircuitos(Request $request)
    {
        $idCircuito = $request->input('id_circuito');

        $subcircuitos = Subcircuito::where('id_circuito', $idCircuito)->pluck('descripcion', 'id');

        return response()->json($subcircuitos);
    }
}
