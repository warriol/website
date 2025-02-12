<?php
	if($_SERVER["SERVER_NAME"] == "localhost"){
		$_URLBASE_ = "http://localhost/website/";
	}else{
		if (isset($_SERVER['HTTPS'])) {
			$URL_segura = "https://";
		}else{
			$URL_segura = "http://";
		}
		$_URLBASE_ = $URL_segura  . $_SERVER["SERVER_NAME"]. "/";
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