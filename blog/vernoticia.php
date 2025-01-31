<?php

	// iniciamos session
	session_start ();
	
    // archivos necesarios
    require_once 'config/config.php';
	
	// verificamos que este conectado el usuario
	if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
		$arrUsuario = $wda->esUsuario( $_SESSION['usuario'], $_SESSION['password'] );		
	}
	
	if ( !empty($_POST['submit']) ) {
		if ( !empty($_POST['comentario']) ) 	$comentario 	= $_POST['comentario'];
		if ( !empty($_GET['idNoticia']) )		$idNoticia 		= $_GET['idNoticia'];
		if ( !empty($arrUsuario['idUsuario']))	$idUsuario		= $arrUsuario['idUsuario'];
		
		// completamos la variable error si es necesario
		if ( empty($comentario) ) 	$error['comentario'] 		= true;
		if ( empty($idNoticia) ) 	$error['idNoticia'] 		= true;
		if ( empty($idUsuario) ) 	$error['idUsuario'] 		= true;
		
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
			// inserto los datos de registro en la db
			$wda->guardarComentario($comentario,$idUsuario,$idNoticia);
			header( 'Location: vernoticia.php?idNoticia='.$idNoticia );
			die;
		}
	}
	
	// traemos la noticia
	$noticia = $wda->dameNoticia($_GET['idNoticia']);
	
	// traemos los comentarios aprobados
	$arrComentarios = $wda->dameComentariosId($_GET['idNoticia']);

?>
<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml”>
    <head>
        <meta charset="utf-8">
        <title>Blog Personal</title>
    </head>
    
    <body>
    
        <h1>Blog Personal</h1>
        
        <?php if ( empty($arrUsuario['usuario']) ) { ?>
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
    
        <h2><?php echo $noticia['titulo']; ?></h2>
        <p>Publicado por <b><?php echo $noticia['usuario']; ?></b> en <i><?php echo $noticia['categoria']; ?></i></p>
        <div><?php echo $noticia['cuerpo']; ?></div>
        
        <h2>Comentarios</h2>
        <div>
            <?php foreach ($arrComentarios as $comentario) { ?>
            <p>
                <b><?php echo $comentario['usuario']; ?></b> dijo:<br />
                <i><?php echo $comentario['comentario']; ?></i>
            </p>
            <?php } ?>	
        </div>
        
        <div>
            <?php if ( !empty( $arrUsuario ) ) { ?>
            
                <form action="vernoticia.php?idNoticia=<?php echo $_GET['idNoticia']; ?>" method="post">
                    <p>
                        <label for="comentario">Dejar un comentario</label><br />
                        <textarea rows="3" cols="50" name="comentario"></textarea>
                    </p>
                    <p>
                        <input name="submit" type="submit" value="Enviar" />
                    </p>
                </form>
            
            <?php } else { ?>
                <p>Para dejar un comentario hay que ser un usuario registrado. <a href="registrar.php">Registrar</a> o <a href="ingresar.php">Ingresar</a></p>
            <?php } ?>
        </div>
    </body>
</html>