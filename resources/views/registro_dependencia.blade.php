@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">DEPENDENCIA</h1>
@stop
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('registrar_dependencia') }}" method="post">
                    @csrf

                       <x-adminlte-select2 name="selPro" id="selPro" label="Provincia" fgroup-class="col-md-12" data-placeholder="Selecciona Provincia...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <option value=""></option> {{-- Opción vacía --}}
                                    @foreach($provincia as $id => $descripcion)
                                        <option value="{{ $id }}">{{ $descripcion }}</option>
                                    @endforeach
                        </x-adminlte-select2>
                    

                        <div class="row">
                            <x-adminlte-select2 id="selDistrito" name="selDistrito" label="Distrito" fgroup-class="col-md-12" data-placeholder="Selecciona Distrito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                       
                                    <script>
                                        $(document).ready(function () {
                                            $('#selPro').change(function () {
                                                var idPro = $(this).val();

                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-distrito-x-pro',
                                                    data: { idPro: idPro },
                                                    success: function (data) {
                                                        $('#selDistrito').empty();
                                                        $('#selDistrito').append('<option>SELECCIONE DISTRITO <option>');
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selDistrito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </x-adminlte-select2>

                            
                        </div>

                          <div class="row">
                            <x-adminlte-select2 id="selParroquia" name="selParroquia" label="Parroquia" fgroup-class="col-md-12" data-placeholder="Selecciona Parroquia...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <option>Seleccione Parroquia</option>
                                    <script>
                                        $(document).ready(function () {
                                            $('#selDistrito').change(function () {
                                                var idDis = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-parro-x-dis',
                                                    data: { idDis: idDis },
                                                    success: function (data) {
                                                        $('#selParroquia').empty();
                                                        $('#selParroquia').append('<option>SELECCIONE PARROQUIA <option>');

                                                        $.each(data, function (id, descripcion) {
                                                            $('#selParroquia').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </x-adminlte-select2>
                        </div>
                        <div class="row">
                            <x-adminlte-select2 id="selCircuito" name="selCircuito" label="Circuito" fgroup-class="col-md-12" data-placeholder="Selecciona Circuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                   
                                    <script>
                                        $(document).ready(function () {
                                            $('#selDistrito').change(function () {
                                                console.log("VAMOS BIEN")
                                                var idDis = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-cir-x-dis',
                                                    data: { idDis: idDis },
                                                    success: function (data) {
                                                        $('#selCircuito').empty();
                                                        $('#selCircuito').append('<option>SELECCIONE CIRCUITO <option>');
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selCircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </x-adminlte-select2>

                            
                        </div>

                        <div class="row">
                            <x-adminlte-select2 id="selSubcircuito" name="selSubcircuito" label="Subcircuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                   
                                    <script>
                                        $(document).ready(function () {
                                            $('#selCircuito').change(function () {
                                                console.log("VAMOS BIEN")
                                                var idCir = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-sub-x-cir',
                                                    data: { idCir: idCir },
                                                    success: function (data) {
                                                        $('#selSubcircuito').empty();
                                                        $('#selSubcircuito').append('<option>SELECCIONE CIRCUITO <option>');
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            })); 
                                                        });
                                                    }
                                                });
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
