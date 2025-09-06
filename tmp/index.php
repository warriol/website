<?php
    session_start();
    include('config/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inicio</title>
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
        <!-- Specific Page Vendor and Views -->
        <script src="app/js/views/view.home.js"></script>
    </body>
</html>