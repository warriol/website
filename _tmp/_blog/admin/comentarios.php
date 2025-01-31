<?php

	// iniciamos session
	session_start ();
	
    // archivos necesarios
    require_once '../config/config.php';
	
	// verificamos que no este conectado el usuario
	if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
		$arrUsuario = $wda->esUsuario( $_SESSION['usuario'], $_SESSION['password'] );
	} 
	
	// verificamos que sea un admin
	if ( empty($arrUsuario) || $arrUsuario['tipo'] != 'admin' ) {
		header( 'Location: ../index.php' );
		die;
	}
	
	// borramos un comentario
	if ( !empty($_GET['del']) ) {
		$wda->borrarComentario($_GET['del']);
			
		header( 'Location: comentarios.php?dele=true' );
		die;
		
	}
	
	// aprobamos un comentario
	if ( !empty($_GET['apr']) ) {
		$wda->actualizarComentarioEstado($_GET['apr']);
			
		header( 'Location: comentarios.php?aprobar=true' );
		die;
		
	}
	
	// editamos el comentario
	if ( !empty($_POST['submitEdit']) ) {
		
		// definimos las variables
		if ( !empty($_POST['comentario']) ) 	$comentario 		= $_POST['comentario'];
		if ( !empty($_POST['idComentario']) ) 	$idComentario 		= $_POST['idComentario'];
		
		// completamos la variable error si es necesario
		if ( empty($comentario) ) 		$error['comentario'] 		= 'Es obligatorio tener un cuerpo';
		if ( empty($idComentario) ) 	$error['idComentario'] 		= 'Es obligatoria la id de comentario';
		
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
			
			// inserto los datos de registro en la db
			$wda->actualizarComentario($comentario,$idComentario);
			
			header( 'Location: comentarios.php?edit=true' );
			die;
			
		}
			
	}
	
	// traemos listado de comentarios sin aprboar
	$arrComentarios = $wda->dameComentarios("sin validar");
	
	// si tenemos una categoria puntual
	if ( !empty($_GET['id']) ) {
		$row = $wda->dameComentarioUno($_GET['id']);
	}

?>
<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml”>
    <head>
        <meta charset="utf-8">
        <title>Blog Personal</title>
    </head>
    
    <body>
    
        <h1>Blog Personal</h1>
        <p>Bienvenido <?php echo $arrUsuario['usuario'] ?> - <a href="index.php">Panel de control</a> - <a href="../index.php?salir=true">Salir</a></p>
        <h2>Comentarios sin aprobar</h2>
        <?php if ( !empty($_GET['aprobar']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">El comentario se marcó como apto con éxito.</div>
        <?php } elseif ( !empty($_GET['dele']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">El comentario ha sido borrada con éxito.</div>
        <?php } elseif ( !empty($_GET['edit']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">El comentario ha sido editado con éxito.</div>
        
        <?php } ?>
        
        <div>
            <h3>Listado de Comentarios sin aprobar</h3>
            <table style="width:90%;padding:5px;border:1px solid #cccccc">
                <tr>
                    <th style="background-color:#cccccc;padding:5px;">id</th>
                    <th style="width:80%;background-color:#cccccc;padding:5px;">comentario</th>
                    <th style="background-color:#cccccc;padding:5px;width:20%"></th>
                </tr>
                <?php foreach ($arrComentarios as $comentario) { ?>
                <tr>
                    <td style="padding:5px;"><?php echo $comentario['idComentario']; ?></td>
                    <td style="padding:5px;">
                        <?php echo $comentario['comentario']; ?><br />
                        <i>Dijo <b><?php echo $comentario['usuario']; ?></b> en <a href="../vernoticia.php?idNoticia=<?php echo $comentario['idNoticia']; ?>"><?php echo $comentario['titulo']; ?></a></i>
                    </td>
                    <td style="padding:5px;"><a href="comentarios.php?apr=<?php echo $comentario['idComentario']; ?>">Aprobar</a> - <a href="comentarios.php?id=<?php echo $comentario['idComentario']; ?>">Editar</a> - <a href="comentarios.php?del=<?php echo $comentario['idComentario'] ?>">Borrar</a>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <?php if ( !empty($_GET['id']) ) { ?>
            <div style="background-color:#ff8800;padding:5px; margin-top:10px;">
                <h3 id="add">Editar comentario</h3>
                <?php if (!empty($error)) { ?>
                    <ul>
                    <?php foreach ($error as $mensaje) { ?>
                        <li><?php echo $mensaje ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <form action="comentarios.php" method="post">
                    <p>
                        <label for="nombre">Comentario</label><br />
                        <textarea name="comentario" rows="5" cols="50"><?php echo $row['comentario']; ?></textarea>
                    </p>
                    <p>
                        <input name="idComentario" type="hidden" value="<?php echo $row['idComentario']; ?>" />
                        <input name="submitEdit" type="submit" value="Editar" />
                    </p>
                </form>
            </div>
        <?php } ?>
        
    </body>
</html>