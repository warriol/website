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
	
	// borramos una noticia si obtenemos la variable GET del
	if ( !empty($_GET['del']) ) {
		
		$wda->borrarNoticias($_GET['del']);
			
		header( 'Location: noticias.php?dele=true' );
		die;
		
	}
	
	// agregamos una noticia en la db
	// si se envio el formulario
	if ( !empty($_POST['submit']) ) {
		
		// definimos las variables
		if ( !empty($_POST['titulo']) ) 		$titulo 		= $_POST['titulo'];
		if ( !empty($_POST['copete']) ) 		$copete 		= $_POST['copete'];
		if ( !empty($_POST['cuerpo']) ) 		$cuerpo 		= $_POST['cuerpo'];
		if ( !empty($_POST['idCategoria']) ) 	$idCategoria 	= $_POST['idCategoria'];
		if ( !empty($_POST['fPublicacion']) ) 	$fPublicacion 	= $_POST['fPublicacion'];	
		
		// completamos la variable error si es necesario
		if ( empty($titulo) ) 	$error['titulo'] 		= 'Es obligatorio completar el título de la noticia';
		if ( empty($copete) ) 	$error['copete'] 		= 'Es obligatorio completar el copete de la noticia';
		if ( empty($cuerpo) ) 	$error['cuerpo'] 		= 'Es obligatorio completar el cuerpo de la noticia';
		if ( empty($idCategoria) ) 	$error['idCategoria'] 	= 'Es obligatorio seleccionar una categor&iacute;a para la noticia';
		
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
			// inserto los datos de registro en la db
			$fCreacion = date("Y-m-d H:i:s");
			$fModificacion = date("Y-m-d H:i:s");
			if ( empty($fPublicacion) ) $fPublicacion = date("Y-m-d H:i:s");
			$idUsuario = $arrUsuario['idUsuario'];
			
			$wda->agregarNoticia($titulo,$copete,$cuerpo,$idCategoria,$idUsuario,$fCreacion,$fModificacion,$fPublicacion);
			header( 'Location: noticias.php?add=true' );
			die;
		}
	}
	
	// si se envio el formulario de edicion
	if ( !empty($_POST['submitEdit']) ) {
		
		// definimos las variables
		if ( !empty($_POST['idNoticia']) ) 		$idNoticia 		= $_POST['idNoticia'];
		if ( !empty($_POST['titulo']) ) 		$titulo 		= $_POST['titulo'];
		if ( !empty($_POST['copete']) ) 		$copete 		= $_POST['copete'];
		if ( !empty($_POST['cuerpo']) ) 		$cuerpo 		= $_POST['cuerpo'];
		if ( !empty($_POST['idCategoria']) ) 	$idCategoria 	= $_POST['idCategoria'];
		if ( !empty($_POST['fPublicacion']) ) 	$fPublicacion 	= $_POST['fPublicacion'];	
		
		// completamos la variable error si es necesario
		if ( empty($idNoticia) ) 	$error['idNoticia'] 		= 'Es obligatorio tener la id de la noticia que se desea modificar';
		if ( empty($titulo) ) 		$error['titulo'] 			= 'Es obligatorio completar el título de la noticia';
		if ( empty($copete) ) 		$error['copete'] 			= 'Es obligatorio completar el copete de la noticia';
		if ( empty($cuerpo) ) 		$error['cuerpo'] 			= 'Es obligatorio completar el cuerpo de la noticia';
		if ( empty($idCategoria) ) 	$error['idCategoria'] 		= 'Es obligatorio seleccionar una categor&iacute;a para la noticia';
		
		// si no hay errores editamos la noticia
		if ( empty($error) ) {
			
			// actualizamos la fecha de modificacion y de publicacion
			$fModificacion = date("Y-m-d H:i:s");
			if ( empty($fPublicacion) ) $fPublicacion = date("Y-m-d H:i:s");
			$idUsuario = $arrUsuario['idUsuario'];
			
			// inserto los datos de registro en la db
			$wda->actualizarNoticias($titulo,$copete,$cuerpo,$idCategoria,$idUsuario,$fModificacion,$fPublicacion,$idNoticia);
			header( 'Location: noticias.php?edit=true' );
			die;
			
		}
			
	}
	

	// traemos listado de categorias
	$arrCategorias = $wda->dameCatTodas();

	// si tenemos una categoria puntual
	if ( !empty($_GET['id']) ) {
		// traemos una categoria
		$row = $wda->dameNoticiaUna($_GET['id']);
	}
	
	// traemos listado de noticias
	$arrNoticias = $wda->dameNoticias();
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
        <h2>Noticias</h2>
        <?php if ( !empty($_GET['add']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La noticia se agregó con éxito.</div>
        <?php } elseif ( !empty($_GET['dele']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La noticia ha sido borrada con éxito.</div>
        <?php } elseif ( !empty($_GET['edit']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La noticia ha sido editada con éxito.</div>
        <?php } ?>
        
        <div>
            <h3>Listado de Noticias</h3>
            <table style="width:90%;padding:5px;border:1px solid #cccccc">
                <tr>
                    <th style="background-color:#cccccc;padding:5px;">id</th>
                    <th style="width:90%;background-color:#cccccc;padding:5px;">título</th>
                    <th style="background-color:#cccccc;padding:5px;width:10%"></th>
                </tr>
                <?php foreach ($arrNoticias as $noticias) { ?>
                <tr>
                    <td style="padding:5px;"><?php echo $noticias['idNoticia']; ?></td>
                    <td style="padding:5px;"><?php echo $noticias['titulo']; ?></td>
                    <td style="padding:5px;"><a href="noticias.php?id=<?php echo $noticias['idNoticia']; ?>">Editar</a> - <a href="noticias.php?del=<?php echo $noticias['idNoticia'] ?>">Borrar</a>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <?php if ( empty($_GET['id']) ) { ?>
            <div>
                <h3 id="add">Agregar nueva noticia</h3>
                <?php if (!empty($error)) { ?>
                    <ul>
                    <?php foreach ($error as $mensaje) { ?>
                        <li><?php echo $mensaje ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <form action="noticias.php" method="post">
                
                    <p>
                        <label for="titulo">título de la noticia</label><br />
                        <input name="titulo" type="text" value="" />
                    </p>
                    <p>
                        <label for="idCategoria">Categoría</label><br />
                        <select name="idCategoria">
                            <option value="">Seleccione una categoría</option>
                            <option value="">------------------------</option>
                            <?php foreach ( $arrCategorias as $categoria ) { ?>
                            <option value="<?php echo $categoria['idCategoria']; ?>"><?php echo $categoria['valor']; ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p>
                        <label for="fPublicacion">Fecha de publicacion (aaaa-mm-dd hh:mm:ss) Ej: 2008-10-29 17:20:00 </label><br />
                        <input name="fPublicacion" type="text" value="" />
                    </p>
                    <p>
                        <label for="copete">Copete</label><br />
                        <textarea rows="5" cols="50" name="copete"></textarea>
                    </p>
                    <p>
                        <label for="cuerpo">Cuerpo</label><br />
                        <textarea rows="10" cols="50" name="cuerpo"></textarea>
                    </p>
                    <p>
                        <input name="submit" type="submit" value="Agregar" />
                    </p>
                </form>
            </div>
        <?php } ?>
        
        <?php if ( !empty($_GET['id']) ) { ?>
            <div style="background-color:#ff8800;padding:5px; margin-top:10px;">
                <h3 id="add">Editar noticia</h3>
                <?php if (!empty($error)) { ?>
                    <ul>
                    <?php foreach ($error as $mensaje) { ?>
                        <li><?php echo $mensaje ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <form action="noticias.php" method="post">
                    <p>
                        <label for="titulo">título de la noticia</label><br />
                        <input name="titulo" type="text" value="<?php echo $row['titulo']; ?>" />
                    </p>
                    <p>
                        <label for="idCategoria">Categoría</label><br />
                        <select name="idCategoria">
                            <option value="">Seleccione una categoría</option>
                            <option value="">------------------------</option>
                            <?php foreach ( $arrCategorias as $categoria ) { ?>
                            <option value="<?php echo $categoria['idCategoria']; ?>" <?php if ( $categoria['idCategoria'] == $row['idCategoria'] ) echo 'selected="selected"' ?>><?php echo $categoria['valor']; ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p>
                        <label for="fPublicacion">Fecha de publicacion (aaaa-mm-dd hh:mm:ss) Ej: 2008-10-29 17:20:00 </label><br />
                        <input name="fPublicacion" type="text" value="<?php echo $row['fPublicacion']; ?>" />
                    </p>
                    <p>
                        <label for="copete">Copete</label><br />
                        <textarea rows="5" cols="50" name="copete"><?php echo $row['copete']; ?></textarea>
                    </p>
                    <p>
                        <label for="cuerpo">Cuerpo</label><br />
                        <textarea rows="10" cols="50" name="cuerpo"><?php echo $row['cuerpo']; ?></textarea>
                    </p>
                    <p>
                        <input name="idNoticia" type="hidden" value="<?php echo $row['idNoticia']; ?>" />
                        <input name="submitEdit" type="submit" value="Editar" />
                    </p>
                    
                    
                </form>
            </div>
        <?php } ?>
        
    </body>
</html>