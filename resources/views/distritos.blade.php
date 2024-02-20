@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Distrito</h1>
@stop

@section('content')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<style type="text/css">
    .actions-column {
    width: 300px; /* Ajusta el ancho según tus necesidades */
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                      <form action="{{ route('registrardist') }}" method="post">
                        @csrf
                        <x-adminlte-modal id="modalCir" title="Registro de Distrito">
                        <div class="row">
                            <x-adminlte-input name="iCodDistrito"  label="Codigo Distrito" placeholder="Ingrese Codigo Distrito" fgroup-class="col-md-12"/>
                        </div>
                        <div class="row">
                            <x-adminlte-input name="iDistrito"  label="Distrito" placeholder="Ingrese Distrito" fgroup-class="col-md-12"/>
                        </div>
                        <div class="row">
                            <x-adminlte-select2 id="selPro" name="selPro" label="Provincia" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script>
                                        $(document).ready(function () {

                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-prov',

                                                    success: function (data) {


                                                        $.each(data, function (id, descripcion) {
                                                            $('#selPro').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });

                                        });
                                    </script>
                                </x-adminlte-select2>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="mr-auto" type="submit"  theme="success" label="Guardar"/>
                            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
                        </x-slot>

                        </x-adminlte-modal>
                        <x-adminlte-button  theme="success" icon="fas fa-plus-circle" label="Nuevo" data-toggle="modal" data-target="#modalCir"/>
                    </form>

                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($provincias as $provincia)
                                <tr>
                                        <td>{{$provincia->id}}</td>
                                        <td>{{$provincia->codigo_distrito}}</td>
                                        <td>{{$provincia->descripcion}}</td>
                                         <td>{{$provincia->des_cir}}</td>
                                        <td class="actions-column">
                                            <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                            data-id="{{ $provincia->id }}" data-nombre="{{ $provincia->descripcion }}" data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{ $provincia->id }}', '{{ $provincia->descripcion }}')" />


                                            <x-adminlte-button label="Actualizar" theme="info"
                                            data-id="{{ $provincia->id }}" data-nombre="{{ $provincia->descripcion }}" data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{ $provincia->id }}', '{{ $provincia->descripcion }}', '{{ $provincia->id_pro }}', '{{ $provincia->codigo_distrito }}')" />
                                        </td>
                                </tr>
                            @endforeach

                    </x-adminlte-datatable>
                    <!--MODAL PARA ELIMINAR CIRCUITO-->
                        <!--MODAL PARA ELIMINAR CIRCUITO-->

                    <x-adminlte-modal id="modalEliDis" title="Eliminar Distrito">
                            @csrf

                            <div class="row">
                                <x-adminlte-input disabled name="iDis" label="Distrito:" placeholder="Ingrese Distrito" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">


                            </div>

                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>

                    </x-adminlte-modal>

                 <x-adminlte-modal id="modalActDis" title="Actualizar Distrito">
                            @csrf
                         <div class="row">
                              <x-adminlte-input id="iCodDisUpdate" name="iCodDisUpdate" label="Cod Distrito" placeholder="Ingrese Codigo Distrito" fgroup-class="col-md-12"
                                    />
                                <x-adminlte-input id="iDisUpdate" name="iDisUpdate" label="Distrito:" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>

                                 <x-adminlte-select2 id="selDisUpdate" name="selDisUpdate" label="Provincia" fgroup-class="col-md-6" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>

                                </x-adminlte-select2>

                        </div>
                                        <x-slot name="footerSlot">

                                            <div name="cir_act" id="cir_act"></div>

                                         <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                                        </x-slot>
                 </x-adminlte-modal>

                    <!--FIN MODAL PARA ELIMINAR CIRCUITO-->

                    <!--FIN MODAL PARA ELIMINAR CIRCUITO-->
                    <script>
                    function cargardata(id, nombre) {
                    $('#modalEliDis [name=iDis]').val(nombre);
                     $("#eliminar_cir").html('<a href="javascript:eliminar_dis('+id+');" class="btn btn-success" >Eliminar</a>');
                    }

                     function cargardata_act(id, nombre, id_circuito,cod) {
                    $('#modalActDis [name=iDisUpdate]').val(nombre);
                      $('#modalActDis [name=iCodDisUpdate]').val(cod);

                      $('#selDisUpdate').empty();
                        $.ajax({
                            type: 'GET',
                            url: 'obtener-prov-act',
                            success: function (data) {
                             $.each(data, function (id, descripcion) {
                                $('#selDisUpdate').append($('<option>', {
                                    value: id,
                                    text: descripcion
                                }));
                            });

                            // Establece la opción seleccionada usando select2
                            $('#selDisUpdate').val(id_circuito).trigger('change');
                            }
                            });


                     $("#cir_act").html('<a href="javascript:actualizarDist('+id+');" class="btn btn-success" >Actulizar</a>');
                    }


                    function eliminar_dis(id){
                             $.ajax({
                    url: 'eliminar-distrito/' + id,
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


function actualizarDist(id) {
        // Obtener el valor del circuito desde el input
        var nuevosDistrito = $('#iDisUpdate').val();
         var nuevocodDistrito = $('#iCodDisUpdate').val();
        var nuevoProv= $('select[name="selDisUpdate"]').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizar-distrito' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id':id,
            'distrito': nuevosDistrito,
            'codigo_distrito': nuevocodDistrito,
            'provincia': nuevoProv,
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
    </div>
@stop
