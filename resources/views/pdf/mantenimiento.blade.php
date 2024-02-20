<!-- resources/views/pdf/solicitud.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud</title>
    <!-- Puedes incluir estilos adicionales aquí si es necesario -->
</head>
<body>
    <h1>Mantenimiento</h1>
    
    <p>Identificacion: {{ $detalles->identificacion }}</p>
    <p>Nombre y Apellidos: {{ $detalles->apellido_personal }}</p>
    <p>Tipo Vehiculo:
        @if($detalles->tipo_vehiculo == 1)
                                        {{ "Auto" }}
                                    @elseif($detalles->tipo_vehiculo == 2)
                                        {{ "Motocicleta" }}
                                    @elseif($detalles->tipo_vehiculo == 3)
                                        {{ "Camioneta" }}
                                    @else
                                        {{"VACIO"}}
                                    @endif
    </p>
    <p>Placa Vehiculo: {{ $detalles->placa_vehiculo }}</p>
       <p>Detalle: {{ $detalles->detalle }}</p>
        <p>Asunto: {{ $detalles->asunto}}</p>
   <p>Tipo Mantenimiento: @if($detalles->tipo_mantenimiento == 1)
                                        {{ "Mantenimiento 1" }}
                                    @elseif($detalles->tipo_mantenimiento == 2)
                                        {{ "Mantenimiento 2" }}
                                    @elseif($detalles->tipo_mantenimiento == 3)
                                        {{ "Mantenimiento 3" }}
                                    @else
                                        {{"VACIO"}}
                                    @endif</p>

    
    <!-- Puedes agregar más contenido según sea necesario -->

    <!-- Importante: El contenido HTML específico para TCPDF debe ir aquí -->
</body>
</html>
