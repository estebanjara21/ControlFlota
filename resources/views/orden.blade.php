@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Generar Orden Combustible</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('registrar_combustible') }}" method="post">
                        @csrf
                        <div class="row">
                        <div class="row mt-3">

                            <x-adminlte-select id="selVehiculo" name="selVehiculo" label="Seleccionar Vehículo" fgroup-class="col-md-12" data-placeholder="Selecciona Vehículo...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-select>

                                                        <script>
                                                          $(document).ready(function(){
                                                        // Realizar la petición Ajax para obtener las asignaciones de vehículos
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: '{{ route("obtener-asignaciones") }}', // Ruta para obtener las asignaciones de vehículos
                                                            success: function (data) {
                                                                // Limpiar el select antes de agregar nuevas opciones
                                                                $('#selVehiculo').empty();
                                                                // Iterar sobre cada asignación y agregarla al select
                                                                $.each(data, function (index, asignacion) {
                                                                    // Aquí puedes utilizar los valores de id_personal e id_vehiculo
                                                                    var idPersonal = asignacion.id_personal;
                                                                    var idVehiculo = asignacion.id_vehiculo;

                                                                    // Aquí deberías hacer otra petición Ajax o utilizar una estructura de datos que mapee IDs a nombres
                                                                    // Por ejemplo, si tienes un objeto o arreglo con los nombres correspondientes a las IDs, podrías hacer algo como:
                                                                    var nombrePersonal = obtenerNombrePersonal(idPersonal);
                                                                    var nombreVehiculo = obtenerNombreVehiculo(idVehiculo);

                                                                    // Construir el texto de la opción según sea necesario
                                                                    var texto = 'Personal: ' + nombrePersonal + ', Vehículo: ' + nombreVehiculo;
                                                                    // Agregar la opción al select
                                                                    $('#selVehiculo').append($('<option>', {
                                                                        value: idVehiculo, // Aquí podrías usar idPersonal o idVehiculo según tu lógica
                                                                        text: texto
                                                                            }));
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script>



                        </div>


                        <!-- Campos para Solicitante -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="solicitante">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante">
                            </div>
                        </div>
                        <!-- Campos para Gasolinera -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gasolinera">Gasolinera</label>
                                <input type="text" class="form-control" id="gasolinera" name="gasolinera">
                            </div>
                        </div>
                        <!-- Campos para Galones de Combustible -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="galones_combustible">Galones de Combustible</label>
                                <input type="number" class="form-control" id="galones_combustible" name="galones_combustible">
                            </div>
                        </div>
                        <!-- Campos para Fecha y hora -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_hora">Fecha y Hora</label>
                                <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora">
                            </div>
                        </div>
                        <!-- Campos para Kilometraje actual -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kilometraje_actual">Kilometraje Actual</label>
                                <input type="number" class="form-control" id="kilometraje_actual" name="kilometraje_actual">
                            </div>
                        </div>
                        <!-- Campos para Fecha Solicitud -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_solicitud">Fecha Solicitud</label>
                                <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud">
                            </div>
                        </div>
                        <div class="row mt-3">
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
@push('js')
    <script>
        $(document).ready(function(){


            // Cargar datos de vehículos al cargar la página
            $.ajax({
        type: 'GET',
        url: '{{ route("obtener-asignaciones") }}', // Ruta para obtener las asignaciones de vehículos
        success: function (data) {
            // Limpiar el select antes de agregar nuevas opciones
            $('#selVehiculo').empty();
            // Iterar sobre cada asignación y agregarla al select
            $.each(data, function (index, asignacion) {
                // Aquí puedes utilizar los valores de id_personal e id_vehiculo
                var idPersonal = asignacion.id_personal;
                var idVehiculo = asignacion.id_vehiculo;
                // Construir el texto de la opción según sea necesario
                var texto = 'ID Personal: ' + idPersonal + ', ID Vehículo: ' + idVehiculo;
                // Agregar la opción al select
                $('#selVehiculo').append($('<option>', {
                    value: idVehiculo, // Aquí podrías usar idPersonal o idVehiculo según tu lógica
                    text: texto
                        }));
                    });
                }
            });
        });
    </script>
@endpush

