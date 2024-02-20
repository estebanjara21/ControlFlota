@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de Mantenimiento Preventivo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="tabla">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="dark" with-buttons>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->identificacion}}</td>
                                <td>{{$event->nom_ape}}</td>
                                <td>
                                    @if($event->tipo_vehiculo == 1)
                                        {{ "Auto" }}
                                    @elseif($event->tipo_vehiculo == 2)
                                        {{ "Motocicleta" }}
                                    @elseif($event->tipo_vehiculo == 3)
                                        {{ "Camioneta" }}
                                    @else
                                        {{"VACIO"}}
                                    @endif
                                </td>
                                <td>{{$event->placa}}</td>
                                <td>
                                    @if($event->tipo_mantenimiento == 1)
                                        {{ "Mantenimiento 1" }}
                                    @elseif($event->tipo_mantenimiento == 2)
                                        {{ "Mantenimiento 2" }}
                                    @elseif($event->tipo_mantenimiento == 3)
                                        {{ "Mantenimiento 3" }}
                                    @else
                                        {{"VACIO"}}
                                    @endif
                                </td>
                                <td>@if($event->estado == 3) <b>Vehiculo Retirado por: @endif</b> {{$event->persona_retira}}</td>
                                <td><x-adminlte-button
                                        label="Descargar"
                                        theme="info"
                                        icon="fas fa-download"
                                        onclick="Descargar('{{ $event->id }}')"/>
                                    <x-adminlte-button
                                        label="Imprimir"
                                        theme="info"
                                        icon="fas fa-print"
                                        onclick="imprimir('{{ $event->id }}', '{{ $event->identificacion }}', '{{ $event->nom_ape }}', '{{ $event->tipo_vehiculo }}', '{{ $event->placa }}', '{{ $event->tipo_mantenimiento }}')"
                                    />
                                     @if($event->estado == 1)
                                    <x-adminlte-button label="Finalizar" theme="success" icon="fas fa-check" data-toggle="modal" data-target="#modalEliSub" onclick="cargardata('{{ $event->id }}')" />
                                    @endif

                                </td>
                               
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                    <x-adminlte-modal id="modalEliSub" title="Terminar Mantenimiento">
                        
                            @csrf
                            <div class="row">

                               <x-adminlte-input name="iPersona_r" label="Nombre de quien Retira el Vehiculo" placeholder="" label-class="text-lightblack"  fgroup-class="col-md-12" >
                              </x-adminlte-input>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="datos_eva" id="datos_eva">
                            </div>                              
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                        
                    </x-adminlte-modal>

                </div>
            </div>
        </div>
    </div>

    <script>
           function cargardata(id) {
                      
                       $("#datos_eva").html('<a href="javascript:actualizar_estad_soli('+id+');" class="btn btn-success" >Guardar</a>');
                    }

          function actualizar_estad_soli(id) {
                            // Realizar la solicitud AJAX
             var iPersona_r = $('#iPersona_r').val();
                            $.ajax({
                                url: 'actualizar_estado_mant' , // Reemplaza con la ruta adecuada en tu aplicación
                                type: 'POST', // O el método HTTP que estés utilizando para la actualización
                               data: { 
                                'id':id,
                                'iPersona_r': iPersona_r,
                           
                                _token: $('meta[name="csrf-token"]').attr('content') },
                                success: function(response) {
                                    console.log(response);
                                      if (response.success) {
                                                alert('Registro exitoso');
                                             
                                                 location.reload();
                                            }


                                                    window.location.href = 'descargar-pdf-det-mant?id=' + id
                                                   
                                                    setInterval(function() {
                                                                location.reload();
                                                    }, 2000);
                                },
                                error: function(error) {
                                    console.error('Error al actualizar el circuito', error);
                                }
                            });
                }








        function Descargar(id){

             window.location.href = 'descargar-pdf-mant?id='+id;
        }
        function imprimir(id, identificacion,nom_ape, tipo_vehiculo, placa,tipo_mantenimiento) {
            if (tipo_vehiculo==1){
                            var tipo="Auto";
                        }else if(tipo_vehiculo==2)
                        {
                         var tipo="Motocicleta";
                        }
                        else{
                            var tipo="Camioneta";
                        }

            if (tipo_mantenimiento==1){
                            var tipo_m="Mantenimiento 1";
                        }else if(tipo_mantenimiento==2)
                        {
                         var tipo_m="Mantenimiento 2";
                        }
                        else{
                            var tipo_m="Mantenimiento 3";
                        }

            // Crea un elemento div para contener la información que deseas imprimir
            var contenidoImprimir = document.createElement('div');

            // Agrega la información que deseas imprimir al div
            contenidoImprimir.innerHTML = '<h1>Datos</h1><br><p>Identificacion: '+identificacion+'</p><br><p>Nombre y Apellidos: '+nom_ape+'</p><br><p>Tipo Vehiculo: '+tipo+'</p><br><p>Placa: '+placa+'</p><br><p>Tipo Mantenimiento: '+tipo_m+'</p>';

            // Agrega el div al cuerpo del documento
            document.body.appendChild(contenidoImprimir);

            // Oculta la paginación y los detalles durante la impresión
            var estilo = document.createElement('style');
            estilo.innerHTML = '@media print { .no-imprimir { display: none; } .table-datatable-info { display: none; } .datatable-details { display: none; } }';
            document.head.appendChild(estilo);

            // Oculta la tabla durante la impresión
            document.getElementById('tabla').classList.add('no-imprimir');

            // Abre la ventana de impresión
            window.print();

            // Elimina el div y los estilos después de la impresión
            document.body.removeChild(contenidoImprimir);
            document.head.removeChild(estilo);

            // Muestra la tabla después de la impresión
            document.getElementById('tabla').classList.remove('no-imprimir');
        }
    </script>
@stop
