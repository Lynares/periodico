<?php
	require_once ('datosObject.class.inc');
	class Comentario extends DataObject {
		protected $datos = array(
			"id" => "",
			"fecha" => "",
			"ip" => "",
			"texto" => "",
			"usuario" => "",
			"noticia"=>""
		);

		public static function obtenerComentarios() {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_COMENTARIO . " ORDER BY fecha DESC";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Comentario( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				return array( $varclass, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function obtenerComentario( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_COMENTARIO . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Comentario( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerComentariosVarios( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_COMENTARIO . " WHERE noticia = :id ORDER BY fecha DESC LIMIT 0, 3";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$disco = array();
				foreach ( $st->fetchAll() as $fila ) {
					$disco[] = new Comentario( $fila );
				}
				$st = $GLOBALS["conexion"]->query( "SELECT found_rows() AS filasTotales" );
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				return array( $disco, $fila["filasTotales"] );
			}catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallida: " . $e->getMessage() );
			}
		}

		public static function modificarComentario($id, $fecha, $ip, $texto, $usuario, $noticia){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "UPDATE " . TABLA_COMENTARIO . " SET fecha = :fecha, ip = :ip, texto = :texto, usuario = :usuario, noticia = :noticia WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":fecha", $fecha, PDO::PARAM_INT );
				$st->bindValue( ":ip", $ip, PDO::PARAM_INT );
				$st->bindValue( ":texto", $texto, PDO::PARAM_INT );
				$st->bindValue( ":usuario", $usuario, PDO::PARAM_INT );
				$st->bindValue( ":noticia", $noticia, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function insertarComentario($fecha, $ip, $texto, $usuario, $noticia){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "INSERT INTO " . TABLA_COMENTARIO . "(fecha, ip, texto, usuario, noticia) VALUES(:fecha, :ip, :texto, :usuario, :noticia)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":fecha", $fecha, PDO::PARAM_INT );
				$st->bindValue( ":ip", $ip, PDO::PARAM_INT );
				$st->bindValue( ":texto", $texto, PDO::PARAM_INT );
				$st->bindValue( ":usuario", $usuario, PDO::PARAM_INT );
				$st->bindValue( ":noticia", $noticia, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarComentario( $id ){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "DELETE FROM " . TABLA_COMENTARIO . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}
	}
?>
