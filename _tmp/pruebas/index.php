
<?php
if(isset($_POST['nombre'])){
    // Varios destinatarios
    // $para  = 'aidan@example.com' . ', '; // atención a la coma
    $para = $_POST['correo'];
	$clean_para = "";
	
	if (filter_var($para,FILTER_VALIDATE_EMAIL)){
		$clean_para =  filter_var($para,FILTER_SANITIZE_EMAIL);
	} 
    // título
    $título = 'NO RESOPNDE - Mensaje automático...';
    
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
        </tr>
        <tr>
          <td>'.$_POST['nombre'].'</td><td>'.$clean_para.'</td>
        </tr>
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
    // $res = mail($para, $título, $mensaje, $cabeceras);
    
    $msj = "enviado";
    /*
    if (!$res) {
        $msj = error_get_last()['message'];
    }
	*/
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Prueba de correo</title>
    </head>
    <body>
        <p>Prueba de envio de correo.</p>
        <br>
        <form method="post" action="#">
            <label>Nombre</label><input type="text" name="nombre" />
            <label>Correo</label><input type="text" name="correo" />
            <p><?php if(isset($clean_para)){ echo $clean_para;} ?></p>
            <br><br>
            <input type="submit" value="Enviar">
        </form>
        <br>
        <p>
            <?php
                if(isset($msj)){
                    echo $msj;
                }else{
                    echo "enviar";
                }
            ?>
        </p>
    </body>
</html>