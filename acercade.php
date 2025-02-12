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