    <?php
     
    // archivos necesarios
    require_once 'config/config.php';
          
    // si se envio el formulario
    if ( !empty($_POST['submit']) ) {
     
		// definimos las variables
		if ( !empty($_POST['usuario']) )     	$usuario     			= $_POST['usuario'];
		if ( !empty($_POST['password']) )    	$password     			= $_POST['password'];
		if ( !empty($_POST['re-password']) )	$rePassword 			= $_POST['re-password'];
		if ( !empty($_POST['email']) )        	$email        			= $_POST['email'];
		 
		// completamos la variable error si es necesario
		if ( empty($usuario) )     				$error['usuario']       = "Es obligatorio completar el nombre de usuario";
		if ( empty($password) ) 				$error['password']      = "Es obligatorio completar la contraseña";
		if ( empty($email) )    				$error['email']			= "Es obligatorio completar el email";
		
		if ( $_POST['password'] != $_POST['re-password'] ) {
												$error['re-password'] 	= "La contraseña no coincide";
		}
		 
		// si no hay errores registramos al usuario
		if ( empty($error) ) {
		 
			// inserto los datos de registro en la db
			$wda->registrarU($usuario, md5($password), $email);
		 
			header( 'Location: ./index.php?registro=true' );
			die;
			 
		}
     
    }
     
	 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 /////////////////////////////////////////////////////	 http://www.elwebmaster.com/editorial/taller-de-php-nuestro-blog-registro-de-usuario
    ?>


<!DOCTYPE html>
<html xmlns=”http://www.w3.org/1999/xhtml”>
    <head>
        <meta charset="utf-8">
        <title>Blog wda - registro</title>
    </head>
     
    <body>
     
        <h1>Registro de Usuario</h1>
         
        <?php if (!empty($error)) { ?>
        <ul>
			<?php foreach ($error as $mensaje) { ?>
            	<li><?php echo $mensaje ?></li>
            <?php } ?>
        </ul>
        <?php } ?>
         
        <form action="registrar.php" method="post">
	
            <p>
                <label for="usuario">Nombre de usuario</label><br />
                <input name="usuario" type="text" value="<?php if ( ! empty($usuario) ) echo $usuario; ?>" />
            </p>
            <p>
                <label for="password">Contraseña</label><br />
                <input name="password" type="password" value="<?php if ( ! empty($password) ) echo $password; ?>" />
            </p>
            <p>
                <label for="re-password">Repetir Contraseña</label><br />
                <input name="re-password" type="password" value="<?php if ( ! empty($rePassword) ) echo $rePassword; ?>" />
            </p>
            <p>
                <label for="email">Correo Electrónico</label><br />
                <input name="email" type="text" value="<?php if ( ! empty($email) ) echo $email; ?>" />
            </p>
            <p>
                <input name="submit" type="submit" value="Regístrate" />
            </p>
         
        </form>
     
    </body>
</html>