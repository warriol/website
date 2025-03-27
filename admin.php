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