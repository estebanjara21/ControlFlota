@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Registro de Rastrillos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('registrar_rastrillo') }}" method="post">
                        @csrf
                        <div class="row">
                            <!-- Campos para el registro de rastrillos -->
                            <x-adminlte-input name="dependenciaRastrillo" label="Dependencia Rastrillo" placeholder="Ingrese Dependencia Rastrillo" label-class="text-lightblack" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-building text-lightblack"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="tipoArma" label="Tipo de Arma" placeholder="Ingrese Tipo de Arma" label-class="text-lightblack" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-crosshairs text-lightblack"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="nombre" label="Nombre" placeholder="Ingrese Nombre" label-class="text-lightblack" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblack"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="descripcion" label="Descripción" placeholder="Ingrese Descripción" label-class="text-lightblack" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-info-circle text-lightblack"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                            <x-adminlte-input name="codigo" label="Código" placeholder="Ingrese Código" label-class="text-lightblack" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-barcode text-lightblack"></i>
                                    </div>
                                </x-slot>
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
