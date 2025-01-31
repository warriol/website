<?php
    error_reporting(E_ALL);

    ini_set('ignore_repeated_errors', true);
    ini_set('display_errors', true);
    ini_set('log_errors', true);
    ini_set("error_log", "./php-error.log");

    include_once 'autoload.php';

	session_start();

    if (!isset($_SESSION['iniciado'])) {
        $_SESSION['iniciado'] = false;
    }

    if (isset($_GET['cerrar'])) {
        session_destroy();
        header('Location: index.php');
    }

    if ($_SESSION['iniciado']) {
        $inicio = AuthService::getInstance('.env');
        $_SESSION['nombre'] = $inicio->getEmail();
        $inicio->iniciarSesionAPI();
        $inicio->debug("Index", "Sesión activa: " . $_SESSION['iniciado'] . ' - nombre: ' .$_SESSION['nombre'] );
    } else {
        $publico = ControladorPublico::getInstance('.env');
        $_SESSION['nombre'] = $publico->getSesionName();
        $publico->mostrarFrmLogin();
        $publico->debug("Index", "No hay sesión activa.");
    }
?>
<!DOCTYPE html>
<html>
    <head>
		<?php
    		include('app/header-meta.tpl');
			include('app/header-links.tpl');
        ?>
    </head>
    <body>
    	<div class="body">
        	<?php
				include('app/body-header.tpl');
			?>
            <div role="main" class="main">
				<?php
                    include('app/body-slider.tpl');
					include('app/body-seccion-ofrecemos.tpl');
					include('app/body-datos.tpl');
					include('app/body-contenidoresaltable.tpl');
					include('app/body-mensajes.tpl');
                ?>
            </div>
        	<?php
				include('app/body-footer.tpl');
			?>
        </div>
        <?php
			include('app/body-scripts.tpl');
			include('app/body-scripts-index.tpl');
		?>
    </body>
</html>