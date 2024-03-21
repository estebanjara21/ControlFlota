@extends('adminlte::page')

@section('content_header')
    <h1 class="m-0 text-dark">Listado de Rastrillos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped head-theme="dark" with-buttons>
                        @foreach($registros as $registro)
                            <tr>
                                <td>{{ $registro->id }}</td>
                                <td>{{ $registro->dependenciaRastrillo }}</td>
                                <td>{{ $registro->tipoArma }}</td>
                                <td>{{ $registro->nombre }}</td>
                                <td>{{ $registro->descripcion }}</td>
                                <td>{{ $registro->codigo }}</td>
                                <td>
                                    <x-adminlte-button class="btn-lg" type="reset" label="Eliminar" icon="fas fa-lg fa-trash"
                                                        data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{ $registro->id }}', '{{ $registro->nombre }}')" />
                                    <x-adminlte-button label="Actualizar" theme="info"
                                                        data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{ $registro->id }}', '{{ $registro->dependenciaRastrillo }}', '{{ $registro->tipoArma }}', '{{ $registro->nombre }}', '{{ $registro->descripcion }}', '{{ $registro->codigo }}')" />
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>

               <!-- Modal para Eliminar Rastrillo -->
<x-adminlte-modal id="modalEliDis" title="Eliminar Rastrillo">
    @csrf
    <div class="row">
        <input type="hidden" id="rastrillo_id" name="rastrillo_id"/>
        <x-adminlte-input name="iRastrillo" label="Dependencia Rastrillo:" placeholder="Ingrese Dependencia Rastrillo" fgroup-class="col-md-12"/>
    </div>
    <x-slot name="footerSlot">
        <div name="eliminar_rastrillo" id="eliminar_rastrillo">
        </div>
        <a href="#" class="btn btn-danger" onclick="eliminar_rastrillo();">Eliminar</a>
    </x-slot>
</x-adminlte-modal>


                    <!-- Modal para Editar Rastrillo -->
                    <x-adminlte-modal id="modalActDis" title="Actualizar Rastrillo">
                        <div class="card-body">
                            <form id="formEditarRastrillo">
                                @csrf
                                <div class="row">
                                    <x-adminlte-input name="selDependenciaRU" label="Dependencia Rastrillo" fgroup-class="col-md-6"/>
                                    <!-- Otros campos para editar el rastrillo -->
                                    <x-adminlte-input name="iTipoArmaRU" label="Tipo de Arma" fgroup-class="col-md-6"/>
                                    <x-adminlte-input name="iNombreRU" label="Nombre" fgroup-class="col-md-6"/>
                                    <x-adminlte-input name="iDescripcionRU" label="Descripción" fgroup-class="col-md-6"/>
                                    <x-adminlte-input name="iCodigoRU" label="Código" fgroup-class="col-md-6"/>
                                </div>
                                <x-slot name="footerSlot">
                                    <div name="rastrillo_act" id="rastrillo_act"></div>
                                    <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                                    <x-adminlte-button type="button" theme="success" label="Actualizar" onclick="actualizarRastrillo()"/>
                                </x-slot>
                            </form>
                        </div>
                    </x-adminlte-modal>

                    <script>
                        function actualizarRastrillo() {
                            // Obtener los datos del formulario
                            var formData = $('#formEditarRastrillo').serializeArray();

                            // Realizar la solicitud AJAX
                            $.ajax({
                                url: 'actualizar-rastrillo',
                                type: 'POST',
                                data: formData,
                                success: function(response) {
                                    console.log(response);
                                    $('#modalActDis').modal('hide');
                                    location.reload();
                                    // Realizar acciones adicionales después de la actualización si es necesario
                                },
                                error: function(error) {
                                    console.error('Error al actualizar el rastrillo', error);
                                }
                            });
                        }


                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
