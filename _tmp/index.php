<?php
	/*
	*
	* inicio
	*
	*/
	
	session_start();
	
	// cargo el archivo de configuracion
	include('config/config.php');
?>

<!DOCTYPE html>
<html>

    <head>
		<?php
    		include('app/header-meta.tpl'); // no links
			
			include('app/header-links.tpl'); // echo
			
			include('apps/py/py.php'); // echo
        ?>

    </head>
    
    <body>
    
    	<div class="body">
        
        	<?php
				include('app/body-header.tpl'); // hecho
			?>
        	
            <div role="main" class="main">
            
				<?php
                    include('app/body-slider.tpl'); // echo
					
					include('app/body-seccion-ofrecemos.tpl'); // echo
					
					// include('app/body-portafolio.tpl'); // echo
					
					include('app/body-datos.tpl'); // hecho
					
					include('app/body-contenidoresaltable.tpl'); // echo
					
					include('app/body-mensajes.tpl'); // hecho
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