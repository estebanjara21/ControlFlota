@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Vehiculos</h1>
@stop
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                      <form action="{{ route('registrar_vehiculo') }}" method="post">
                        @csrf
                    <div class="row">
                      
                        <x-adminlte-select name="selTipoV" label="Tipo de vehículo " fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                      <i class="fas fa-car text-lightblack"></i>
                                    </div>
                                </x-slot>
                                <option>SELECCIONE TIPO VEHICULO</option>
                                <option value="1">Auto</option>
                                <option value="2">Motocicleta</option>
                                <option value="3">Camioneta</option>
                        </x-adminlte-select>
                         <x-adminlte-input name="iPlaca" label="Placa" placeholder="Placa" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="iChasis" label="Chasis" placeholder="Chasis" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iMarca" label="Marca" placeholder="Marca" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                        <x-adminlte-input name="iModelo" label="Modelo" placeholder="Modelo" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iMotor" label="Motor" placeholder="Motor" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iKilometraje" label="Kilometraje" placeholder="Kilometraje" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iCilindraje" label="Cilindraje" placeholder="Cilindraje" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                            <x-adminlte-input name="iCapacidadC" label="Capacidad de Carga" placeholder="Capacidad de Carga" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                    <x-adminlte-input type="number" name="iCapacidadP" label="Capacidad de Pasajeros" placeholder="Capacidad de Pasajeros" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                    </div>
                      <div class="row">

                            <div class="form-group col-md-12">
                                 <x-adminlte-button type="submit" label="Registrar" theme="primary" icon="fas fa-save" class="w-100"/>
                            </div>
                   
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop
