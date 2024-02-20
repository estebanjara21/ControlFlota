@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Provinicias</h1>
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
                      <form action="{{ route('registrar_pro') }}" method="post">
                        @csrf
                        <x-adminlte-modal id="modalCir" title="Registro de Provincias">
                        <div class="row">
                            <x-adminlte-input name="iProv"  label="Provincia" placeholder="Ingrese Provincia" fgroup-class="col-md-12"/>
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

                                        <td>{{$provincia->descripcion}}</td>
                                        <td class="actions-column">
                                            <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                            data-id="{{ $provincia->id }}" data-nombre="{{ $provincia->descripcion }}" data-toggle="modal" data-target="#modalEliCir" onclick="cargardata('{{ $provincia->id }}', '{{ $provincia->descripcion }}')" />


                                            <x-adminlte-button label="Actualizar" theme="info"
                                            data-id="{{ $provincia->id }}" data-nombre="{{ $provincia->descripcion }}" data-toggle="modal" data-target="#modalActCir" onclick="cargardata_act('{{ $provincia->id }}', '{{ $provincia->descripcion }}')" />
                                        </td>
                                </tr>
                            @endforeach

                    </x-adminlte-datatable>

                    <!--MODAL PARA ELIMINAR CIRCUITO-->
                        <!--MODAL PARA ELIMINAR CIRCUITO-->

                    <x-adminlte-modal id="modalEliCir" title="Eliminar Circuitos">
                            @csrf

                            <div class="row">
                                <x-adminlte-input disabled name="iProv" label="Provincia:" placeholder="Ingrese Provincia" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">


                            </div>

                                <x-adminlte-button  label="NO" data-dismiss="modal"/>
                            </x-slot>

                    </x-adminlte-modal>

                 <x-adminlte-modal id="modalActCir" title="Actualizar Circuitos">
                            @csrf

                         <div class="row">
                                <x-adminlte-input id="proUpdate" name="iCircuito" label="Provincia:" placeholder="Ingrese Provincia" fgroup-class="col-md-12"/>
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
                    $('#modalEliCir [name=iProv]').val(nombre);
                     $("#eliminar_cir").html('<a href="javascript:eliminar_prov('+id+');" class="btn btn-success" >Eliminar</a>');
                    }

                    function cargardata_act(id, nombre,cod_circ) {
                    $('#modalActCir [name=iCodCircuitoUpdate]').val(cod_circ);
                    $('#modalActCir [name=iCircuito]').val(nombre);
                     $("#cir_act").html('<a href="javascript:actualizarCircuito('+id+');" class="btn btn-success" >Actulizar</a>');
                    }

                    function eliminar_prov(id){
                             $.ajax({
                    url: 'eliminarpro/' + id,
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


 function actualizarCircuito(id) {
        // Obtener el valor del circuito desde el input
        var nuevoPro = $('#proUpdate').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizarpro' , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'POST', // O el método HTTP que estés utilizando para la actualización
           data: {
            'id':id,
            'provincia': nuevoPro,
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
