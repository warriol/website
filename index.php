<?php
/*
 * Inicio de Sitio Web uso personal
 * Para uso exclusivo del autor.
 * Autor: Wilon Denis Arriola
 */

$mensaje = [];

switch ( $_SERVER[ 'REQUEST_METHOD' ] ) {
    case 'GET':
        if ( count( $_GET ) === 1 ) {
            include( 'app/public/index.tpl' );
            break;
        } else {
            $mensaje = [
                "titulo": "Error en GET",
                "msj": "Se recibe cantidad incorrecta de parametros GET."
            ];
            include( 'app/error/index.tpl' );
            break;
        }
    break;

    case 'POST':
        echo "Se recibe post";
    break;
  
    case 'COOKIE':
        echo 'SE RECIBE COOKIE';
    break;

    default:
        $mensaje = [
            "titulo": "Error INDEX",
            "msj": "No se recibió request method."
        ];
        include( 'app/error/index.tpl' );
    break;

}
?>