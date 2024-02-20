<!-- resources/views/pdf/solicitud.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud</title>
    <!-- Puedes incluir estilos adicionales aquí si es necesario -->
</head>
<body>
    <h1>Solicitud</h1>
    
    <p>Placa: {{ $nom_ape }}</p>
    <p>Placa: {{ $placa }}</p>
    <p>Chasis: {{ $chasis }}</p>
    <p>Fecha y Hora: {{ $fecha_hora }}</p>
    <p>Kilometraje: {{ $Kilometraje }}</p>
    <p>Observaciones: {{ $obs }}</p>
    <!-- Puedes agregar más contenido según sea necesario -->

    <!-- Importante: El contenido HTML específico para TCPDF debe ir aquí -->
</body>
</html>
