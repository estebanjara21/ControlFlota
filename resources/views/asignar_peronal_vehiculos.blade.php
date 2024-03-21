@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Lista de Personal (Asignacion de Vehiculos)</h1>
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
                                        <td>{{$event->identificacion}}</td>
                                        <td>{{$event->nom_ape}}</td>

                                        <td>@if(!empty($event->id_personal_vehi))
                                                <b>Tipo Vehiculo</b>
                                            @if($event->tipo_vehiculo == 1)
                                                {{ "Auto" }}
                                             @elseif($event->tipo_vehiculo == 2)
                                                {{ "Motocicleta" }}
                                             @elseif($event->tipo_vehiculo == 3)
                                                {{ "Camioneta" }}

                                             @else {{"VACIO"}}
                                            @endif
zzzz
                                                <br>
                                                <b>Placa: </b>{{$event->placa}}<br>
                                            @elseif(empty($event->id_subcircuito))
                                                <b>Al personal no se le ha agregado un subcircuito</b>
                                            @else
                                                <x-adminlte-button label="Agregar" theme="success" icon="fas fa-thumbs-up" data-toggle="modal" data-target="#modalAgreSub" onclick="cargardata('{{$event->id}}', '{{$event->nom_ape}}', '{{$event->id_subcircuito}}')" />
                                            @endif

                                        </td>
                                        <td>@if(!empty($event->id_personal_vehi))
                                                     <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                           data-toggle="modal" data-target="#modalEliDis" onclick="cargardataEliAsig('{{$event->id_personal_vehi}}', '{{$event->nom_ape}}')" />

                                            @endif

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




                    <x-adminlte-modal id="modalEliDis" title="Eliminar Asignacion">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Personal:" placeholder="Ingrese Distrito" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalAgreSub" title="Asignar Vehiculo">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Personal:" placeholder="" fgroup-class="col-md-12"/>
                            </div>
                             <x-adminlte-select id="selSubcircuito" name="selSubcircuito" label="Vehiculo" fgroup-class="col-md-12" data-placeholder="Selecciona Vehiculos...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>

                                </x-adminlte-select>
                            <x-slot name="footerSlot">
                            <div name="agregaras" id="agregaras">
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
                                    url: 'actualizar-asignacion' , // Reemplaza con la ruta adecuada en tu aplicación
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










                        function eliminar_Asinacion(id){
                             $.ajax({
                                    url: 'eliminar-asignacion-vehiculos/' + id,
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
                            $("#eliminar_cir").html('<a href="javascript:eliminar_Asinacion('+id+');" class="btn btn-success" >Eliminar Asignacion</a>');
                        }

                        function cargardata(id_personal, nombre, id_sub_circuito) {
                            $('#modalAgreSub [name=iPerso]').val(nombre);
                                    $('#selSubcircuito').empty();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-subcircuito-x-per-vehi',
                                                    data: { id_sub_circuito: id_sub_circuito },
                                                    success: function (data) {

                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });




                            $("#agregaras").html('<a href="javascript:agregar_asig('+id_personal+');" class="btn btn-success" >Agregar</a>');
                        }
                       function agregar_asig(id_personal) {
                                var nuevosselSubcircuito= $('select[name="selSubcircuito"]').val();

                                // Realizar la solicitud AJAX
                                $.ajax({
                                    url: 'registrar_asig_vehiculo_per' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'id_personal':id_personal,
                                    'id_vehiculo':nuevosselSubcircuito,
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
