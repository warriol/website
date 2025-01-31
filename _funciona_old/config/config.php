<?php
	if($_SERVER["SERVER_NAME"] == "localhost"){
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "sitio";
		$_URLBASE_ = "http://localhost/wda/";
	}else{
		$DB_host = "localhost";
		$DB_user = "wilsonar_sitio";
		$DB_pass = "wda43791";
		$DB_name = "sitio";
		if (isset($_SERVER['HTTPS'])) {
			$URL_segura = "https://";
		}else{
			$URL_segura = "http://";
		}
		$_URLBASE_ = $URL_segura  . $_SERVER["SERVER_NAME"]. "/";
	}

	try
	{
		$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		$msj = $e->getMessage();
		header("Location: ".$_URLBASE_."/errores/index.php?msj=".$msj);
	}

	include_once './clases/class.wda.php';
	$wda = new wda($DB_con);

	require('./app/idioma/idiomas.php');
	
	$lang = 'es';
	if ( isset($_GET['lang']) ){
		$lang = $_GET['lang'];
	}
?>