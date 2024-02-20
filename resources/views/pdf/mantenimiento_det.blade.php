<!-- resources/views/pdf/solicitud.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud</title>
    <!-- Puedes incluir estilos adicionales aquí si es necesario -->
</head>
<body>
    <h1>Detalle de Mantenimiento</h1>
    <p>Fecha de Solicitud: {{ $detalles->solicitud_fecha }}</p>
    <p>Fecha de Registro: {{ $detalles->fecha_hora }}</p>
    <p>Fecha de Entrega: {{ $detalles->updated_at }}</p>
    <p>Nombre y Apellidos: {{ $detalles->apellido_personal }}</p>
     <p>Persona que retira el Vehiculo: {{ $detalles->persona_retira }}</p>
      <p>Kilometraje Actual: {{ $detalles->kilometraje }}</p>
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

    <p>Kilometraje Proximo Mantenimiento: 
     @if($detalles->tipo_vehiculo == 1)
        {{ $detalles->kilometraje + 5000 }}
    @elseif($detalles->tipo_vehiculo == 2)
                                       {{ $detalles->kilometraje + 2000 }} 
        @elseif($detalles->tipo_vehiculo == 3)
                                         {{ $detalles->kilometraje + 5000 }} 
        @else
                                        {{"VACIO"}}
     @endif  
    <span style="color: red;">*Kilometraje Calulado Automaticamente</span></p>
    
    <!-- Puedes agregar más contenido según sea necesario -->

    <!-- Importante: El contenido HTML específico para TCPDF debe ir aquí -->
</body>
</html>
