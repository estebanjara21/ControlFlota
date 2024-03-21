@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Registro de Eventos</h1>
@stop

@section('content')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('registrar') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                          <div class="row">
                                <x-adminlte-select2 name="selCircuito" id="selCircuito" label="Circuito" fgroup-class="col-md-12" data-placeholder="Selecciona Circuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <option value=""></option> {{-- Opción vacía --}}
                                    @foreach($circuitos as $id => $descripcion)
                                        <option value="{{ $id }}">{{ $descripcion }}</option>
                                    @endforeach
                                </x-adminlte-select2>

                        </div>

                        <div class="row">
                            <x-adminlte-select2 id="selSubcircuito" name="selSubcircuito" label="Subcircuito" fgroup-class="col-md-12" data-placeholder="Selecciona Subcircuito...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </x-slot>
                                    <script>
                                        $(document).ready(function () {
                                            $('#selCircuito').change(function () {
                                                var idCircuito = $(this).val();

                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'obtener-subcircuitos',
                                                    data: { id_circuito: idCircuito },
                                                    success: function (data) {
                                                        $('#selSubcircuito').empty();

                                                        $.each(data, function (id, descripcion) {
                                                            $('#selSubcircuito').append($('<option>', {
                                                                value: id,
                                                                text: descripcion
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </x-adminlte-select2>


                        </div>
                        <div class="row">
                            <x-adminlte-select name="selTipo" label="Tipo" fgroup-class="col-md-12">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-info">
                                        <i class="fas fa-copy"></i>
                                    </div>
                                </x-slot>
                                <option>Seleccione Tipo</option>
                                <option value="1">Reclamo</option>
                                <option value="2">Sugerencia</option>
                            </x-adminlte-select>
                        </div>
                        <div class="row">
                            <x-adminlte-textarea name="taDesc" label="Descripcion" rows=5 fgroup-class="col-md-12" placeholder="Ingrese Descripcion...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-lg fa-file-alt text-warning"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-textarea>
                        </div>
                        <div class="row">
                            <x-adminlte-input name="iContacto" label="Contacto" placeholder="Ingrese Contacto" fgroup-class="col-md-12"/>
                        </div>
                        <div class="row">
                            <x-adminlte-input name="iApellidos" label="Apellidos" placeholder="Ingrese Apellidos" fgroup-class="col-md-12"/>
                        </div>
                        <div class="row">
                            <x-adminlte-input name="iNombres" label="Nombres" placeholder="Ingrese Nombres" fgroup-class="col-md-12"/>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                 <x-adminlte-button type="submit" label="Registrar" theme="primary" icon="fas fa-save" class="w-100"/>
                            </div>

                    </div>
                    </div>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@stop
