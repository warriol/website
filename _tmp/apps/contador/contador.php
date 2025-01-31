 <?php
ob_start();
session_start();

// cargo el archivo de configuracion
include('config/config.php');

header("Content-type: text/javascript");

// url = pptls
// app = 250895068282603
if (isset($_GET['url']) && isset($_GET['app'])){

	// Obtenemos, y validamos enlace actual
	$enlace = $_GET['url'];

	if (!$enlace || $enlace == '') {
		die();
	}

	// Obtenemos los datos de la base de datos
	$res = $wda->contador($enlace);
	
	if ($res != "error"){

		extract($res);
	
		/*creamos los codigos querys verificando primero las cookies, para contar visitas y no impresiones web*/
		if (isset($_COOKIE[md5($enlace)])) {
			// si existe la cookie solo le damos el valor a $visitas
			// $visitas = $visitas;
			echo "document.write($visitas);";
		} elseif (!isset($_COOKIE[md5($enlace)])) {
			// Comprobamos si el enlace ya esta en la base de datos
			// $rows = mysqli_num_rows($query);
			if ($visitas > 0) {
				// Cuando exista lo enlace actualizamos
				$res = $wda->contadorActualizar($enlace, $visitas+1);
				
				echo "document.write($visitas);";

			} elseif ($visitas == 0) {
				$res = $wda->contadorInsertar($enlace, 1);
				echo "document.write(1);";
			}
		}
	
	}
	mysqli_close($con);
}else{
	echo "document.write('err');";
}
// Por ultimo cerramos la conexion, y cerramos el script
ob_end_flush();
die();
?>