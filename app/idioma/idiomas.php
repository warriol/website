<?php

	function __($str, $lang = null){

		if ( $lang != null ){

			if ( file_exists('app/idioma/idioma-'.$lang.'.php') ){

				include('idioma-'.$lang.'.php');
				
				if ( isset($texts[$str]) ){
					
					$str = $texts[$str];
					
				}
			}else{
				return 'no existe';
			}
		}

		return $str;
	}

?>