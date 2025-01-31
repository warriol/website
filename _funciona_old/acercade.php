<?php
	session_start();
	include('config/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
		<?php
    		include('app/header-meta-acercade.tpl'); // no links
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
                    include('app/body-time-line.tpl'); // echo
                ?>
            </div>
        	<?php
				include('app/body-footer.tpl'); // hecho
			?>
        </div>
        <?php
			include('app/body-scripts.tpl'); // echo
			include('app/body-scripts-acercade.tpl'); // echo
		?>
    </body>
    
</html>