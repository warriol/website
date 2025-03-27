<?php
// autoload.php
spl_autoload_register(function ($class) {
    // Define la ruta de la clase basada en su nombre y ubicación relativa
    $classPath = __DIR__ . '/class/' . $class . '.php';

    // Verifica si el archivo de la clase existe y lo incluye
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});