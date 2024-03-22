@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de Personal (Asignación de Armamento)</h1>
@stop
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                        @foreach($events as $event)
                            <tr>

                                 <td>{{ $event->id }}</td>
                                <td>{{ $event->identificacion }}</td>
                                <td>{{ $event->nom_ape }}</td>
                                <td>
                                @if($event->rango == 1)
                                    {{ "Capitan" }}
                                @elseif($event->rango == 2)
                                    {{ "Teniente" }}
                                @elseif($event->rango == 3)
                                    {{ "Subteniente" }}
                                @elseif($event->rango == 4)
                                    {{ "Sargento Primero" }}
                                @elseif($event->rango == 5)
                                    {{ "Sargento Segundo" }}
                                @elseif($event->rango == 6)
                                    {{ "Cabo Primero" }}
                                @elseif($event->rango == 7)
                                    {{ "Cabo Segundo" }}
                                @else
                                    {{"VACIO"}}
                                @endif
                                </td>
                                <td></td> <!-- Columna vacía para separar el botón -->
                                <td>
                                 <x-adminlte-button label="Asignar Arma" theme="success" icon="fas fa-thumbs-up" data-toggle="modal" data-target="#modalAsignarArma" onclick="cargardata('{{$event->id}}', '{{$event->nom_ape}}', '{{$event->rango}}')" />
                                 </td>

                                    <td></td> <!-- Columna vacía para separar el botón -->
                                    <td>{{ isset($fechaInicio) ? $fechaInicio : now()->format('Y-m-d') }}</td>
                                    <td>{{ isset($fechaInicio) ? $fechaInicio->format('H:i:s') : now()->format('H:i:s') }}</td>
                                    <td></td> <!-- Columna vacía para separar el botón -->
                                    <td></td> <!-- Columna vacía para separar el botón -->
                                    <td>
                                    <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                                       data-toggle="modal" data-target="#modalEliDis" onclick="cargardataEliAsig('{{$event->id}}', '{{$event->nom_ape}}')" />
                                                       <x-adminlte-button class="btn-lg" type="button" label="Editar" icon="fas fa-lg fa-edit"
                                                       data-toggle="modal" data-target="#modalEditarAsig" onclick="cargardataEditAsig('{{$event->id}}', '{{$event->nom_ape}}')" />


                                                       <x-adminlte-modal id="modalAsignarArma" title="Asignar Arma">
                                                        @csrf

                                                        <x-adminlte-select id="selArma" name="selArma" label="Arma" fgroup-class="col-md-12" data-placeholder="Selecciona Arma...">
                                                            <x-slot name="prependSlot">
                                                                <div class="input-group-text bg-gradient-info">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                </div>
                                                            </x-slot>

                                                        </x-adminlte-select>

                                                        <script>
                                                            $(document).ready(function(){

                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: 'obtener-armas',
                                                                    success: function (data) {
                                                                        // Limpia el select antes de agregar nuevas opciones
                                                                        $('#selArma').empty();
                                                                        // Agrega las opciones al select
                                                                        $.each(data, function (index, arma) {
                                                                            // Concatena el nombre y la descripción para mostrarlos en el texto de la opción
                                                                            var texto = arma.tipoArma + ' - ' + arma.nombre + ' (' + arma.descripcion + ')';
                                                                            $('#selArma').append($('<option>', {
                                                                                value: arma.id,
                                                                                text: texto
                                                                            }));
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                            <x-slot name="footerSlot">
                                                                                    <div name="agregaras" id="agregaras">
                                                                                    </div>
                                                                                    <button id="btnAgregarArma" class="btn btn-primary" onclick="agregarArma()">Agregar Arma</button>

                                                                                    <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                                                             </x-slot>


                                                             function agregarArma(id_personal) {
                                                                // Obtener el ID del arma seleccionada
                                                                var id_arma = $('#selArma').val();

                                                                // Realizar la solicitud AJAX
                                                                $.ajax({
                                                                    url: 'registrar_asig_armamento', // Reemplaza con la ruta adecuada en tu aplicación
                                                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                                                    data: {
                                                                        'id_personal': id_personal,
                                                                        'tipo_arma': id_arma,
                                                                        _token: $('meta[name="csrf-token"]').attr('content')
                                                                    },
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                        $('#modalAsignarArma').modal('hide');
                                                                        location.reload();
                                                                        // Realizar acciones adicionales después de la actualización si es necesario
                                                                    },
                                                                    error: function(error) {
                                                                        console.error('Error al agregar el arma', error);
                                                                    }
                                                                });
                                                            }



                            </script>
                            </x-adminlte-modal>

                         </tr>
                         @endforeach
                     </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
