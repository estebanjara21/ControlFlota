@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Circuitos</h1>
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
                      <form action="{{ route('registrar_circuito') }}" method="post">
                        @csrf
                        <x-adminlte-modal id="modalCir" title="Registro de Circuitos">
                        <div class="row">
                            <x-adminlte-input name="iCircuito"  label="Circuito" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>
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
                            @foreach($circuitos as $circuito)
                                <tr>    
                                        <td>{{$circuito->id}}</td>
                                        <td>{{$circuito->descripcion}}</td>
                                        <td class="actions-column">
                                            <x-adminlte-button class="btn-lg" type="reset" label="Reset" theme="outline-danger" icon="fas fa-lg fa-trash"
                                            data-id="{{ $circuito->id }}" data-nombre="{{ $circuito->descripcion }}" data-toggle="modal" data-target="#modalEliCir" onclick="cargardata('{{ $circuito->id }}', '{{ $circuito->descripcion }}')" />
                                            

                                            <x-adminlte-button label="UPDATE" theme="info" icon="fas fa-info-circle"
                                            data-id="{{ $circuito->id }}" data-nombre="{{ $circuito->descripcion }}" data-toggle="modal" data-target="#modalActCir" onclick="cargardata_act('{{ $circuito->id }}', '{{ $circuito->descripcion }}')" />
                                        </td>
                                </tr>
                            @endforeach
                            
                    </x-adminlte-datatable>
                    <!--MODAL PARA ELIMINAR CIRCUITO-->
                        <!--MODAL PARA ELIMINAR CIRCUITO-->
                    
                    <x-adminlte-modal id="modalEliCir" title="Eliminar Circuitos">
                        
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iCircuito" label="Circuito:" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                                

                            </div>
                                                            
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                        
                    </x-adminlte-modal>

                 <x-adminlte-modal id="modalActCir" title="Actualizar Circuitos">
                            @csrf
                         <div class="row">
                                <x-adminlte-input id="iCircuitoUpdate" name="iCircuito" label="Circuito:" placeholder="Ingrese Circuito" fgroup-class="col-md-12"/>
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
                    $('#modalEliCir [name=iCircuito]').val(nombre);
                     $("#eliminar_cir").html('<a href="javascript:eliminar_circuito('+id+');" class="btn btn-success" >Eliminar</a>');
                    }

                    function cargardata_act(id, nombre) {
                    $('#modalActCir [name=iCircuito]').val(nombre);
                     $("#cir_act").html('<a href="javascript:actualizarCircuito('+id+');" class="btn btn-success" >Actulizar</a>');
                    }

                    function eliminar_circuito(id){
                             $.ajax({
                    url: 'eliminar-circuito/' + id,
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
        var nuevoCircuito = $('#iCircuitoUpdate').val();

        // Realizar la solicitud AJAX
        $.ajax({
            url: 'actualizar-circuito/' +id+'/'+nuevoCircuito , // Reemplaza con la ruta adecuada en tu aplicación
            type: 'GET', // O el método HTTP que estés utilizando para la actualización
           data: { 'circuito': nuevoCircuito },
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
