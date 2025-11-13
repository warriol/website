<?php
	if($_SERVER["SERVER_NAME"] == "localhost"){
		// servidor local
		$DB_host = "localhost";
		$DB_user = "root";
		$DB_pass = "";
		$DB_name = "blog";
		
		$_URL_ = "http://localhost/website/";
        $_URLBASE_ = "http://localhost/website/blog/";
	}else{
		// servidor externo
		$DB_host = "localhost";
		$DB_user = "wilsonar_sitio";
		$DB_pass = "wda43791";
		$DB_name = "wilsonar_sitio";
		
		// verifico si es seguro
		$URL_segura = "http://";
		if (isset($_SERVER['HTTPS'])) {
			$URL_segura = "https://warriol.com.uy/blog/";
		}
		
		$_URLBASE_ = $URL_segura  . $_SERVER["SERVER_NAME"]. "/";
		
		// verifico si trae www
		$div_url = explode(".", $_SERVER["SERVER_NAME"]);
		
		if($div_url[0] != "www"){
			$_URLBASE_ = $URL_segura  . 'www.' . $_SERVER["SERVER_NAME"]. "/";	
		}
		
	}

	// conección con la base de datos
	try{
		$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		$msj = $e->getMessage();
		
		header("Location: ".$_URL_."/errores/index.php?msj=".$msj);
	}

	// incluyo la clase general
	include_once './clases/class.wda.php';
	$wda = new wda($DB_con);

	// incluimos archivos de idioma
	require('../app/idioma/idiomas.php'); 
	
	// definicmos variables globales
	$lang = 'es';
	if ( isset($_GET['lang']) ){
		$lang = $_GET['lang'];
	}

?>