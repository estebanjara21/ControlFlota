@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Listado de Vehiculos</h1>
@stop

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
                                        <td>{{$event->chasis}}</td>
                                        <td>{{$event->marca}}</td>
                                        <td>{{$event->modelo}}</td>
                                        <td>{{$event->motor}}</td>
                                        <td>{{$event->kilometraje}}</td>
                                        <td>{{$event->cilindraje}}</td>
                                        <td>{{$event->capcarga}}</td>
                                        <td>{{$event->cappasejeros}}</td>
                                        <td>
                                             <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                           data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{$event->id}}', '{{$event->placa}}')" />
                                             <x-adminlte-button label="Actualizar" theme="info"
                                             data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{ $event->id }}', '{{ $event->tipo_vehiculo }}', '{{ $event->placa }}', '{{ $event->chasis }}', '{{ $event->marca }}', '{{ $event->modelo }}', '{{ $event->motor }}', '{{ $event->kilometraje }}', '{{ $event->cilindraje }}', '{{ $event->capcarga }}', '{{ $event->cappasejeros }}')" />

                                        </td>
                                </tr>
                            @endforeach
                    </x-adminlte-datatable>
                      <x-adminlte-modal id="modalEliDis" title="Eliminar Vehiculo">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Placa:" placeholder="Ingrese Placa" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>
                     <!--MODAL EDITAR-->
                    <x-adminlte-modal id="modalActDis" title="Actualizar Personal">
                        <div class="card-body">
                            <div class="row">

                        <x-adminlte-select name="selTipoVU" label="Tipo de vehículo " fgroup-class="col-md-6">
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
                         <x-adminlte-input name="iPlacaU" label="Placa" placeholder="Placa" label-class="text-lightblack"  fgroup-class="col-md-6">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-lightblack"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="iChasisU" label="Chasis" placeholder="Chasis" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iMarcaU" label="Marca" placeholder="Marca" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                        <x-adminlte-input name="iModeloU" label="Modelo" placeholder="Modelo" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iMotorU" label="Motor" placeholder="Motor" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iKilometrajeU" label="Kilometraje" placeholder="Kilometraje" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                         <x-adminlte-input name="iCilindrajeU" label="Cilindraje" placeholder="Cilindraje" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                            <x-adminlte-input name="iCapacidadCU" label="Capacidad de Carga" placeholder="Capacidad de Carga" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>
                    <x-adminlte-input type="number" name="iCapacidadPU" label="Capacidad de Pasajeros" placeholder="Capacidad de Pasajeros" label-class="text-lightblack"  fgroup-class="col-md-6">
                        </x-adminlte-input>

                            </div>
                            <x-slot name="footerSlot">

                                            <div name="cir_act" id="cir_act"></div>

                                         <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                                        </x-slot>

                        </div>
                    </x-adminlte-modal>






                    <script>
                        function actualizarVehiculo(id) {
                                var selTipoVU = $('select[name="selTipoVU"]').val();
                                var iPlacaU = $('#iPlacaU').val();
                                var iChasisU = $('#iChasisU').val();
                                var iMarcaU = $('#iMarcaU').val();
                                var iModeloU = $('#iModeloU').val();
                                var iMotorU = $('#iMotorU').val();
                                var iKilometrajeU = $('#iKilometrajeU').val();
                                var iCilindrajeU = $('#iCilindrajeU').val();
                                var iCapacidadCU = $('#iCapacidadCU').val();
                                var iCapacidadPU = $('#iCapacidadPU').val();


                                // Realizar la solicitud AJAX
                                $.ajax({
                                    url: 'actualizar-vehiculo' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'id':id,
                                    'tipo_vehiculo':selTipoVU,
                                    'placa':iPlacaU,
                                    'chasis' :iChasisU,
                                    'marca':iMarcaU,
                                    'modelo' :iModeloU,
                                    'motor' :iMotorU,
                                    'kilometraje':iKilometrajeU,
                                    'cilindraje':iCilindrajeU,
                                    'capcarga':iCapacidadCU,
                                    'cappasejeros':iCapacidadPU,


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







                         function cargardata_act(id, tipo_vehiculo, placa, chasis, marca, modelo, motor, kilometraje, cilindraje,capcarga,cappasejeros ) {
                            $('#modalActDis [name=selTipoVU]').val(tipo_vehiculo);
                            $('#modalActDis [name=iPlacaU]').val(placa);
                            $('#modalActDis [name=iChasisU]').val(chasis);
                            $('#modalActDis [name=iMarcaU]').val(marca);
                            $('#modalActDis [name=iModeloU]').val(modelo);
                            $('#modalActDis [name=iMotorU]').val(motor);
                            $('#modalActDis [name=iKilometrajeU]').val(kilometraje);
                            $('#modalActDis [name=iCilindrajeU]').val(cilindraje);
                            $('#modalActDis [name=iCapacidadCU]').val(capcarga);
                            $('#modalActDis [name=iCapacidadPU]').val(cappasejeros);
                           $("#cir_act").html('<a href="javascript:actualizarVehiculo('+id+');" class="btn btn-success" >Actulizar</a>')




                         }
                         function cargardata(id, nombre) {
                            $('#modalEliDis [name=iPerso]').val(nombre);
                            $("#eliminar_cir").html('<a href="javascript:eliminar_vehiculo('+id+');" class="btn btn-success" >Eliminar</a>');
                        }
                        function eliminar_vehiculo(id){
                             $.ajax({
                                    url: 'eliminarvehiculo/' + id,
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
                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
