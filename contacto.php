<?php
	session_start();
	include('config/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contacto</title>
		<?php
    		include('app/header-meta.tpl'); // no links
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
			include('app/body-scripts-index.tpl'); // echo
		?>
        <!-- Specific Page Vendor and Views -->
        <script src="app/js/views/view.contact.js"></script>
    </body>
</html>