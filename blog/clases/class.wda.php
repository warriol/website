<?php
class wda
{
	private $db;
	
	function __construct($DB_con){
		$this->db = $DB_con;
	}

	public function debug($var, $val = '-'){
		$file = fopen("./archivo.txt", "a");

		$texto = '['.date("Y-m-d H:i:s").']::['.$var.']:-> ['.$val.']';
		
		fwrite($file, $texto . PHP_EOL);

		fclose($file);
	}
	
	///////////////////////////////////
	//				select
	///////////////////////////////////
	public function iniSesion($u){
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

	public function esUsuario ($usuario, $pass){
		// verifica que esten los dos campos completos.
		if ($usuario=='' || $pass=='') return false;
		
		// busqueda de los datos de usuarios para loguear.
		$query = "SELECT idUsuario, usuario, password, tipo FROM usuarios WHERE usuario =:u";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":u",$usuario);
		$stmt->execute();
		
        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records === 1) {
    		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			// verifica que el pass enviado sea igual al pass de la db.
			if ( $row['password'] == $pass ) {
    			return $row;
			} else return false;

        }else return false;				
	}

    public function existeCorreo($val){
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
	
	public function dameNoticiasPub(){
		$f = date('Y-m-d H:i:s');
		$query = "SELECT idNoticia, titulo, copete FROM noticias WHERE fPublicacion < :f ORDER BY fPublicacion DESC";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":f",$f);
		$stmt->execute();
		$arrNoticias = array();
		while ( $rowN = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			array_push( $arrNoticias,$rowN );
		}
   		return $arrNoticias;
	}
	
	public function dameNoticias(){
		$query = "SELECT idNoticia, titulo FROM noticias ORDER BY idNoticia DESC";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$arrNoticias = array();
		while ( $rowN = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			array_push( $arrNoticias,$rowN );
		}

   		return $arrNoticias;
	}

	public function dameCatTodas(){
		$query = "SELECT idCategoria, valor FROM categorias ORDER BY valor ASC";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
   		$arrCategorias = array();
		while ($rowT = $stmt->fetch(PDO::FETCH_ASSOC)) {
			array_push( $arrCategorias, $rowT );
		}
		return $arrCategorias;
	}
	
	public function dameCatUna($id){
		$query = "SELECT idCategoria, valor FROM categorias WHERE idCategoria = :id}";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
   		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function dameNoticiaUna($id){
		$query = "SELECT idNoticia, titulo, copete, cuerpo, idCategoria, fPublicacion FROM noticias WHERE idNoticia = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
   		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function dameNoticia($id){
		$query = "SELECT noticias.idNoticia, noticias.titulo, noticias.copete, noticias.cuerpo, categorias.valor as categoria, usuarios.usuario 
		FROM noticias 
		INNER JOIN categorias ON categorias.idCategoria = noticias.idCategoria 
		INNER JOIN usuarios ON usuarios.idUsuario = noticias.idUsuario 
		WHERE noticias.idNoticia = :id LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
   		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function dameComentariosId($id){
		$query = "SELECT comentarios.idComentario, comentarios.comentario, usuarios.usuario  
		FROM comentarios 
		INNER JOIN usuarios ON comentarios.idUsuario = usuarios.idUsuario 
		WHERE comentarios.estado = 'apto' AND comentarios.idNoticia = :id 
		ORDER BY comentarios.idComentario DESC";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$arrComentarios= array();
		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			array_push( $arrComentarios, $row );
		}

   		return $arrComentarios;
	}
	
	public function dameComentarios($d){
		$query = "SELECT comentarios.idComentario, comentarios.comentario, comentarios.idNoticia, usuarios.usuario, noticias.titulo  
			FROM comentarios 
			INNER JOIN usuarios ON comentarios.idUsuario = usuarios.idUsuario 
			INNER JOIN noticias ON comentarios.idNoticia = noticias.idNoticia 
			WHERE comentarios.estado = :d 
			ORDER BY comentarios.idComentario ASC";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":d",$d);
		$stmt->execute();
		$arrComentarios = array();
		while ( $rowC = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			array_push( $arrComentarios,$rowC );
		}

   		return $arrComentarios;
	}
	
	public function dameComentarioUno($id){
		$query = "SELECT idComentario, comentario FROM comentarios WHERE idComentario = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
   		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	///////////////////////////////////
	//				delete
	///////////////////////////////////
	public function borrarCat($id){
		$query  = "DELETE FROM categorias WHERE idCategoria =:id";

		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}

	public function borrarNoticias($id){
		$query  = "DELETE FROM noticias WHERE idNoticia = :id";

		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}
	
	public function borrarComentario($id){
		$query  = "DELETE FROM comentarios WHERE idComentario = :id";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}
	
	///////////////////////////////////
	//				insert
	///////////////////////////////////
	public function registrarU($u,$p,$c){
		try
		{
			$stmt = $this->db->prepare("INSERT INTO	usuarios (usuario,password,email) VALUES (:u,:p,:c)");
			$stmt->bindparam(":u",$u);
			$stmt->bindparam(":p",$p);
			$stmt->bindparam(":c",$c);
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

	public function guardarCat($n){
		$query  = "INSERT INTO categorias (valor) VALUES (:n)";

		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":n",$n);
		$stmt->execute();
		
		return true;
	}

	public function agregarNoticia($titulo,$copete,$cuerpo,$idCategoria,$idUsuario,$fCreacion,$fModificacion,$fPublicacion) {
		$query  = "INSERT INTO noticias (titulo,copete,cuerpo,idCategoria,idUsuario,fCreacion,fModificacion,fPublicacion) 
					VALUES (:titulo, :copete, :cuerpo, :idCategoria, :idUsuario, :fCreacion, :fModificacion, :fPublicacion)";
					
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":titulo",$titulo);
		$stmt->bindparam(":copete",$copete);
		$stmt->bindparam(":cuerpo",$cuerpo);
		$stmt->bindparam(":idCategoria",$idCategoria);
		$stmt->bindparam(":idUsuario",$idUsuario);
		$stmt->bindparam(":fCreacion",$fCreacion);
		$stmt->bindparam(":fModificacion",$fModificacion);
		$stmt->bindparam(":fPublicacion",$fPublicacion);
		$stmt->execute();
		
		return true;
	}
	
	public function guardarComentario($comentario,$idUsuario,$idNoticia){
		$query  = "INSERT INTO comentarios (comentario, idUsuario, idNoticia) VALUES (:comentario,:idUsuario,:idNoticia)";

		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":comentario",$comentario);
		$stmt->bindparam(":idUsuario",$idUsuario);
		$stmt->bindparam(":idNoticia",$idNoticia);
		$stmt->execute();
		
		return true;
	}
	
	///////////////////////////////////
	//				update
	///////////////////////////////////
	public function actualziarCat($n, $id){
		$query  = "UPDATE categorias set valor = :n WHERE idCategoria = :id";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":n",$n);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}
	
	public function actualizarNoticias($titulo,$copete,$cuerpo,$idCategoria,$idUsuario,$fModificacion,$fPublicacion,$idNoticia){			
		$query  = "UPDATE noticias set titulo = :titulo, copete = :copete, cuerpo = :cuerpo, idCategoria = :idCategoria, idUsuario = :idUsuario, fModificacion = :fModificacion, fPublicacion = :fPublicacion WHERE idNoticia = :idNoticia";

		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":titulo",$titulo);
		$stmt->bindparam(":copete",$copete);
		$stmt->bindparam(":cuerpo",$cuerpo);
		$stmt->bindparam(":idCategoria",$idCategoria);
		$stmt->bindparam(":idUsuario",$idUsuario);
		$stmt->bindparam(":fModificacion",$fModificacion);
		$stmt->bindparam(":fPublicacion",$fPublicacion);
		$stmt->bindparam(":idNoticia",$idNoticia);
		$stmt->execute();
		
		return true;
	}
	
	public function actualizarComentarioEstado($id){
		$query  = "UPDATE comentarios set estado = 'apto' WHERE idComentario = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}
	
	public function actualizarComentario($c,$id){
		$query  = "UPDATE comentarios set comentario = :c WHERE idComentario = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindparam(":c",$c);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		
		return true;
	}
}
?>