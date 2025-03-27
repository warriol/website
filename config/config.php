<?php
	if($_SERVER["SERVER_NAME"] == "localhost"){
		$_URLBASE_ = "http://localhost/wda/";
	}else{
		if (isset($_SERVER['HTTPS'])) {
			$URL_segura = "https://";
		}else{
			$URL_segura = "http://";
		}
		$_URLBASE_ = $URL_segura  . $_SERVER["SERVER_NAME"]. "/";
	}

	require('./app/idioma/idiomas.php');
	
	$lang = 'es';
	if ( isset($_GET['lang']) ){
		$lang = $_GET['lang'];
	}
?>