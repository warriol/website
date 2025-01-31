<?php

/**
 * @name Ejemplo de detección de proxy
 * @copyright (c)2015 Intervia IT
 * @link http://intervia.com/doc/detectar-conexiones-desde-proxy-y-la-ip-real/
 * @license MIT http://opensource.org/licenses/MIT
 */

//Valida una IP para que coincida con 123.123.123.123
//No admite IPs parciales, por ejemplo 123.123 dará error
	function valida_ip($ip){
		$ip = preg_replace("/[^0-9 .]/i","",$ip);
		$divideip = explode(".", $ip);
		
		if (count($divideip) != 4) $ip = 0;
		$ip = sprintf("%u",ip2long($ip));
		if ($ip == 0){
			return false;
		}else{
			return true;
		}
	}
	
	//Detecta si una IP es restringida (no enrutable públicamente en Internet)
	function detecta_ip_restringida($ip){
		$restringida = 0;
		
		//Si la IP tras un proxy es restringida, activa un marcador
		//Estos rangos no sirven para uso público
		//http://en.wikipedia.org/wiki/Reserved_IP_addresses
		
		$ipl = sprintf("%u",ip2long($ip));
		if (substr($ip, 0, 2) == '0.') $restringida = 1; //0.0.0.0/8
		if ($ipl >= 167772160 && $ipl <= 184549375) $restringida = 1; //10.0.0.0/8
		if ($ipl >= 1681915904 && $ipl <= 1686110207) $restringida = 1;//100.64.0.0/10
		if ($ipl >= 2130706432 && $ipl <= 2147483647) $restringida = 1;//127.0.0.0/8
		if ($ipl >= 2851995648 && $ipl <= 2852061183) $restringida = 1;//169.254.0.0/16
		if ($ipl >= 2886729728 && $ipl <= 2887778303) $restringida = 1;//172.16.0.0/12
		if ($ipl >= 3221225472 && $ipl <= 3221225479) $restringida = 1;//192.0.0.0/29
		if ($ipl >= 3221225984 && $ipl <= 3221226239) $restringida = 1;//192.0.2.0/24
		if ($ipl >= 3227017984 && $ipl <= 3227018239) $restringida = 1;//192.88.99.0/24
		if ($ipl >= 3232235520 && $ipl <= 3232301055) $restringida = 1;//192.168.0.0/16
		if ($ipl >= 3323068416 && $ipl <= 3323199487) $restringida = 1;//198.18.0.0/15
		if ($ipl >= 3325256704 && $ipl <= 3325256959) $restringida = 1;//198.51.100.0/24
		if ($ipl >= 3405803776 && $ipl <= 3405804031) $restringida = 1;//203.0.113.0/24
		if ($ipl >= 3758096384 && $ipl <= 4026531839) $restringida = 1;//224.0.0.0/4
		if ($ipl >= 4026531840 && $ipl <= 4294967294) $restringida = 1;//240.0.0.0/4
		if ($ip == '255.255.255.255') $restringida = 1; //255.255.255.255/32
		
		return $restringida;
	
	}
	
	//Función para detectar IPs y proxys
	//Necesita las funciones: 
	//detecta_ip_restringida y valida_ip
	function detecta_ip(){
		$host_proxy = "";
		$ip_proxy = "";
	
		//Carga la IP pública (declarada)
		$ip = $_SERVER['REMOTE_ADDR'];
		
		//Por defecto no hay proxy, inicializo array
		$proxy = array();
		
		/*
		* Normalmente sólo se declara un tipo de proxy y una IP
		* La deteccion va del tipo menos probable al más probable
		* Sólo se guarda una IP de proxy en $ip_proxy, pero se carga
		* un array con (tipo|restringida|ip) para separar con explode
		* que puede usarse para comprobar si hay más de un proxy declarado
		* en la misma conexión. En esos casos seguramente sean todas falsas.
		* tipo: (nombre del proxy detectado)
		* restringida: 0=Ip rutable en Internet, 1=IP NO rutable en Internet
		* ip: La IP declarada por el proxy
		*/
		
		//Detecta Proxy tipo HTTP_VIA
		if (!empty($_SERVER['HTTP_VIA'])){
			$r = detecta_ip_restringida($_SERVER['HTTP_VIA']);
			$ip_proxy = $_SERVER['HTTP_VIA'];
			if ($ip == $ip_proxy) $ip_proxy = '';
			$proxy[] = 'HTTP_VIA|'.$r.'|'.$ip_proxy;
		}
		
		//Detecta si hay Proxy tipo HTTP_X_FORWARDED_FOR
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$r = detecta_ip_restringida($_SERVER['HTTP_X_FORWARDED_FOR']);
			$ip_proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if ($ip == $ip_proxy) $ip_proxy = '';
			$proxy[] = 'HTTP_X_FORWARDED_FOR|'.$r.'|'.$ip_proxy;
		}
		
		//Detecta si hay Proxy tipo HTTP_CLIENT_IP
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$r = detecta_ip_restringida($_SERVER['HTTP_CLIENT_IP']); 
			$ip_proxy = $_SERVER['HTTP_CLIENT_IP'];
			if ($ip == $ip_proxy) $ip_proxy = '';
			$proxy[] = 'HTTP_CLIENT_IP|'.$r.'|'.$ip_proxy;
		}
		
		//Si la IP no es válida porque un proxy declaró algo erróneo 
		//deja la IP declarada en REMOTE_ADDR y vacía la del proxy
		if (valida_ip($ip) == false){
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		if (valida_ip($ip_proxy) == false){
			$ip_proxy = '';
		}
		
		//Comprueba si la IP del proxy es restringida
		$restringida = detecta_ip_restringida($ip_proxy);
		
		//Obtiene los nombres de host
		$host = gethostbyaddr($ip);
		if ($ip_proxy && !$restringida) $host_proxy = gethostbyaddr($ip_proxy);
		//Obtiene el user_agent
		$ua = trim($_SERVER['HTTP_USER_AGENT'],'\'');
		
		//Si el UA o host contienen uno de los nombres de redes anónimas, es un proxy
		if (stristr($ua,'Anonymouse')) $proxy[] = 'Anonymouse||';
		if (stristr($host,'tor')) $proxy[] = 'Tor||';
		if (stristr($host,'Anonymizer')) $proxy[] = 'Anonymizer||';
		if (stristr($host,'anonymous')) $proxy[] = 'Anonymous||';
		if (stristr($host,'anonine')) $proxy[] = 'Anonine||';
		
		//Devuelve el array con los datos
		return array($ip,$ip_proxy,$proxy,$restringida,$host,$host_proxy);
	}

?>