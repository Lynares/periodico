<?php
	require_once ('datosObject.class.inc');
	class Noticia extends DataObject {
		protected $datos = array(
			"id" => "",
			"titulo" => "",
			"subtitulo" => "",
			"entradilla" => "",
			"fechaCreacion" => "",
			"fechaModificacion"=>"",
			"foto" => "",
			"foto1" => "",
			"estado" => "",
			"seccion" => "",
			"autor" => "",
			"cuerpo" => "",
			"prioridad" => ""
		);

		//Obtiene todas las noticias
		public static function obtenerNoticias() {
			//$conexion = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_NOTICIA;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$note = array();
				foreach ( $st->fetchAll() as $fila ) {
					$note[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $note, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function obtenerNoticia( $id ) {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				if ( $fila )
					return new Noticia( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerNoticiasPublicadasLike( $like ) {
			//$conexion = parent::conectar();
			$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM ' . TABLA_NOTICIA . ' WHERE (titulo LIKE "%'.$like.'%" OR entradilla LIKE "%'.$like.'%") AND estado = "Publicada"' ;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":like", $like, PDO::PARAM_INT );
				$st->execute();
				$note = array();
				foreach ( $st->fetchAll() as $fila ) {
					$note[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $note, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function obtenerNoticiasLike( $like ) {
			//$conexion = parent::conectar();
			$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM ' . TABLA_NOTICIA . ' WHERE titulo LIKE "%'.$like.'%" OR entradilla LIKE "%'.$like.'%"';
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":like", $like, PDO::PARAM_INT );
				$st->execute();
				$note = array();
				foreach ( $st->fetchAll() as $fila ) {
					$note[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $note, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}


		public static function obtenerNoticiasOrdenadas() {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE estado = 'Publicada' ORDER BY fechaModificacion DESC";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}



		//Obtenemos las noticias ordenadas por prioridad
		public static function obtenerNoticiasOrdenadasPrioridad() {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE estado = 'Publicada' ORDER BY prioridad DESC";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}
		//Obtiene las noticias de una seccion y todas sus subsecciones
		public static function obtenerNoticiasOrdenadasSubSeccion( $id ) {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE estado = 'Publicada' AND seccion IN (SELECT id FROM " . TABLA_SECCION . " WHERE subseccion = :id)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		//Obtiene las noticias de una seccion
		public static function obtenerNoticiasOrdenadasSeccion( $id ) {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE estado = 'Publicada' AND seccion = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		//Obtiene un numero indicado de noticias de una seccion
		public static function obtenerNoticiasVarias( $id, $numeroFilas ) {
			$filaInicio = 0;
			//$conexion = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_NOTICIA . " WHERE estado = 'Publicada' AND seccion = :id ORDER BY fechaModificacion DESC LIMIT :filaInicio, :numeroFilas";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":filaInicio", $filaInicio, PDO::PARAM_INT );
				$st->bindValue( ":numeroFilas", $numeroFilas, PDO::PARAM_INT );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$disco = array();
				foreach ( $st->fetchAll() as $fila ) {
					$disco[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $disco, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		//Obtiene las noticias relacionadas a un usuario
		public static function obtenerNoticiasRedactor( $id ) {
			//$conexion = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_NOTICIA . " WHERE autor = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Noticia( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $conexion );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function insertarNoticia($titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad){
			//$conexion = parent::conectar();
			$sql = "INSERT INTO " . TABLA_NOTICIA . "(titulo, subtitulo, entradilla, fechaCreacion, fechaModificacion, foto, foto1, estado, seccion, autor, cuerpo, prioridad) VALUES(:titulo, :subtitulo, :entradilla, :fechaCreacion, :fechaModificacion, :foto, :foto1, :estado, :seccion, :autor, :cuerpo, :prioridad)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":titulo", $titulo, PDO::PARAM_INT );
				$st->bindValue( ":subtitulo", $subtitulo, PDO::PARAM_INT );
				$st->bindValue( ":entradilla", $entradilla, PDO::PARAM_INT );
				$st->bindValue( ":fechaCreacion", $fechaCreacion, PDO::PARAM_INT );
				$st->bindValue( ":fechaModificacion", $fechaModificacion, PDO::PARAM_INT );
				$st->bindValue( ":foto", $foto, PDO::PARAM_INT );
				$st->bindValue( ":foto1", $foto1, PDO::PARAM_INT );
				$st->bindValue( ":estado", $estado, PDO::PARAM_INT );
				$st->bindValue( ":seccion", $seccion, PDO::PARAM_INT );
				$st->bindValue( ":autor", $autor, PDO::PARAM_INT );
				$st->bindValue( ":cuerpo", $cuerpo, PDO::PARAM_INT );
				$st->bindValue( ":prioridad", $prioridad, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $conexion );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function modificarNoticia( $id, $titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad){
			//$conexion = parent::conectar();
			$sql = "UPDATE " . TABLA_NOTICIA . " SET titulo = :titulo, subtitulo = :subtitulo, entradilla = :entradilla, fechaCreacion = :fechaCreacion, fechaModificacion = :fechaModificacion, foto = :foto, foto1 = :foto1, estado = :estado, seccion = :seccion, autor = :autor, cuerpo = :cuerpo, prioridad = :prioridad WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":titulo", $titulo, PDO::PARAM_INT );
				$st->bindValue( ":subtitulo", $subtitulo, PDO::PARAM_INT );
				$st->bindValue( ":entradilla", $entradilla, PDO::PARAM_INT );
				$st->bindValue( ":fechaCreacion", $fechaCreacion, PDO::PARAM_INT );
				$st->bindValue( ":fechaModificacion", $fechaModificacion, PDO::PARAM_INT );
				$st->bindValue( ":foto", $foto, PDO::PARAM_INT );
				$st->bindValue( ":foto1", $foto1, PDO::PARAM_INT );
				$st->bindValue( ":estado", $estado, PDO::PARAM_INT );
				$st->bindValue( ":seccion", $seccion, PDO::PARAM_INT );
				$st->bindValue( ":autor", $autor, PDO::PARAM_INT );
				$st->bindValue( ":cuerpo", $cuerpo, PDO::PARAM_INT );
				$st->bindValue( ":prioridad", $prioridad, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $conexion );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarNoticia( $id ){
			$sql = "DELETE FROM " . TABLA_NOTICIA . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}
	}
?>
