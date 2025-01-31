<?php

if(isset($_POST)){
    // Varios destinatarios
    // $para  = 'aidan@example.com' . ', '; // atención a la coma

    // título
    $título = 'Enviado desde mi sitio...';
    
    // mensaje
    $mensaje = '
    <html>
    <head>
      <title>Mensaje del webmaster</title>
    </head>
    <body>
      <p>¡Aviso Importante!</p>
      <table>
        <tr>
          <th>nombre</th><th>correo</th>
        </tr>';
			
	if($_POST)
	{
	foreach ($_POST as $clave=>$valor)
		{
		if ($clave == 'email'){
			$clean_para = "";
			$valort = $valor;
			if (filter_var($valort,FILTER_VALIDATE_EMAIL)){
				$clean_para =  filter_var($valort,FILTER_SANITIZE_EMAIL);
			}
			$valor = $clean_para;
		}
		$mensaje .= "<tr><td>$clave</td><td>$valor</td></tr>";
		}
	}
          
    $mensaje .= '
      </table>
    </body>
    </html>
    ';
    
    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    // Cabeceras adicionales
    $cabeceras .= 'To: '.$_POST['nombre'].' <'.$clean_para.'>' . "\r\n";
    $cabeceras .= 'From: Webmaster <admin@wilsonarriola.com>' . "\r\n";
    // $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
    // $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
    
    // Enviarlo
    $res = mail($para, $título, $mensaje, $cabeceras);

    if (!$res) {
        $msj = error_get_last();
		$res = $msj['message'];
    }
	header('Location: ../../contacto.php?enviado&res=' . $res);
}else{
	header('Location: ../../errores/index.php');
}
?>