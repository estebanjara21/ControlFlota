@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Registro Solicitud Mantenimiento Preventivo</h1>
@stop

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <div class="row">
                            <x-adminlte-input name="iSearch" label="Buscar" placeholder="Buscar" igroup-size="lg" fgroup-class="col-md-12">
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button theme="outline-danger" label="Go!" onclick="cargadata()"/>
                                        </x-slot>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text text-danger">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </x-slot>
                            </x-adminlte-input>

                    </div>
                    <div class="row" name="contenedor" id="contenedor">

                    </div>



                </div>
            </div>
        </div>
    </div>

    <script >
        function cargadata(){
                var dato= $('input[name="iSearch"]').val();
                if (dato==""){
                            Swal.fire("Ingrese Dato a Buscar");
                }else{

                     $.ajax({
                                    url: 'buscardato_personal_vehiculo' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'get', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'dato':dato,
                                    _token: $('meta[name="csrf-token"]').attr('content') },
                                    success: function(response) {
                                        if(response ==""){
                                            Swal.fire("No se han encontrado datos en el sistema");
                                        }else{
                                            var tipo_vehiculo="";
                                           if(response[0].tipo_vehiculo==1){
                                                    tipo_vehiculo="Auto";
                                           }else if(response[0].tipo_vehiculo==2){
                                                    tipo_vehiculo="Motocicleta";
                                           }
                                           else{
                                                 tipo_vehiculo="Camioneta";
                                           }

                                        var inputHtml = '<div class="form-group col-md-12">' +
                                                            '<label for="iDistrito">Tipo Vehiculo</label>' +
                                                            '<input type="text" name="itipo_vehiculo" id="itipo_vehiculo" class="form-control" placeholder="Ingrese " value="' + tipo_vehiculo + '" disabled>' +
                                                            '<input type="text" name="id_personal" id="id_personal" class="form-control d-none" placeholder="Ingrese " value="' + response[0].id + '" >' +
                                                            '<input type="text" nam=e="nom_ape" id"nom_ape" class="form-control  d-none" placeholder="Ingrese " value="' + response[0].nom_ape + '" >' +
                                                            '<input type="text" name="id_vehiculo" id="id_vehiculo" class="form-control d-none" placeholder="Ingrese " value="' + response[0].id_vehiculo + '" >' +
                                                        '</div>' +  // Añadí este punto y coma para separar las dos divisiones (div)
                                                        '<div class="form-group col-md-6">' +
                                                            '<label for="iDistrito">Placa</label>' +
                                                            '<input type="text" name="placa" id="placa" class="form-control" placeholder="Ingrese " value="' + response[0].placa + '" disabled>' +
                                                        '</div>'+
                                                        '<div class="form-group col-md-6">' +
                                                            '<label for="iDistrito">Chasis</label>' +
                                                            '<input type="text" name="chasis" id="chasis" class="form-control" placeholder="Ingrese " value="' + response[0].chasis + '" disabled>' +
                                                        '</div>'+

                                                        '<div class="form-group col-md-6">' +
                                                            '<label for="iDistrito">Fecha - Hora</label>' +
                                                            '<input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" placeholder="Ingrese " >' +
                                                        '</div>'+
                                                        '<div class="form-group col-md-6">' +
                                                            '<label for="iDistrito">Kilometraje</label>' +
                                                            '<input type="number" name="Kilometraje" id="Kilometraje" class="form-control" placeholder="Ingrese " >' +
                                                        '</div>'
                                                        +
                                                          '<div class="form-group col-md-12">' +
                                                            '<label for="iDistrito">Observaciones</label><br>' +
                                                            '<textarea name="obs" id="obs" rows="12" cols="70"></textarea>' +
                                                        '</div>' +
                                                        '<div class="form-group col-md-6 text-center mt-3">' +
                                                            '<input type="button" onclick="guardar_data()" class="form-control btn btn-success" value="Guardar y exportar" icon="fas fa-save" class="w-100"/>' +
                                                        '</div>';

                                                        ;


                                        document.getElementById('contenedor').innerHTML = inputHtml;
                                        }

                                            //console.log(response);
                                             $('#modalActCir').modal('hide');
                                           // location.reload();
                                        // Realizar acciones adicionales después de la actualización si es necesario
                                    },
                                    error: function(error) {
                                        console.error('Error al actualizar el circuito', error);
                                    }
                     });


                }


        }

        function guardar_data(){
              // Obtener el valor del circuito desde el input
        var id_personal = $('#id_personal').val();
         var id_vehiculo = $('#id_vehiculo').val();
        var fecha_hora=  $('#fecha_hora').val();
        var Kilometraje=  $('#Kilometraje').val();
        var obs=  $('#obs').val();
        var placa= $('#placa').val();
        var chasis= $('#chasis').val();
              var nom_ape= $('#nom_ape').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'registrar_solicitud' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id_personal':id_personal,
            'id_vehiculo': id_vehiculo,
            'fecha_hora': fecha_hora,
            'Kilometraje': Kilometraje,
            'obs': obs,
             'nom_ape': nom_ape,
            _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                console.log(response);
                    if (response.success) {
            alert('Registro exitoso: ' + response.message);

             location.reload();
        }


                window.location.href = 'descargar-pdf?placa=' + placa +

                          '&fecha_hora=' + fecha_hora +
                          '&Kilometraje=' + Kilometraje +
                          '&obs=' + obs+
                          '&nom_ape=' + nom_ape;
                  //   $('#modalActCir').modal('hide');

                setInterval(function() {
                            location.reload();
                }, 3000);
                // Realizar acciones adicionales después de la actualización si es necesario
            },
            error: function(error) {
                console.error('Error al actualizar el circuito', error);
            }
        });


        }
    </script>
@stop
