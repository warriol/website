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