<?php

	// iniciamos session
	session_start ();
	
    // archivos necesarios
    require_once './config/config.php';
	
	// vemos si el usuario quiere desloguar
	if ( !empty($_GET['salir']) ) {
		// borramos y destruimos todo tipo de sesion del usuario
		session_unset();
		session_destroy();
	}
	
	// verificamos que no este conectado el usuario
	if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
		$arrUsuario = $wda->esUsuario( $_SESSION['usuario'], $_SESSION['password'] );		
	}

	// listado de noticias
	// traemos listado de noticias
	$arrNoticias  = $wda->dameNoticiasPub();

?>

<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml”>
    <head>
        <meta charset="utf-8">
        <title>Blog wda</title>
    </head>
     
    <body>
     
	<h1>Blog Personal</h1>
	
		<?php if ( !empty($_GET['registro']) ) { ?>
        	<div>El registro ha sido exitoso.</div>
        <?php } ?>
        
        <?php if ( !isset($arrUsuario['usuario']) ) { ?>
            <ul>
                <li><a href="ingresar.php">Iniciar sesión</a></li>
                <li><a href="registrar.php">Regístrate gratis</a></li>
            </ul>
        <?php } else { ?>
        	<p>Bienvenido <?php echo $arrUsuario['usuario'] ?> - <a href="index.php?salir=true">Salir</a></p>
            <?php if ( $arrUsuario['tipo'] == 'admin' ) { ?>
            <ul>
                <li><a href="admin/index.php">Panel de administración</a></li>
            </ul>
            <?php } ?>
        <?php } ?>
         
        <h2>Noticias</h2>
        <?php
		if (isset($arrNoticias)) {
			foreach ( $arrNoticias as $noticias ) { ?>
        <div>
            <h3> 	</h3>
            <p><?php echo $noticias['copete']; ?></p>
        </div>
        <?php
        	}
		}
		?>
        
    </body>
</html>