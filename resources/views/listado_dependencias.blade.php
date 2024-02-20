@extends('adminlte::page')

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content_header')
    <h1 class="m-0 text-dark">Dependencias</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($depend as $depen)
                                <tr>
                                        <td>{{$depen->provincia}}</td>
                                        <td>{{$depen->parroquia}}</td>
                                        <td>{{$depen->codigo_distrito}}</td>
                                        <td>{{$depen->distrito}}</td>
                                         <td>{{$depen->codigo_circuito}}</td>
                                        <td>{{$depen->circuito}}</td>
                                        <td>{{$depen->codigo_subcircuito}}</td>
                                        <td>{{$depen->subcircuitos}}</td>
                                        <td>
                                               <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                           data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{$depen->id_depe}}')" />

                                          <x-adminlte-button label="Actualizar" theme="info"
                                             data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{$depen->id_depe}}')" />
                                        </td>

                                </tr>
                            @endforeach

                    </x-adminlte-datatable>


                    <x-adminlte-modal id="modalEliDis" title="Eliminar Dependencia">
                            @csrf
                            <div class="row">
                             <label for="">Esta seguro que desea eliminar Dependencia?</label>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalActDis" title="Actualizar Distrito">
                       <div class="row">

                     <x-adminlte-select name="selPro" id="selPro" label="Provincia" fgroup-class="col-md-12" data-placeholder="Selecciona Provincia...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </x-slot>

                    </x-adminlte-select>
                </div>
                         <div class="row">
                            <x-adminlte-select id="selDistrito" name="selDistrito" label="Distrito" fgroup-class="col-md-12" data-placeholder="Selecciona Distrito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>

                            </x-adminlte-select>
                            </div>
                            <div class="row">
                            <x-adminlte-select id="selParroquia" name="selParroquia" label="Parroquia" fgroup-class="col-md-12" data-placeholder="Selecciona Parroquia...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>


                            </x-adminlte-select>
                            </div>
                              <div class="row">
                            <x-adminlte-select id="selCircuito" name="selCircuito" label="Circuito" fgroup-class="col-md-12" data-placeholder="Selecciona Circuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>

                                </x-adminlte-select>


                        </div>
                         <div class="row">
                            <x-adminlte-select id="selSubcircuito" name="selSubcircuito" label="Subcircuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select>


                        </div>






                <x-slot name="footerSlot">

                                            <div name="cir_act" id="cir_act"></div>

                                         <x-adminlte-button theme="danger" label="NOsss" data-dismiss="modal"/>
                                        </x-slot>
                 </x-adminlte-modal>
                </div>
            </div>
        </div>
    </div>
    <script type="">
        function cargardata_act(id){
              $.ajax({
                                type: 'GET',
                                url: 'obtener-provinncia',
                                success: function (data) {
                                    $('#selPro').append('<option value="">SELECCIONA PROVINCIA</option>'); // Opción predeterminada
                                    $.each(data, function (id, descripcion) {
                                        $('#selPro').append($('<option>', {
                                            value: id,
                                            text: descripcion
                                        }));
                                    });
                                }
            });

            $('#selPro').change(function () {
                var idPro = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: 'obtener-distrito-x-pro',
                    data: { idPro: idPro },
                    success: function (data) {
                        $('#selDistrito').empty();
                        // Verificar si ya hay opciones agregadas
                        if ($('#selDistrito').children().length === 0) {
                            // Agregar la opción adicional solo si no hay opciones
                            $('#selDistrito').append('<option>SELECCIONE DISTRITO</option>');
                        }
                        $.each(data, function (id, descripcion) {
                            $('#selDistrito').append($('<option>', {
                                value: id,
                                text: descripcion
                            }));
                        });
                    }
                });
            });

                $('#selDistrito').change(function () {
                                                var idDis = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-parro-x-dis',
                                                    data: { idDis: idDis },
                                                    success: function (data) {
                                                          $('#selParroquia').empty();
            // Verificar si ya hay opciones agregadas
                                        if ($('#selParroquia').children().length === 0) {
                // Agregar la opción adicional solo si no hay opciones
                                            $('#selParroquia').append('<option>SELECCIONE PARROQUIA</option>');
                                                }
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selParroquia').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });

                $('#selDistrito').change(function () {
                                                console.log("VAMOS BIEN")
                                                var idDis = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-cir-x-dis',
                                                    data: { idDis: idDis },
                                                    success: function (data) {
                                                        $('#selCircuito').empty();
                                                    if ($('#selCircuito').children().length === 0) {
                                                        $('#selCircuito').append('<option>SELECCIONE CIRCUITO </option>');
                                                    }
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selCircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                });
                 $('#selCircuito').change(function () {
                                                console.log("VAMOS BIEN")
                                                var idCir = $(this).val();
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-sub-x-cir',
                                                    data: { idCir: idCir },
                                                    success: function (data) {
                                                        $('#selSubcircuito').empty();
                                                         if ($('#selSubcircuito').children().length === 0) {
                                                        $('#selSubcircuito').append('<option>SELECCIONE CIRCUITO </option>');
                                                        }
                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });

                $("#cir_act").html('<a href="javascript:actualizarDependencia('+id+');" class="btn btn-success" >Actulizar</a>');

        }

        function actualizarDependencia(id) {

        var selPro= $('select[name="selPro"]').val();
        var selDistrito= $('select[name="selDistrito"]').val();
        var selParroquia= $('select[name="selParroquia"]').val();
        var selCircuito= $('select[name="selCircuito"]').val();
        var selSubcircuito= $('select[name="selSubcircuito"]').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizar-dependencia' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id':id,
            'selPro': selPro,
            'selDistrito': selDistrito,
            'selParroquia': selParroquia,
             'selCircuito': selCircuito,
            'selSubcircuito': selSubcircuito,
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





          function cargardata(id) {

                     $("#eliminar_cir").html('<a href="javascript:eliminar_dependencia('+id+');" class="btn btn-success" >Si</a>');
          }
          function eliminar_dependencia(id){
                             $.ajax({
                    url: 'eliminar-dependecia/' + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                           $('#modalEliCir').modal('hide');
                           location.reload();

                    },
                    error: function (error) {
                        console.error('Error al eliminar el circuito', error);
                    }
                        });

                    }


    </script>
@stop
