<?php

class wda
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function debug($var, $val = '-'){
		$file = fopen("./debug/archivo.txt", "a");

		$texto = '['.date("Y-m-d H:i:s").']::['.$var.']:-> ['.$val.']';
		
		fwrite($file, $texto . PHP_EOL);

		fclose($file);
	}
	
	public function contador($url)
	{
		$stmt = $this->db->prepare("SELECT visitas FROM megusta WHERE url=:id");
		$stmt->bindparam(":id",$url);
		$stmt->execute();
        
        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records === 1) {
    		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
    		return $editRow;
        }else{
            return "error";
        }
   	}
	
	public function contadorInsertar($url, $n)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO megusta (url,visitas) VALUES (:id, :n)");
			$stmt->bindparam(":n",$n);
			$stmt->bindparam(":id",$url);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			$this->debug("-------crear--------");
			$this->debug($e);
			return false;
		}
   	}
	
	public function contadorActualizar($url, $visitas)
	{
		try{
			$stmt = $this->db->prepare("UPDATE megusta SET visitas=:visitas WHERE url=:id");
			$stmt->bindparam(":visitas",$visitas);
			$stmt->bindparam(":id",$url);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
   	}
	
	public function iniSesion($u)
	{
		$stmt = $this->db->prepare("SELECT * FROM users WHERE users_correo=:id");
		$stmt->bindparam(":id",$u);
		$stmt->execute();
        
        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records === 1) {
    		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
    		return $editRow;
        }else{
            return "error";
        }
   	}

    public function existeCorreo($val)
    {
		$stmt = $this->db->prepare("SELECT users_correo FROM users WHERE users_correo=:id");
		$stmt->bindparam(":id",$val);
		$stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        
        if ($total_no_of_records === 1) {
    		return 'si';
        }else{
            return 'no';
        }
    }

	public function registrarU($correo,$password,$estado,$foto)
	{
		$aut = 1;
		
		try
		{
			$stmt = $this->db->prepare("INSERT INTO	users(
															users_estado_id,
															users_autent_nivel_id,
															users_correo,
															users_pass,
															users_icono
															) VALUES (:estado,:aut,:correo,:password,:foto)");
			$stmt->bindparam(":correo",$correo);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":estado",$estado);
			$stmt->bindparam(":foto",$foto);
			$stmt->bindparam(":aut",$aut);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			$this->debug("-------crear--------");
			$this->debug($e);
			return false;
		}
		
	}

	//-------------------------------------------------------------------------------------------------------------
		
	public function getCantidades($val)
    {
		$stmt = $this->db->prepare("SELECT idestado FROM users WHERE idestado=:id");
		$stmt->bindparam(":id",$val);
		$stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        return $total_no_of_records;
    }

	public function getCorreos()
    {
		$stmt = $this->db->prepare("SELECT * FROM correo WHERE leido IS NULL");
		$stmt->bindparam(":id",$val);
		$stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        return $total_no_of_records;
    }
	
	public function enviarCorreo($n, $c, $t, $m, $f)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO	correo (nombre, telefono, correo, fecha, comentario) VALUES (:n,:t,:c,:f,:m)");
			$stmt->bindparam(":n",$n);
			$stmt->bindparam(":t",$t);
			$stmt->bindparam(":c",$c);
			$stmt->bindparam(":f",$f);
			$stmt->bindparam(":m",$m);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			$this->debug("-------crear--------");
			$this->debug($e);
			return false;
		}
		
	}
	

	
	public function registrarUFB($correo,$password,$estado,$foto,$idempleado,$fname,$lname,$prov,$uid)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO	users(correo,pass,idestado,foto,idempleado,nombre,apellido,hybridauth_provider_name,hybridauth_provider_uid)
												VALUES (:correo,:password,:estado,:foto,:idempleado,:nombre,:apellido,:prov,:uid)");
			$stmt->bindparam(":correo",$correo);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":estado",$estado);
			$stmt->bindparam(":foto",$foto);
			$stmt->bindparam(":idempleado",$idempleado);
			$stmt->bindparam(":nombre",$fname);
			$stmt->bindparam(":apellido",$lname);
			$stmt->bindparam(":prov",$prov);
			$stmt->bindparam(":uid",$uid);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			$this->debug("-------crear--------");
			$this->debug($e);
			return false;
		}
		
	}
	
    public function dataviewU($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['nombre']); ?></td>
                <td><?php print($row['apellido']); ?></td>
                <td><?php print($row['correo']); ?></td>
                <td><?php print($row['telefono']); ?></td>
                <td><?php print($row['celular']); ?></td>
                <td><img src="./Imagenes/<?php print($row['foto']); ?>" width="32px" height="32px" alt="img" /></td>
                <td><?php print($row['domicilio']); ?></td>
                <td><?php print($this->getEstado($row['idestado'])); ?></td>
                </tr>
                <?php
                $_SESSION['id'] = $row['idusuario'];
                $_SESSION['nombre'] = $row['nombre']. ' ' .$row['apellido'];
			}
		}
		else
		{
			?>
            <tr>
            <td colspan="12">Vac&iacute;a</td>
            </tr>
            <?php
		}
		
	}
    
	public function getEstado($id)
	{
		$stmt = $this->db->prepare("SELECT estado FROM estado WHERE idestado=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['estado'];
	}

	public function update($fname,$lname,$email,$telefono,$celular,$domicilio,$foto)
	{
	   $this->debug("crud-update: ", $directorio." ".$fname." ".$lname." ".$email." ".$telefono." ".$celular." ".$domicilio." ".$foto);
		try
		{
			$stmt=$this->db->prepare("UPDATE users SET nombre=:fname, 
		                                               apellido=:lname, 
													   telefono=:telefono,
													   celular=:celular,
													   domicilio=:domicilio,
													   foto=:foto
													WHERE correo=:correo");
			$stmt->bindparam(":domicilio",$domicilio);
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":telefono",$telefono);
			$stmt->bindparam(":celular",$celular);
			$stmt->bindparam(":foto",$foto);
			$stmt->bindparam(":correo",$email);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
	}

	public function updatePerfil($fname,$lname,$email,$telefono,$celular,$domicilio,$foto)
	{
	   // $this->debug("crud-update: ", $directorio." ".$fname." ".$lname." ".$email." ".$telefono." ".$celular." ".$domicilio." ".$foto);
		try
		{
			$stmt=$this->db->prepare("UPDATE users SET nombre=:fname, 
		                                               apellido=:lname, 
													   telefono=:telefono,
													   celular=:celular,
													   domicilio=:domicilio,
													   foto=:foto
													WHERE correo=:correo");
			$stmt->bindparam(":domicilio",$domicilio);
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":telefono",$telefono);
			$stmt->bindparam(":celular",$celular);
			$stmt->bindparam(":foto",$foto);
			$stmt->bindparam(":correo",$email);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
	}

	public function leerCorreo($id)
	{
		// $this->debug("crud - l:230 - leercorreo: ", $id);
		$v = 1;
		try
		{
			$stmt=$this->db->prepare("UPDATE correo SET leido=:l
													WHERE idcorreo=:id");
			$stmt->bindparam(":l",$v);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
	}
	
	public function eliminarCorreo($id)
	{
		$stmt = $this->db->prepare("DELETE FROM correo WHERE idcorreo=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	public function updatePass($email,$passr)
	{
	   // $this->debug("crud-update: ", $directorio." ".$fname." ".$lname." ".$email." ".$telefono." ".$celular." ".$domicilio." ".$foto);
		try
		{
			$stmt=$this->db->prepare("UPDATE users SET pass=:passr
													WHERE correo=:correo");
			$stmt->bindparam(":passr",$passr);
			$stmt->bindparam(":correo",$email);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
	}
	
	public function getID($id, $tmp)
	{
        $tbl = ($tmp != "e") ? "users" : "empleados";
        $campo = ($tmp != "e") ? "idusuario" : "idempleado";
		$stmt = $this->db->prepare("SELECT * FROM $tbl WHERE $campo=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function getUsuario($id)
	{
		$stmt = $this->db->prepare("SELECT nombre, apellido FROM users WHERE idusuario=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['nombre'].' '.$editRow['apellido'];
	}
	
    public function getEmpleado($id)
	{
		$stmt = $this->db->prepare("SELECT nombre, apellido FROM empleados WHERE idempleado=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['nombre'].' '.$editRow['apellido'];
	}
	
    public function getDepartamento($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM departamento WHERE iddepartamento=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['departamento'];
	}
	
    public function getBarrio($id)
	{
        // $acentos = $db->query("SET NAMES 'utf8'");
		$stmt = $this->db->prepare("SELECT * FROM barrio WHERE idbarrio=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['barrio'];
	}
	
    public function getEInmueble($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM estadoinmueble WHERE idestadoinmueble=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['estadoinmueble'];
	}
	
    public function getTCasa($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM tipocasa WHERE idtipocasa=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['tipocasa'];
	}
	
    public function getTMoneda($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM moneda WHERE idmoneda=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['simbolo'];
	}
	
    public function getDirectorio($id)
	{
		$stmt = $this->db->prepare("SELECT directorio FROM imagenes WHERE idinmueble=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['directorio'];
	}
	
    // envio la lisat de departamento para mostrar en e formulario de ingreso de inmueble    
    public function getSelectDepartamento($id=1000000000001)
    {
		$stmt = $this->db->prepare("SELECT * FROM departamento ORDER BY departamento asc");
		$stmt->execute();
		?>
            <select class="form-control selectpicker" id="iddepartamento" name="iddepartamento" onchange="load(this.value)">
            	<option value="0">Elegir</option>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){
/*
            if($id==1000000000001){
    	    	if($Row['departamento'] == "Montevideo"){
    	    		echo '<option selected="selected" value="'.$Row['iddepartamento'].'">'.utf8_encode($Row['departamento']).'</option>';
    	    	}else{
    	    		echo '<option value="'.$Row['iddepartamento'].'">'.utf8_encode($Row['departamento']).'</option>';	    		
    	    	}
            }else{
*/
                if($Row['iddepartamento']==$id){
                    echo '<option selected="selected" value="'.$Row['iddepartamento'].'">'.utf8_encode($Row['departamento']).'</option>';
                }else{
                    echo '<option value="'.$Row['iddepartamento'].'">'.utf8_encode($Row['departamento']).'</option>';
                }
//            }
	    } 

	    ?>
	    	</select>
	    <?php
        
    }
	
    // envio la lisat de barrio para mostrar en e formulario de ingreso de inmueble    
    public function getSelectBarrio($id=1000000000001)
    {
		$stmt = $this->db->prepare("SELECT * FROM barrio ORDER BY barrio asc");
		$stmt->execute();
		?>
            <select class="form-control selectpicker" id="idbarrio" name="idbarrio">
            	<option value="0">Elegir</option>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            if($Row['idbarrio']==$id){
                echo '<option selected="selected" value="'.$Row['idbarrio'].'">'.utf8_encode($Row['barrio']).'</option>';	    		
            }else{
                echo '<option value="'.$Row['idbarrio'].'">'.utf8_encode($Row['barrio']).'</option>';
            }
        } 
	    ?>
	    	</select>
	    <?php
        
    }
	
    // envio la lisat de tipo negocio para mostrar en e formulario de ingreso de inmueble    
    public function getSelectTNegocio($id=1000000000001)
    {
		$stmt = $this->db->prepare("SELECT * FROM estadoinmueble");
		$stmt->execute();
		?>
            <select class="form-control selectpicker" id="idestadoinmueble" name="idestadoinmueble">
            	<option value="0">Elegir</option>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            if($Row['idestadoinmueble']==$id){
                echo '<option selected="selected" value="'.$Row['idestadoinmueble'].'">'.$Row['estadoinmueble'].'</option>';
            }else{
                echo '<option value="'.$Row['idestadoinmueble'].'">'.$Row['estadoinmueble'].'</option>';
            }	    		
	    } 

	    ?>
	    	</select>
	    <?php
        
    }
	
    // envio la lisat de tipo casa para mostrar en e formulario de ingreso de inmueble    
    public function getSelectTCasa($id=1000000000001)
    {
		$stmt = $this->db->prepare("SELECT * FROM tipocasa");
		$stmt->execute();
		?>
            <select class="form-control selectpicker" id="idtipocasa" name="idtipocasa">
            	<option value="0">Elegir</option>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            if($Row['idtipocasa'] == $id){
                echo '<option selected="selected" value="'.$Row['idtipocasa'].'">'.$Row['tipocasa'].'</option>';
            }else{
                echo '<option value="'.$Row['idtipocasa'].'">'.$Row['tipocasa'].'</option>';
            }	    		
	    } 

	    ?>
	    	</select>
	    <?php
        
    }
	
    // envio la lisat de moneda para mostrar en e formulario de ingreso de inmueble    
    public function getMoneda($id)
    {
		$stmt = $this->db->prepare("SELECT moneda FROM moneda WHERE idmoneda = $id");
		$stmt->execute();
		$Row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $Row['moneda'];
    }
	
    public function getDormitorio($id)
	{
		$stmt = $this->db->prepare("SELECT dormitorio FROM inmueble WHERE idinmueble=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow['dormitorio'];
	}
	
	public function getVideo($id)
	{
		$stmt = $this->db->prepare("SELECT video FROM video WHERE idinmueble=:id");
		$stmt->execute(array(":id"=>$id));
		
		$total_no_of_records = $stmt->rowCount();
		$Row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($total_no_of_records > 0)
		{
			return $Row['video'];
		}else{
			return false;
		}
	}
	
	// dame la vista de inmueble
	public function getVistaInmueble($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM inmueble WHERE idinmueble=:id");
		$stmt->execute(array(":id"=>$id));
		if($stmt->rowCount()>0){
			$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
			return $editRow;
		}else{
			return false;
		}
	}
	
	/* paging dataviewlistado-inmuebles */	
	public function dataViewListadoInmuebles($query, $r)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$izquierda = true;
	
		if($stmt->rowCount()>0)
		{

			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				
                $info  = '
							<div class="col-md-6">
								<div class="alert alert-info" role="alert">
								<h3 class="text-center">'.strtoupper($row['titulo']).'</h3>
								</div>
								<div class="input-group input-group-lg">
								  <span class="input-group-addon" id="sizing-addon1"><span class="flaticon-coin"></span></span>
								  <div class="form-control">Precio: '.$row['precio'].' '.$this->getMoneda(utf8_encode($row['idmoneda'])).'.</div>
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">Descripción</div>
								  <div class="panel-body">'.$row['descripcion'].'</div>
								</div>
								<hr />
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-offset-4">
								<a class="btn btn-primary" href="./ver.php?id='.$row['idinmueble'].'#buscadorInmueble">Ver detalles...<span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
								<br />
							</div>';
				$foto = '
							<div class="col-md-6">';

									$estructura =  './Imagenes/inmu/'.$row['idinmueble'];// $this->getDirectorio($row['idinmueble']);
									$filehandle = opendir($estructura);
									// $this->debug("linea 359: ", $filehandle);
									while ($file = readdir($filehandle)) {
										if ($file != "." && $file != "..") {
												$estructura .= '/'.$file;
											break;
										 }
									}
				$foto .= 	'	<a href="'.$estructura.'" data-lightbox="inmu-'.$row['idinmueble'].'">
									<img class="img-responsive" src="'.$estructura.'" height="300px" width="600px" alt="'.$file.'">
								</a>
								<div class="desc">
									<ul class="nav nav-pills" role="tablist">
									  <li role="presentation" class="active"><a href="#"><i class="glyphicon glyphicon-bed"></i> <span class="badge">'.$row['dormitorios'].'</span></a></li>
									  <li role="presentation" class="active"><a href="#"><i class="glyphicon flaticon-house"></i> <span class="badge">'.$row['superficie'].' m2</span></a></li>
									  <li role="presentation" class="active"><a href="#"><i class="glyphicon flaticon-garage"></i> <span class="badge">'.$row['garaje'].'</span></a></li>
									</ul>
								</div>
							</div>';
                    
                 ?>
                <!-- /.row -->
                <!-- Project One -->
                <div class="row" id="listadoInmuebles">
                	<?php
					if($izquierda){
						echo '<div class="media">';
						echo $foto;
						echo $info;
						echo '</div>';
						$izquierda = false;
					}else{
						echo $info;
						echo $foto;
						$izquierda = true;

					}
					?>
                </div>
                <!-- /.row -->
        
                <hr>
                <?php
			}
		}
		else
		{
			?>
            <div class="col-lg-12">Los parámetros de busqueda no arrojaron resultados.</div>
            <?php
		}
		
	}

	/* paging dataview-inicio-empleado */	
	public function dataviewInicioEmpleado($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{

			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['idinmueble']); ?></td>
                <td><?php print($this->getUsuario($row['idusuario'])); ?></td>
                <td><?php print(utf8_encode($this->getDepartamento($row['iddepartamento']))); ?></td>
                <td><?php print(utf8_encode($this->getBarrio($row['idbarrio']))); ?></td>
                <td><?php print($this->getEInmueble($row['idestadoinmueble'])); ?></td>
                <td><?php print($this->getTCasa($row['idtipocasa'])); ?></td>
                <td><?php print($row['precio']).',00 '.$this->getTMoneda($row['idmoneda']); ?></td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td colspan="12">Todav&iacute;a no ha ingresado inmuebles para administrar.</a></td>
            </tr>
            <?php
		}
		
	}
	/* paginado correo */
	public function dataviewCorreo($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{

			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
            <TBODY>
              <tr>
                <td width="31" rowspan="2"><?php print($row['idcorreo']); ?></td>
                <td><?php print($row['nombre']); ?></td>
                <td><?php print($row['telefono']); ?></td>
                <td><?php print($row['correo']); ?></td>
                <td><?php print($row['fecha']); ?></td>
                <td width="40">
                	<?php if ($row['leido'] == null){ ?>
                            <form action="correo.php" method="post">
                                <input type="hidden" name="idcorreoborrar" id="idcorreoborrar" value="<?php print($row['idcorreo']); ?>"></button>
                                <button type="submit"  name="btnidcorreoborrar" id="btnidcorreoborrar" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></button>
                            </form>
					<?php } elseif ($row['leido'] == 1){ ?>
                            <form action="correo.php" method="post">
                                <input type="hidden" name="idcorreoborrar" id="idcorreoborrar" value="<?php print($row['idcorreo']); ?>"></button>
                                <button type="submit"  name="btnidcorreoeliminar" id="btnidcorreoborrar" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
					<?php } ?>
                </td>
              </tr>
              <tr>
                <td colspan="5"><?php print($row['comentario']); ?></td>
              </tr>
           </TBODY>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td colspan="12">Todav&iacute;a no ha recibido correos.</td>
            </tr>
            <?php
		}
		
	}

	
	/* paging dataview-inicio-clientes */
	
	public function dataviewInicioClientes($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{

			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['idinmueble']); ?></td>
                <td><?php print($this->getEmpleado($row['idempleado'])); ?></td>
                <td><?php print(utf8_encode($this->getDepartamento($row['iddepartamento']))); ?></td>
                <td><?php print(utf8_encode($this->getBarrio($row['idbarrio']))); ?></td>
                <td><?php print($this->getEInmueble($row['idestadoinmueble'])); ?></td>
                <td><?php print($this->getTCasa($row['idtipocasa'])); ?></td>
                <td><?php print($row['precio']).',00 '.$this->getTMoneda($row['idmoneda']); ?></td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td colspan="12">Todav&iacute;a no ha ingresado inmuebles para administrar. Cont&aacute;cte nuestros <a href="./#information">Agentes.</a></td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>Primera</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Anterior</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Siguiente</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Ultima</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging dataview-inicio-clientes*/


// -----------------------------------------------------------------------------------------------------------------------
	public function createU($fname,$lname,$correo,$password,$telefono,$celular,$foto, $idestado)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO	empleados(correo,pass,nombre,apellido,telefono,celular,foto,idestado)
                                                      VALUES (:correo,:password,:fname,:lname,:telefono,:celular,:foto,:estado)");
			$stmt->bindparam(":correo",$correo);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":telefono",$telefono);
			$stmt->bindparam(":celular",$celular);
			$stmt->bindparam(":foto",$foto);
			$stmt->bindparam(":estado",$idestado);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
					// SQLSTATE[23000] correo repedito 
					// antes de enviar debo verificar que el correo ya no exista para eviatr que se cancele por dulicar clave
			// debug
			$this->debug("-------crear--------");
			$this->debug($e);
			return false;
		}
		
	}
    
	public function updateOld($id,$fname,$lname,$password,$telefono,$celular,$domicilio,$estado)
	{
		try
		{
            if($domicilio == "emp"){
			$stmt=$this->db->prepare("UPDATE empleados SET nombre=:fname, 
		                                               apellido=:lname, 
													   pass=:password,
													   telefono=:telefono,
													   celular=:celular,
													   idestado=:estado
													WHERE idempleado=:id");
            }else{
			$stmt=$this->db->prepare("UPDATE users SET nombre=:fname, 
		                                               apellido=:lname, 
													   pass=:password,
													   telefono=:telefono,
													   celular=:celular,
													   domicilio=:domicilio,
													   idestado=:estado
													WHERE idusuario=:id");
			$stmt->bindparam(":domicilio",$domicilio);
            }
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":password",$password);
			$stmt->bindparam(":telefono",$telefono);
			$stmt->bindparam(":celular",$celular);
			$stmt->bindparam(":estado",$estado);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			// debug
			$this->debug("-------actualizar--------");
			$this->debug($e);	
			return false;
		}
	}

	public function getImagen($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM imagenes WHERE idimagen=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	


	public function getSelectEstado()
	{
		$stmt = $this->db->prepare("SELECT * FROM estado ORDER BY estado asc");
		$stmt->execute();
		// $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		?>
			<select class="form-control" name="estado" required>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){

	        echo '<option value="'.$Row['idestado'].'">'.$Row['estado'].'</option>';

	    } 

	    ?>
	    	</select>
	    <?php
		// return $editRow;
	}

	public function getSelectIdEstado($idestado)
	{
		$stmt = $this->db->prepare("SELECT * FROM estado ORDER BY estado asc");
		$stmt->execute();
		$stmt->execute();
		// $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		?>
			<select class="form-control" name="estado" required>
		<?php
	    while ( $Row = $stmt->fetch(PDO::FETCH_ASSOC) ){

	    	if($Row['idestado'] == $idestado){
	    		echo '<option selected="selected" value="'.$Row['idestado'].'">'.$Row['estado'].'</option>';
	    	}else{
	    		echo '<option value="'.$Row['idestado'].'">'.$Row['estado'].'</option>';	    		
	    	}
	    } 

	    ?>
	    	</select>
	    <?php
		// return $editRow;
	}

	public function delete($id, $tbl)
	{
        $campo = ($tbl == "users") ? "idusuario" : "idempleado";
        
		$stmt = $this->db->prepare("DELETE FROM $tbl WHERE $campo=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
}
