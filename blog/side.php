<?php
	if ( !empty($_GET['salir']) ) {
		session_unset();
		session_destroy();
	}
	if ( !empty( $_SESSION['usuario'] ) && !empty($_SESSION['password']) ) {
		$arrUsuario = $wda->esUsuario( $_SESSION['usuario'], $_SESSION['password'] );		
	}
	$arrNoticias  = $wda->dameNoticiasPub();
?>


		<?php if ( !empty($_GET['registro']) ) { ?>
        	<div>El registro ha sido exitoso.</div>
        <?php } ?>
        
        <?php if ( !isset($arrUsuario['usuario']) ) { ?>
            <ul>
                <li><a href="<?= $_URLBASE_ . 'blog/' ?>ingresar.php">Iniciar sesión</a></li>
                <li><a href="<?= $_URLBASE_ . 'blog/' ?>registrar.php">Regístrate gratis</a></li>
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

