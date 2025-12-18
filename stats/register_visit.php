<?php
// Archivo: `register_visit.php`

// Obtener la dirección IP del visitante
$ip = $_SERVER['REMOTE_ADDR'];

// Obtener la fecha y hora actual
$date = date('Y-m-d H:i:s');

// Obtener el User-Agent del navegador
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Detectar el sistema operativo
function getOS($userAgent) {
    $osArray = [
        'Windows' => 'Windows',
        'Mac' => 'Macintosh',
        'Linux' => 'Linux',
        'Android' => 'Android',
        'iOS' => '(iPhone|iPad|iPod)',
    ];

    foreach ($osArray as $os => $pattern) {
        if (preg_match("/$pattern/i", $userAgent)) {
            return $os;
        }
    }
    return 'Unknown OS';
}

// Detectar si es móvil o escritorio
function getDeviceType($userAgent) {
    if (preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent)) {
        return 'Mobile';
    }
    return 'Desktop';
}

$os = getOS($userAgent);
$deviceType = getDeviceType($userAgent);

// Crear o abrir el archivo de registro
$file = 'visits.log';

// Formatear la información a guardar
$logEntry = "IP: $ip | Fecha: $date | OS: $os | Dispositivo: $deviceType | User-Agent: $userAgent" . PHP_EOL;

// Escribir la información en el archivo
file_put_contents($file, $logEntry, FILE_APPEND);

// Responder con un mensaje de éxito
echo json_encode(['status' => 'success', 'message' => 'Visita registrada']);
