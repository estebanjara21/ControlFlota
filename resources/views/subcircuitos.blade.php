@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Subircuitos</h1>
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
                     <form action="{{ route('registrar_subcircuito') }}" method="post">
                            @csrf
                            <x-adminlte-modal id="modalCir" title="Registro de Subircuitos">
                                <div class="row">
                                    <x-adminlte-input name="iCodSubcircuito" label="Cod Subcircuito" placeholder="Ingrese Codigo Subcircuito" fgroup-class="col-md-6"
                                    />
                                    <x-adminlte-input name="iSubcircuito" label="Subcircuito" placeholder="Ingrese Subcircuito" fgroup-class="col-md-6"
                                    />

                                    <x-adminlte-select2 id="selSubcircuito" name="selCircuito" label="Circuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script>
                                        $(document).ready(function () {

                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-circuitos',

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
                                </x-adminlte-select2>
                                </div>

                                <x-slot name="footerSlot">
                                    <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Guardar"/>
                                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
                                </x-slot>
                            </x-adminlte-modal>
                            <x-adminlte-button theme="success" icon="fas fa-plus-circle" label="Nuevo" data-toggle="modal" data-target="#modalCir"/>
                        </form>

                        <!--PROBAR-->


                <div class="card-body">

                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($subcircuitos as $subcircuitos)
                                <tr>
                                        <td>{{$subcircuitos->id}}</td>
                                        <td>{{$subcircuitos->codigo_subcircuito}}</td>
                                        <td>{{$subcircuitos->descripcion}}</td>
                                         <td>{{$subcircuitos->des_cir}}</td>
                                        <td class="actions-column">
                                            <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                            data-id="{{ $subcircuitos->id }}" data-nombre="{{ $subcircuitos->descripcion }}" data-toggle="modal" data-target="#modalEliSub" onclick="cargardata('{{ $subcircuitos->id }}', '{{ $subcircuitos->descripcion }}')" />


                                            <x-adminlte-button label="Actualizar" theme="info"
                                            data-id="{{ $subcircuitos->id }}" data-nombre="{{ $subcircuitos->descripcion }}" data-toggle="modal" data-target="#modalActSub" onclick="cargardata_act('{{ $subcircuitos->id }}', '{{ $subcircuitos->descripcion }}', '{{ $subcircuitos->id_circuito }}', '{{ $subcircuitos->codigo_subcircuito }}')" />
                                        </td>
                                </tr>
                            @endforeach

                    </x-adminlte-datatable>



                    <!--MODAL PARA ELIMINAR CIRCUITO-->
                        <!--MODAL PARA ELIMINAR CIRCUITO-->

                    <x-adminlte-modal id="modalEliSub" title="Eliminar Subcircuito">

                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iSubcircuito" label="Subcircuito:" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">


                            </div>

                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>

                    </x-adminlte-modal>



                    <!--FIN MODAL PARA ELIMINAR CIRCUITO-->
                <x-adminlte-modal id="modalActSub" title="Actualizar Subcircuitos">
                            @csrf
                         <div class="row">
                              <x-adminlte-input id="iCodSubcircuitoUpdate" name="iCodSubcircuitoUpdate" label="Cod Subcircuito" placeholder="Ingrese Codigo Subcircuito" fgroup-class="col-md-6"
                                    />
                                <x-adminlte-input id="iCircuitoUpdate" name="iCircuitoUpdate" label="Circuito:" placeholder="Ingrese Circuito" fgroup-class="col-md-6"/>

                                 <x-adminlte-select2 id="selSubcircuitoUpdate" name="selSubcircuitoUpdate" label="Circuito" fgroup-class="col-md-6" data-placeholder="Selecciona Subcircuito...">
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
                    <script>
                    function cargardata_act(id, nombre, id_circuito,cod) {
                    $('#modalActSub [name=iCircuitoUpdate]').val(nombre);
                      $('#modalActSub [name=iCodSubcircuitoUpdate]').val(cod);

                      $('#selSubcircuitoUpdate').empty();
                        $.ajax({
                            type: 'GET',
                            url: 'obtener-circuitos_act',
                            success: function (data) {
                             $.each(data, function (id, descripcion) {
                                $('#selSubcircuitoUpdate').append($('<option>', {
                                    value: id,
                                    text: descripcion
                                }));
                            });

                            // Establece la opción seleccionada usando select2
                            $('#selSubcircuitoUpdate').val(id_circuito).trigger('change');
                            }
                            });


                     $("#cir_act").html('<a href="javascript:actualizarCircuito('+id+');" class="btn btn-success" >Actulizar</a>');
                    }

                     function cargardata(id, nombre) {
                    $('#modalEliSub [name=iSubcircuito]').val(nombre);
                     $("#eliminar_cir").html('<a href="javascript:eliminar_subcircuito('+id+');" class="btn btn-success" >Eliminar</a>');
                    }

                    function eliminar_subcircuito(id){
                             $.ajax({
                    url: 'eliminar-subcircuito/' + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {

                           $('#modalEliSub').modal('hide');
                           location.reload();

                    },
                    error: function (error) {
                        console.error('Error al eliminar el subcircuito', error);
                    }
                        });

                    }


function actualizarCircuito(id) {
        // Obtener el valor del circuito desde el input
        var nuevosubCircuito = $('#iCircuitoUpdate').val();
         var nuevocodsubCircuito = $('#iCodSubcircuitoUpdate').val();
        var nuevoselSubcircuitoUpdate= $('select[name="selSubcircuitoUpdate"]').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizar-subcircuito' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id':id,
            'subcircuito': nuevosubCircuito,
            'cod_subcircuito': nuevocodsubCircuito,
            'circuito': nuevoselSubcircuitoUpdate,
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
