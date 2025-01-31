<?php
	/*
	*
	* manejo de errores generales
	*
	*/
	
	session_start();
	session_destroy();

	// cargo el archivo de configuracion
	include('../config/config.php');
	
	// mensaje a mostrar
    $msj = "Sesion no iniciada. Intento de vulnerar el sistema. Se generaron archivos de regsitro.";
	if( isset($_GET['msj']) ){ $msj = $_GET['msj']; }
	
	// variables de servidor
	$indicesServer = array('PHP_SELF',
							'argv',
							'argc',
							'GATEWAY_INTERFACE',
							'SERVER_ADDR',
							'SERVER_NAME',
							'SERVER_SOFTWARE',
							'SERVER_PROTOCOL',
							'REQUEST_METHOD',
							'REQUEST_TIME',
							'REQUEST_TIME_FLOAT',
							'QUERY_STRING',
							'DOCUMENT_ROOT',
							'HTTP_ACCEPT',
							'HTTP_ACCEPT_CHARSET',
							'HTTP_ACCEPT_ENCODING',
							'HTTP_ACCEPT_LANGUAGE',
							'HTTP_CONNECTION',
							'HTTP_HOST',
							'HTTP_REFERER',
							'HTTP_USER_AGENT',
							'HTTPS',
							'REMOTE_ADDR',
							'REMOTE_HOST',
							'REMOTE_PORT',
							'REMOTE_USER',
							'REDIRECT_REMOTE_USER',
							'SCRIPT_FILENAME',
							'SERVER_ADMIN',
							'SERVER_PORT',
							'SERVER_SIGNATURE',
							'PATH_TRANSLATED',
							'SCRIPT_NAME',
							'REQUEST_URI',
							'PHP_AUTH_DIGEST',
							'PHP_AUTH_USER',
							'PHP_AUTH_PW',
							'AUTH_TYPE',
							'PATH_INFO',
							'ORIG_PATH_INFO') ;

	$tbl = '<table class="table" cellpadding="10">' ;
	foreach ($indicesServer as $arg) {
		if (isset($_SERVER[$arg])) {
			$tbl .= '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
		}
		else {
			$tbl .= '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
		}
	}
	$tbl .= '</table>' ;

?>