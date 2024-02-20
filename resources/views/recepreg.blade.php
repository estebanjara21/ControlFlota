@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Recepcion y Registro de Solicitud</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($events as $event)
                                <tr style="background-color: 
                                            @if($event->estado == 1)
                                                {{ "" }}
                                            @elseif($event->estado == 2)
                                                {{ "#D4F1DC" }}
                                            @elseif($event->estado == 3)
                                                {{ "#FADBD8" }}
                                            @else
                                                {{ "" }} 
                                            @endif
                                ">    
                                        <td>{{$event->identificacion}}</td>
                                        <td>{{$event->nom_ape}}</td>
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
                                        <td> @if($event->estado == 1)
                                                <x-adminlte-button label="Evaluar" theme="info" icon="fas fa-info-circle"
                                             data-toggle="modal" data-target="#modalEva" onclick="cargardata('{{ $event->id }}','{{ $event->placa }}')" />
                                             @elseif($event->estado_man ==1)
                                                   {{ "MANTENIMIENTO EN PROCESO" }}
                                              @elseif($event->estado_man ==3)
                                                   {{ "MANTENIMIENTO TERMINADO" }}
                                             @elseif($event->estado == 2)
                                              <x-adminlte-button label="Registro Datos" theme="success" icon="fas fa-success"
                                             data-toggle="modal" data-target="#modalRegDato" onclick="cargarinformacion('{{ $event->tipo_vehiculo }}','{{ $event->placa }}','{{ $event->marca }}','{{ $event->modelo }}','{{ $event->identificacion }}','{{ $event->nom_ape }}','{{ $event->id_soli }}')" />   
                                             @elseif($event->estado == 3)
                                                {{ "Solicitud Denegada" }}
                                             
                                             @else {{"VACIO"}}
                                            @endif
                                        </td>
                                   
                                      
                                </tr>
                            @endforeach
                    </x-adminlte-datatable>

                       <x-adminlte-modal id="modalRegDato" title="Registro Mantenimiento">
                          <form action="{{ route('guardar_mantenimiento') }}" method="post" enctype="multipart/form-data">
                            @csrf    
                            <div class="row">
                                <x-adminlte-input name="iSoli" label="Tipo Vehiculo" placeholder="Tipo" label-class="text-lightblack"  fgroup-class="col-md-6 d-none">
                                    </x-adminlte-input>
                                     <x-adminlte-input name="iTipo_vehiculo" label="Tipo Vehiculo" placeholder="Tipo" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                    </x-adminlte-input>

                                    <x-adminlte-input name="iPlaca" label="Placa" placeholder="Placa" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card text-lightblack"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                     <x-adminlte-input name="iMarca" label="Marca" placeholder="" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="iModelo" label="Modelo" placeholder="Modelo" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                    </x-adminlte-input>
                                     <x-adminlte-input name="iIdentificacion" label="Identificacion" placeholder="Motor" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                    </x-adminlte-input>
                                     <x-adminlte-input name="iNom_ape" label="Nombre Apellido" placeholder="Kilometraje" label-class="text-lightblack"  fgroup-class="col-md-6" disabled>
                                    </x-adminlte-input>
                                    <br>
                                    <label class="col-md-12" >Fecha - Hora Ingreso</label>
                                    <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control col-md-12" placeholder="Ingrese " >
                                     <x-adminlte-input name="Kilometraje" label="Kilometraje" placeholder="Ingrese Kilometraje" label-class="text-lightblack"  fgroup-class="col-md-12" >
                                    </x-adminlte-input>
                                    <x-adminlte-input name="iAsunto" label="Asunto" placeholder="Ingrese Asunto" label-class="text-lightblack"  fgroup-class="col-md-12" >
                                    </x-adminlte-input>
                                 <x-adminlte-input name="iDetalle" label="Detalle" placeholder="Ingrese Detalle" label-class="text-lightblack"  fgroup-class="col-md-12" >
                                    </x-adminlte-input>
                                      <x-adminlte-select name="tipo_mante" label="Tipo de Mantenimiento " fgroup-class="col-md-12">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                      <i class="fas fa-car text-lightblack"></i>
                                    </div>
                                </x-slot>
                                <option>SELECCIONE TIPO MANTENIMIENTO</option>
                                <option value="1">Mantenimiento 1</option>
                                <option value="2">Mantenimiento 2</option>
                                <option value="3">Mantenimiento 3</option>
                                </x-adminlte-select>

                                    <label >Seleccione Foto</label>
                                   <input type="file" name="imagen" id="imagen" accept="image/*" class="form-control col-md-12" >
                                   <br><br>
                                   <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"/>




                            </div>
                        </form>
                          
                        
                    </x-adminlte-modal>




                    <x-adminlte-modal id="modalEva" title="Evaluacion de Solicitud">
                            @csrf        
                            <div class="row">
                                <x-adminlte-input disabled name="iDis" label="" placeholder="" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="datos_eva" id="datos_eva">
                            </div>                                                    
                                
                            </x-slot>
                        
                    </x-adminlte-modal>

                     <script>
                    function cargarinformacion(tipo_vehiculo, placa, marca, modelo,identificacion ,nom_ape,id_soli) {
                        if (tipo_vehiculo==1){
                            var tipo="Auto";
                        }else if(tipo_vehiculo==2)
                        {
                         var tipo="Motocicleta";
                        }
                        else{
                            var tipo="Camioneta";
                        }
                        $('#modalRegDato [name=iTipo_vehiculo]').val(tipo);
                        $('#modalRegDato [name=iPlaca]').val(placa);
                        $('#modalRegDato [name=iMarca]').val(marca);
                        $('#modalRegDato [name=iModelo]').val(modelo);
                         $('#modalRegDato [name=iIdentificacion]').val(identificacion); 
                         $('#modalRegDato [name=iNom_ape]').val(nom_ape);
                          $('#modalRegDato [name=iSoli]').val(id_soli);
                       
                    }


                    function cargardata(id, placa) {
                        $('#modalEva [name=iDis]').val(placa);
                        $("#datos_eva").html('<a href="javascript:actualizar_estad_soli('+id+',2);" class="btn btn-success" >Aceptar</a> <a href="javascript:actualizar_estad_soli('+id+',3);" class="btn btn-danger" >Denegar</a>');
                    }
                    function actualizar_estad_soli(id, estado) {
                            // Realizar la solicitud AJAX
                            $.ajax({
                                url: 'actualizar_estado_solicitud' , // Reemplaza con la ruta adecuada en tu aplicación
                                type: 'POST', // O el método HTTP que estés utilizando para la actualización
                               data: { 
                                'id':id,
                                'estado': estado,
                           
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
