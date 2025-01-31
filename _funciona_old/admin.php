<?php
	session_start();
	include('config/config.php');

	// variable global con el correo de administrador
	$_SERVER['SERVER_ADMIN'] = "warriol@gmail.com";
	$_SERVER['PREFIJO_ADMIN']= "";
	
	// si se inicio sesion la variable global loggedin esta iniciada
	if (isset($_SESSION['loggedin'])) {
		$now = time();
		// verificamos si la sesion expiró
		if($now > $_SESSION['expire']) {
			if($_SESSION['loginFB']){
				$user=null;
				unset($user);
			}
			session_destroy();
			header("Location: error.php");
		}else{
			$_SESSION['expire'] = $_SESSION['expire'] + (30 * 60);
			$_SERVER['PREFIJO_ADMIN']= "-inicio";
			// header("Location: admin.php");
		}
	}
	// inicio de sesion
	if(isset($_POST['btn-entrar']))
	{
		// $wda->debug($_POST['correo-usuario'], $_POST['pass']);
		// $wda->debug($_POST['correo-usuario'], "hola");
		$username = $_POST['correo_usuario'];
		$password = htmlspecialchars($_POST['pass']);
		// $password = password_hash($password, PASSWORD_DEFAULT);
		$res = $wda->iniSesion($username);
		if ($res != "error") { // isArray
			extract($res);
			$password = hash('sha256', $password);
			if ($password == $users_pass) {
				$_SESSION['loggedin'] 	= true;
				$_SESSION['username'] 	= $users_alias;
				$_SESSION['start'] 		= time();
				$_SESSION['expire'] 	= $_SESSION['start'] + (30 * 60);
				$_SESSION['id'] 		= $users_id;
				$_SESSION['nombre'] 	= $users_nombre. ' ' .$users_apellido;
				$_SESSION['idestado'] 	= $users_estado_id;
				$_SESSION['imagen'] 	= $users_icono;
				// $wda->debug($_SESSION['username'], "entro: ".$_SESSION['start']);
				header("Location: admin.php");
			}else{
				$wda->debug('Error: ', "correo correcto, contraseña mal. ".$password.' - '.$users_pass);
				header("Location: admin.php?errorup&c=f"); // correo ok pas no
			}
		}else{
			// $wda->debug('Error: ', "correo mal");
			header("Location: admin.php?errorup&c=n"); // correo no
		}
	}
	
	// registro de usuario
	if(isset($_POST['btn-registrar']))
	{
		$val = $_POST['r_correo'];
		$res = $wda->existeCorreo($val);
		// $wda->debug($_POST['r_correo'],$res);
		if($res == 'si'){
			header("Location: admin.php?errorexiste");
		}else{
			$username 	= $_POST['r_correo'];
			$password 	= $_POST['r_pass'];
			$password1 	= $_POST['r_pass1'];
			if($password != $password1){
				header("Location: admin.php?passno");
			}else{
				$estado 	= 3;
				$foto 		= 'sin-imagen.jpg';
				// $password = password_hash($password, PASSWORD_DEFAULT);
				$password = hash('sha256', $password);
				// $wda->debug("index_btn-registrar: p, h: ".$password, $_POST['r_pass']);
				if ($wda->registrarU($username,$password,$estado,$foto))
				{
					header("Location: admin.php?inserted");
				}else{
					header("Location: admin.php?failure");
				}
			}
		}
		return $res;
	}

?>

<!DOCTYPE html>
<html>

    <head>
		<?php
    		include('app/header-meta.tpl'); // no links
			include('app/header-links.tpl'); // echo
        ?>
    </head>
    
    <body>
    
    	<div class="body">
        	<?php
					include('app/body-header-admin'.$_SERVER['PREFIJO_ADMIN'].'.tpl');
			?>
            <div role="main" class="main">
				<?php
                    include('app/body-admin'.$_SERVER['PREFIJO_ADMIN'].'.tpl'); // echo
                ?>
            </div>
        	<?php
				include('app/body-footer.tpl'); // hecho
			?>
        </div>
        <?php
			include('app/body-scripts.tpl'); // echo
			include('app/body-scripts-index.tpl'); // echo
		?>
    </body>
</html>