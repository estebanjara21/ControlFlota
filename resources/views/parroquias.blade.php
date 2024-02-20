@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Parroquias</h1>
@stop

@section('content')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<style type="text/css">
    .actions-column {
    width: 300px; /* Ajusta el ancho según tus necesidades */

    }
    .limited-width {
    max-width: 200px; /* Establece el ancho máximo deseado */
}
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                      <form  action="{{ route('registrarparroquia') }}"  method="post">
                        @csrf
                        <x-adminlte-modal id="modalCir" title="Registro de Parroquia">
                        <div class="row">
                            <x-adminlte-input name="iParroquia"  label="Parroquia" placeholder="Ingrese Parroquia" fgroup-class="col-md-12"/>
                        </div>
                        <div class="row">
                            <x-adminlte-select2 id="selDistrito" name="selDistrito" label="Distrito" fgroup-class="col-md-12" data-placeholder="Selecciona Parroquia...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <option>SELECCIONAR DISTRITO</option>
                                    <script>
                                        $(document).ready(function () {

                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-distrito',

                                                    success: function (data) {


                                                        $.each(data, function (id, descripcion) {
                                                            $('#selDistrito').append($('<option>', {
                                                                value: id,
                                                                text: Descripcion
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
                            @foreach($parroquias as $parroquia)
                                <tr>
                                        <td>{{$parroquia->id}}</td>
                                        <td>{{$parroquia->descripcion}}</td>
                                        <td>{{$parroquia->des_cir}}</td>

                                         <td class="actions-column">
                                            <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                            data-id="{{ $parroquia->id }}" data-nombre="{{ $parroquia->descripcion }}" data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{ $parroquia->id }}', '{{ $parroquia->descripcion }}')" />

                                            <x-adminlte-button label="Actualizar" theme="info"
                                            data-id="{{ $parroquia->id }}" data-nombre="{{ $parroquia->descripcion }}" data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{ $parroquia->id }}', '{{ $parroquia->descripcion }}', '{{ $parroquia->id_dis }}')" />
                                        </td>


                                </tr>
                            @endforeach

                    </x-adminlte-datatable>


                    <!--MODAL PARA ELIMINAR CIRCUITO-->
                        <!--MODAL PARA ELIMINAR CIRCUITO-->

                    <x-adminlte-modal id="modalEliDis" title="Eliminar Parroquia">
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

                 <x-adminlte-modal id="modalActDis" title="Actualizar Parroquia">
                            @csrf
                         <div class="row">
                                <x-adminlte-input id="iDisUpdate" name="iDisUpdate" label="Circuito:" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>

                                 <x-adminlte-select2 id="selDisUpdate" name="selDisUpdate" label="Distrito" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
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
                     $("#eliminar_cir").html('<a href="javascript:eliminar_parr('+id+');" class="btn btn-success" >Eliminar</a>');
                    }

                     function cargardata_act(id, nombre, id_dis) {
                    $('#modalActDis [name=iDisUpdate]').val(nombre);

                      $('#selDisUpdate').empty();
                        $.ajax({
                            type: 'GET',
                            url: 'obtener-dis-act',
                            success: function (data) {
                             $.each(data, function (id, descripcion) {
                                $('#selDisUpdate').append($('<option>', {
                                    value: id,
                                    text: descripcion
                                }));
                            });

                            // Establece la opción seleccionada usando select2
                            $('#selDisUpdate').val(id_dis).trigger('change');
                            }
                            });


                     $("#cir_act").html('<a href="javascript:actualizarParr('+id+');" class="btn btn-success" >Actulizar</a>');
                    }


                    function eliminar_parr(id){
                             $.ajax({
                    url: 'eliminarparroquia/' + id,
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


function actualizarParr(id) {
        // Obtener el valor del circuito desde el input
        var nuevoParro = $('#iDisUpdate').val();
        var nuevoDist= $('select[name="selDisUpdate"]').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizarparro' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id':id,
            'parroquia': nuevoParro,

            'distrito': nuevoDist,
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
