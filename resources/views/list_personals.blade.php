@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Lista de Personal</h1>
@stop
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($events as $event)
                                <tr>
                                        <td>{{$event->id}}</td>
                                        <td>{{$event->identificacion}}</td>
                                        <td>{{$event->nom_ape}}</td>
                                        <td>{{$event->fecha_nac}}</td>
                                        <td>{{$event->tipo_sangre}}</td>
                                        <td>{{$event->ciudad}}</td>
                                        <td>{{$event->telefono}}</td>
                                        <td> @if($event->rango == 1)
                                                {{ "Capitan" }}
                                             @elseif($event->rango == 2)
                                                {{ "Teniente" }}
                                             @elseif($event->rango == 3)
                                                {{ "Subteniente" }}
                                             @elseif($event->rango == 4)
                                                {{ "Sargento Primero" }}
                                             @elseif($event->rango == 5)
                                                {{ "Sargento Segundo" }}
                                             @elseif($event->rango == 6)
                                                {{ "Cabo Primero" }}
                                                @elseif($event->rango ==7)
                                                {{ "Cabo Segundo" }}
                                             @else {{"VACIO"}}
                                            @endif
                                        </td>
                                        <td>{{$event->prov}}</td>
                                        <td>


                                        <x-adminlte-button class="btn-lg" type="reset" label="Eliminar"  icon="fas fa-lg fa-trash"
                                           data-toggle="modal" data-target="#modalEliDis" onclick="cargardata('{{$event->id}}', '{{$event->nom_ape}}')" />

                                         <x-adminlte-button label="Actualizar" theme="info"
                                             data-toggle="modal" data-target="#modalActDis" onclick="cargardata_act('{{ $event->id }}', '{{ $event->identificacion }}', '{{ $event->nom_ape }}', '{{ $event->fecha_nac }}', '{{ $event->tipo_sangre }}', '{{ $event->ciudad }}', '{{ $event->telefono }}', '{{ $event->rango }}', '{{ $event->dep }}')" />
                                        </td>



                                </tr>
                            @endforeach

                            <x-adminlte-modal id="modalEliDis" title="Eliminar Personal">
                            @csrf
                            <div class="row">
                                <x-adminlte-input disabled name="iPerso" label="Personal:" placeholder="Ingrese Distrito" fgroup-class="col-md-12"/>
                            </div>
                            <x-slot name="footerSlot">
                            <div name="eliminar_cir" id="eliminar_cir">
                            </div>
                                <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                            </x-slot>
                            </x-adminlte-modal>
                            <!--MODAL EDITAR-->
                            <x-adminlte-modal id="modalActDis" title="Actualizar Personal">
                                <div class="card-body">

                                        <div class="row">
                                            <x-adminlte-input name="iIdenU" label="Identificacion" placeholder="Ingrese Identificacion" label-class="text-lightblack"  fgroup-class="col-md-6">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="iNomApeU" label="Nombres y Apellidos" placeholder="Ingrese Nombres y Apellidos" label-class="text-lightblack"  fgroup-class="col-md-6">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            @php
                                                $config = [
                                                             'format' => 'YYYY-MM-DD',
                                                            'locale' => 'es', // Set the locale to Spanish
                                                            ];
                                            @endphp
                                            <x-adminlte-input-date  label="Fecha Nacimiento" name="ifechanacU"  :config="$config" fgroup-class="col-md-6">
                                                 <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-check text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input-date>

                                            <x-adminlte-input name="iTipoSangreU" label="Tipo Sangre" placeholder="Ingrese Tipo Sangre" label-class="text-lightblack"  fgroup-class="col-md-6">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-tint text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="iCiudadU" label="Ciudad Nacimiento" placeholder="Ingrese Ciudad Nacimiento" label-class="text-lightblack"  fgroup-class="col-md-6">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-city text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="iTelefonoU" label="Telefono Celular" placeholder="Telefono Celular" label-class="text-lightblack"  fgroup-class="col-md-6">
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone text-lightblack"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                             <x-adminlte-select name="selRangoU" id="selRangoU" label="Rango o Grado" fgroup-class="col-md-6">
                                                    <x-slot name="prependSlot">
                                                        <div class="input-group-text bg-gradient-info">
                                                          <i class="fas fa-user-md text-lightblack"></i>
                                                        </div>
                                                    </x-slot>
                                                    <option>SELECCIONE RANGO O GRADO</option>
                                                    <option value="1">Capitan</option>
                                                    <option value="2">Teniente</option>
                                                    <option value="3">Subteniente</option>
                                                    <option value="4">Sargento Primero</option>
                                                    <option value="5">Sargento Segundo</option>
                                                    <option value="6">Cabo Primero</option>
                                                    <option value="7">Cabo Segundo</option>
                                            </x-adminlte-select>

                                            <x-adminlte-select id="selDependeciaACU" name="selDependeciaACU" label="Dependencia" fgroup-class="col-md-6" data-placeholder="Selecciona Dependencia...">
                                                        <x-slot name="prependSlot">
                                                            <div class="input-group-text bg-gradient-info">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </div>
                                                        </x-slot>



                                                    </x-adminlte-select>

                                        </div>
                                         <x-slot name="footerSlot">

                                            <div name="cir_act" id="cir_act"></div>

                                         <x-adminlte-button theme="danger" label="NO" data-dismiss="modal"/>
                                        </x-slot>

                            </div>

                            </x-adminlte-modal>

                    </x-adminlte-datatable>
                     <script>


                         function actualizarPersonal(id) {

                                var nuevoiIdenU = $('#iIdenU').val();
                                var nuevoiNomApeU = $('#iNomApeU').val();
                                var nuevoifechanacU = $('#ifechanacU').val();
                                var nuevoiTipoSangreU = $('#iTipoSangreU').val();
                                var nuevoiCiudadU = $('#iCiudadU').val();
                                var nuevoiTelefonoU = $('#iTelefonoU').val();
                                var nuevoselRangoU= $('select[name="selRangoU"]').val();
                                var nuevoselDependeciaACU= $('select[name="selDependeciaACU"]').val();

                                // Realizar la solicitud AJAX
                                $.ajax({
                                    url: 'actualizar-personal' , // Reemplaza con la ruta adecuada en tu aplicación
                                    type: 'POST', // O el método HTTP que estés utilizando para la actualización
                                   data: {
                                    'id':id,
                                    'identificacion':nuevoiIdenU,
                                    'nom_ape':nuevoiNomApeU,
                                    'fecha_nac' :nuevoifechanacU,
                                    'tipo_sangre':nuevoiTipoSangreU,
                                    'ciudad' :nuevoiCiudadU,
                                    'telefono' :nuevoiTelefonoU,
                                    'dependencia':nuevoselDependeciaACU,
                                    'rango':nuevoselRangoU,

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
                    function cargardata_act(id, identificacion, nom_ape, fecha_nac, iTipoSangre, iCiudad, iTelefono, selRango, dep) {
                            $('#modalActDis [name=iIdenU]').val(identificacion);
                            $('#modalActDis [name=iNomApeU]').val(nom_ape);
                            $('#modalActDis [name=ifechanacU]').val(fecha_nac);
                            $('#modalActDis [name=iTipoSangreU]').val(iTipoSangre);
                            $('#modalActDis [name=iCiudadU]').val(iCiudad);
                            $('#modalActDis [name=iTelefonoU]').val(iTelefono);
                            // Seleccionar la opción en el select
                            $('#modalActDis #selRangoU').val(selRango);

                            // Llamar a Ajax para cargar opciones en selDependeciaAC
                           $('#selDependeciaACU').empty();
                            $.ajax({
                            type: 'GET',
                            url: 'obtener-dependencia-group',
                            success: function (data) {
                             $.each(data, function (id, descripcion) {
                                $('#selDependeciaACU').append($('<option>', {
                                    value: id,
                                    text: descripcion
                                }));
                            });
                            // Establece la opción seleccionada usando select2
                            $('#selDependeciaACU').val(dep).trigger('change');
                            }
                            });
                            $("#cir_act").html('<a href="javascript:actualizarPersonal('+id+');" class="btn btn-success" >Actulizar</a>')
                        }
                        function cargardata(id, nombre) {
                            $('#modalEliDis [name=iPerso]').val(nombre);
                            $("#eliminar_cir").html('<a href="javascript:eliminar_perso('+id+');" class="btn btn-success" >Eliminar</a>');
                        }

                         function eliminar_perso(id){
                             $.ajax({
                                    url: 'eliminarpersonal/' + id,
                                    type: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {

                                           $('#modalEliCir').modal('hide');
                                           location.reload();

                                    },
                                    error: function (error) {
                                        console.error('Error al eliminar el Personal', error);
                                    }
                        });

                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
