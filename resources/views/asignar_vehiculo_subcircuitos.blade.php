@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Listado de Vehiculos para Asignacion</h1>
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
                                             <td>{{$event->id}}</td>
                                        <td> @if($event->tipo_vehiculo == 1)
                                                {{ "Auto" }}
                                             @elseif($event->tipo_vehiculo == 2)
                                                {{ "Motocicleta" }}
                                             @elseif($event->tipo_vehiculo == 3)
                                                {{ "Camioneta" }}

                                             @else {{"VACIO"}}
                                            @endif
                                        </td>
                                        <td>{{$event->placa}}</td>
                                        <td>@if(!empty($event->id_subcircuito))
                                               <b>SubCircuito: </b>{{ $event->subcircuito }}<br>
                                                <b>Circuito: </b>{{ $event->circuito }}<br>
                                                <b>Distrito: </b>{{ $event->distrito }}<br>
                                                <b>Provincia: </b>{{ $event->provincia }}<br>

                                            @else
                                                  <x-adminlte-button label="Agregar" theme="success" icon="fas fa-thumbs-up" data-toggle="modal" data-target="#modalAgreSub" onclick="cargardata('{{$event->id}}', '{{$event->placa}}')" />
                                            @endif
                                        </td>
                                         <td>
                                            @if(!empty($event->id_subcircuito))
                                              <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                           data-toggle="modal" data-target="#modalEliDis" onclick="cargardataEliAsig('{{$event->id_asig}}', '{{$event->placa}}')" />
                                            <x-adminlte-button label="Actualizar" theme="primary" data-toggle="modal" data-target="#modalActAsig" onclick="cargardata_act('{{$event->id_asig}}', '{{$event->placa}}', '{{$event->id_subcircuito}}')" />
                                            @else
                                              {{"VEHICULO SIN REGISTRO DE ASIGNACION"}}                                            @endif

                                        </td>
                                </tr>
                            @endforeach
                    </x-adminlte-datatable>
                     <x-adminlte-modal id="modalActAsig" title="Actualizar Asignacion">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPersoU" label="Personal:" placeholder="" fgroup-class="col-md-12"/>
                            </div>
                             <x-adminlte-select id="selSubcircuitoU" name="selSubcircuitoU" label="Subcircuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script >
                                          $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-subcircuito-asig',
                                                    success: function (data) {
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuitoU').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                 });
                                    </script>

                            </x-adminlte-select>
                            <x-slot name="footerSlot">
                            <div name="act_asi" id="act_asi">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>


                     <x-adminlte-modal id="modalAgreSub" title="Agregar Subcircuito">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Personal:" placeholder="" fgroup-class="col-md-12"/>
                            </div>
                             <x-adminlte-select id="selSubcircuito" name="selSubcircuito" label="Subcircuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script>
                                        $(document).ready(function () {
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-subcircuito-asig',
                                                    success: function (data) {
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });

                                        });
                                    </script>
                                </x-adminlte-select>
                            <x-slot name="footerSlot">
                            <div name="agregaras" id="agregaras">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>
                    <x-adminlte-modal id="modalEliDis" title="Eliminar Asignacion">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Placa:" placeholder="" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>

                    <script>
                          function cargardata_act(id_asigna, nombre, id_sub) {
                            $('#modalActAsig [name=iPersoU]').val(nombre);
                            $('#modalActAsig #selSubcircuitoU').val(id_sub);
                            $("#act_asi").html('<a href="javascript:actualizarAsignacion('+id_asigna+');" class="btn btn-success" >Actulizar</a>')

                        }
                        function actualizarAsignacion(id_asigna) {
                                var nuevoselSubcircuitoU= $('select[name="selSubcircuitoU"]').val();

                                // Realizar la solicitud AJAX
                                $.ajax({
                                    url: 'actualizar-asignacion_vehi' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'id':id_asigna,
                                    'id_subcircuito':nuevoselSubcircuitoU,


                                    _token: $('meta[name="csrf-token"]').attr('content') },
                                    success: function(response) {

                                             $('#modalActAsig').modal('hide');
                                            location.reload();
                                        // Realizar acciones adicionales después de la actualización si es necesario
                                    },
                                    error: function(error) {
                                        console.error('Error al actualizar el circuito', error);
                                    }
                                });
                         }
                       function eliminar_Asinacion_vehiculo(id){
                             $.ajax({
                                    url: 'eliminar-asignacion-vehi/' + id,
                                    type: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {

                                           $('#modalEliCir').modal('hide');
                                           location.reload();

                                    },
                                    error: function (error) {
                                        console.error('Error al eliminar el Personal', error);
                                    }
                        });

                        }


                        function cargardataEliAsig(id, nombre) {
                            $('#modalEliDis [name=iPerso]').val(nombre);
                            $("#eliminar_cir").html('<a href="javascript:eliminar_Asinacion_vehiculo('+id+');" class="btn btn-success" >Eliminar Asignacion</a>');
                        }


                          function cargardata(id_vehiculo, nombre) {
                            $('#modalAgreSub [name=iPerso]').val(nombre);
                            $("#agregaras").html('<a href="javascript:agregar_asig('+id_vehiculo+');" class="btn btn-success" >Agregar</a>');
                        }
                         function agregar_asig(id_vehiculo) {
                                var nuevosselSubcircuito= $('select[name="selSubcircuito"]').val();

                                // Realizar la solicitud AJAX
                                $.ajax({
                                    url: 'registrar_asig_vehiculo_subc' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'id_vehiculo':id_vehiculo,
                                    'id_subcircuito':nuevosselSubcircuito,
                                    _token: $('meta[name="csrf-token"]').attr('content') },
                                    success: function(response) {
                                        console.log(response);
                                             $('#modalActCir').modal('hide');
                                            location.reload();
                                        // Realizar acciones adicionales después de la actualización si es necesario
                                    },
                                    error: function(error) {
                                        console.error('Error al actualizar el circuito', error);
                                    }
                                });
                }




                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
