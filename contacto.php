<?php
    ini_set( 'display_errors', 1 );
	session_start();
	include('config/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
		<?php
    		include('app/header-meta-contacto.tpl'); // no links
			include('app/header-links.tpl'); // echo
        ?>
    </head>
    <body>
    	<div class="body">
        	<?php
				include('app/body-header.tpl'); // hecho
			?>
            <div role="main" class="main">
				<?php
                    include('app/body-form-contacto.tpl'); // echo
                ?>
            </div>
        	<?php
				include('app/body-footer.tpl'); // hecho
			?>
        </div>
        <?php
			include('app/body-scripts.tpl'); // echo
			include('app/body-scripts-contacto.tpl'); // echo
		?>
    </body>
</html>