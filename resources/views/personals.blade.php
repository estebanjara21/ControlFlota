@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Registro de Personal</h1>
@stop
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('registrar_personal') }}" method="post">
                    @csrf
                    <div class="row">
                        <x-adminlte-input name="iIden" label="Identificacion" placeholder="Ingrese Identificacion" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="iNomApe" label="Nombres y Apellidos" placeholder="Ingrese Nombres y Apellidos" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        @php
                            $config = [
                                         'format' => 'YYYY-MM-DD',
                                        'locale' => 'es', // Set the locale to Spanish
                                        ];
                        @endphp
                        <x-adminlte-input-date  label="Fecha Nacimiento" name="ifechanac" value="2020-10-04" :config="$config" fgroup-class="col-md-6">
                             <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-check text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                        
                        <x-adminlte-input name="iTipoSangre" label="Tipo Sangre" placeholder="Ingrese Tipo Sangre" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-tint text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="iCiudad" label="Ciudad Nacimiento" placeholder="Ingrese Ciudad Nacimiento" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-city text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="iTelefono" label="Telefono Celular" placeholder="Telefono Celular" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                         <x-adminlte-select name="selRango" label="Rango o Grado" fgroup-class="col-md-6">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                      <i class="fas fa-user-md text-lightblack"></i>
                                    </div>
                                </x-slot>
                                <option>SELECCIONE RANGO O GRADO</option>
                                <option value="1">Capitan</option>
                                <option value="2">Teniente</option>
                                <option value="3">Subteniente</option>
                                <option value="4">Sargento Primero</option>
                                <option value="5">Sargento Segundo</option>
                                <option value="6">Cabo Primero</option>
                                <option value="7">Cabo Segundo</option>
                        </x-adminlte-select>

                        <x-adminlte-select2 id="selDependecia" name="selDependecia" label="Dependencia" fgroup-class="col-md-6" data-placeholder="Selecciona Dependencia...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script>
                                        $(document).ready(function () {
                                          
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-dependencia-group', 
                                                     
                                                    success: function (data) {
                                                       $('#selDependecia').append('<option>SELECCIONE DEPENDENCIA <option>');

                                                        $.each(data, function (id, descripcion) {
                                                            $('#selDependecia').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                          
                                        });
                                    </script>
                                </x-adminlte-select2>

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
