<?php
	/*
	*
	* acerca de
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
    		include('app/header-meta-blog.tpl'); // no links
			
			include('app/header-links-blog.tpl'); // echo
        ?>
    </head>
    
    <body>
    
    	<div class="body">
        
        	<?php
				include('app/body-header.tpl'); // hecho
			?>
        	
            <div role="main" class="main">
            
				<?php
                    // include('app/body-blog.tpl'); // echo
					include('app/body-blog.tpl');
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