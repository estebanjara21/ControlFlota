@extends('adminlte::page')


@section('content_header')
    <h1 class="m-0 text-dark">Eventos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ url('/events') }}" method="POST">
    @csrf
 <div class="row">
  <div class="col-md-3">
    <x-adminlte-input type="date" name="fecha_inicio" label="Fecha de Inicio" placeholder="Ingrese Contacto" value="{{ $fechaInicio ?? now()->format('Y-m-d') }}"/>
</div>
<div class="col-md-3">
    <x-adminlte-input type="date" name="fecha_fin" label="Fecha Fin" placeholder="Ingrese Contacto" value="{{ $fechaFin ?? now()->format('Y-m-d') }}"/>
</div>
<div class="col-md-3">
    <br>
    <x-adminlte-button type="submit" label="Filtrar" theme="primary" icon="fas fa-save" />
</div>
</div>
</form>
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads" striped  head-theme="dark" with-buttons>
                            @foreach($events as $event)
                                <tr>    <td>{{ isset($fechaInicio) ? $fechaInicio : now()->format('Y-m-d') }}</td>
                                        <td>{{ isset($fechaFin) ? $fechaInicio : now()->format('Y-m-d') }}</td>
                                        <td>{{$event->cantidad_eventos}}</td>
                                        <td>{{$event->tipo_evento}}</td>
                                        <td>{{$event->circuito_nombre}}</td>
                                        <td>{{$event->subcircuito_nombre}}</td>



                                </tr>
                            @endforeach

                    </x-adminlte-datatable>
                </div>
            </div id="totalEventosCircuito">0</div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#selCircuito').change(function () {
                var idCircuito = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: '/getTotalEventosPorCircuito/' + idCircuito,
                    success: function (data) {
                        $('#totalEventosCircuito').text(data.total);
                    }
                });
            });
        });
    </script>
@stop
