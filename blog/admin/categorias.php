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
	
	// borramos una categoria
	if ( !empty($_GET['del']) ) {
		
		$wda->borrarCat($_GET['del']);

		header( 'Location: categorias.php?dele=true' );
		die;
		
	}
	
	// agregamos una categoria en la db
	// si se envio el formulario
	if ( !empty($_POST['submit']) ) {
		
		// definimos las variables
		if ( !empty($_POST['nombre']) ) 	$nombre 			= $_POST['nombre'];
		
		// completamos la variable error si es necesario
		if ( empty($nombre) ) 				$error['nombre'] 	= 'Es obligatorio completar el nombre de la categoría';
		
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
			
			// inserto los datos de registro en la db
			$wda->guardarCat($nombre);
			
			header( 'Location: categorias.php?add=true' );
			die;
			
		}
			
	}
	
	if ( !empty($_POST['submitEdit']) ) {
		// definimos las variables
		if ( !empty($_POST['nombre']) ) 		$nombre 		= $_POST['nombre'];
		if ( !empty($_POST['idCategoria']) ) 	$idCategoria 	= $_POST['idCategoria'];
		
		// completamos la variable error si es necesario
		if ( empty($nombre) ) 		$error['nombre'] 		= 'Es obligatorio completar el nombre de la categoría';
		if ( empty($idCategoria) ) 	$error['idCategoria'] 	= 'Falta la ID de la categoría';
		
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
			// inserto los datos de registro en la db
			$wda->actualziarCat($nombre, $idCategoria);
			
			header( 'Location: categorias.php?edit=true' );
			die;
		}	
	}
	
	// traemos listado de categorias
	$arrCategorias = $wda->dameCatTodas();
	
	// si tenemos una categoria puntual
	if ( !empty($_GET['id']) ) {
		// traemos una categoria
		$row = $wda->dameCatUna($_GET['id']);
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
        <h2>Categorías</h2>
        <?php if ( !empty($_GET['add']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La categoría se agregó con éxito.</div>
        <?php } elseif ( !empty($_GET['dele']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La categoría ha sido borrada con éxito.</div>
        <?php } elseif ( !empty($_GET['edit']) ) { ?>
        <div style="background-color: #fdfdfd;border:1px solid #ff8800;width:90%;padding:5px">La categoría ha sido editada con éxito.</div>
        
        <?php } ?>
        
        <div>
            <h3>Listado de categorías</h3>
            <table style="width:90%;padding:5px;border:1px solid #cccccc">
                <tr>
                    <th style="background-color:#cccccc;padding:5px;">id</th>
                    <th style="width:90%;background-color:#cccccc;padding:5px;">categoría</th>
                    <th style="background-color:#cccccc;padding:5px;width:10%"></th>
                </tr>
                <?php foreach ($arrCategorias as $categoria) { ?>
                <tr>
                    <td style="padding:5px;"><?php echo $categoria['idCategoria']; ?></td>
                    <td style="padding:5px;"><?php echo $categoria['valor']; ?></td>
                    <td style="padding:5px;"><a href="categorias.php?id=<?php echo $categoria['idCategoria']; ?>">Editar</a> - <a href="categorias.php?del=<?php echo $categoria['idCategoria'] ?>">Borrar</a>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <?php if ( empty($_GET['id']) ) { ?>
            <div>
                <h3 id="add">Agregar nueva categoría</h3>
                <?php if (!empty($error)) { ?>
                    <ul>
                    <?php foreach ($error as $mensaje) { ?>
                        <li><?php echo $mensaje ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <form action="categorias.php" method="post">
                
                    <p>
                        <label for="nombre">Nombre de la categoría</label><br />
                        <input name="nombre" type="text" value="" />
                    </p>
                    <p>
                        <input name="submit" type="submit" value="Agregar" />
                    </p>
                </form>
            </div>
        <?php } ?>
        
        <?php if ( !empty($_GET['id']) ) { ?>
            <div style="background-color:#ff8800;padding:5px; margin-top:10px;">
                <h3 id="add">Editar categoría</h3>
                <?php if (!empty($error)) { ?>
                    <ul>
                    <?php foreach ($error as $mensaje) { ?>
                        <li><?php echo $mensaje ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
                <form action="categorias.php" method="post">
                    <p>
                        <label for="nombre">Nombre de la categoría</label><br />
                        <input name="nombre" type="text" value="<?php echo $row['valor']; ?>" />
                    </p>
                    <p>
                        <input name="idCategoria" type="hidden" value="<?php echo $row['idCategoria']; ?>" />
                        <input name="submitEdit" type="submit" value="Editar" />
                    </p>
                </form>
            </div>
        <?php } ?>
        
    </body>
</html>
