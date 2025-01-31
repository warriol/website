<?php

	// iniciamos session
	session_start ();
	
    // archivos necesarios
    include('../config/config.php');
	
	// verificamos que no este conectado el usuario
	if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
		$arrUsuario = $wda->esUsuario( $_SESSION['usuario'], $_SESSION['password'] );
	} 
	
	// verificamos que sea un admin
	if ( empty($arrUsuario) || $arrUsuario['tipo'] != 'admin' ) {
		header( 'Location: ../index.php' );
		die;
	}

?>
<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml”>
    <head>
        <meta charset="utf-8">
        <title>Blog Admin</title>
    </head>
    
    <body>
    
        <h1>Blog Personal</h1>
        <p>Bienvenido <?php echo $arrUsuario['usuario'] ?> - <a href="../index.php?salir=true">Salir</a></p>
        <ul>
            <li><a href="categorias.php">Administrar Categorías</a></li>
            <li><a href="noticias.php">Administrar Noticias</a></li>
            <li><a href="comentarios.php">Administrar Comentarios</a></li>
        </ul>
        
    </body>
</html>
