<?php
	require_once ('datosObject.class.inc');
	class Seccion extends DataObject {
		protected $datos = array(
			"id" => "",
			"nombre" => "",
			"ruta" => "",
			"subseccion" => ""
		);

		public static function obtenerSecciones() {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_SECCION;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Seccion( $fila );
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

		//Devuelve las secciones que no tiene subseccion
		public static function obtenerSeccionesPadre() {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_SECCION . " WHERE subseccion IS NULL";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Seccion( $fila );
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

		public static function obtenerSeccion( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_SECCION . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Seccion( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		//Obtiene las subsecciones de una seccion
		public static function obtenerSubsecciones( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_SECCION . " WHERE subseccion = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Seccion( $fila );
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

		public static function insertarSeccion($nombre, $ruta, $subseccion){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "INSERT INTO " . TABLA_SECCION . "(nombre, ruta, subseccion) VALUES(:nombre, :ruta, :subseccion)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":nombre", $nombre, PDO::PARAM_INT );
				$st->bindValue( ":ruta", $ruta, PDO::PARAM_INT );
				$st->bindValue( ":subseccion", $subseccion, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function modificarSeccion( $id, $nombre, $ruta, $subseccion){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "UPDATE " . TABLA_SECCION . " SET nombre = :nombre, ruta = :ruta, subseccion = :subseccion WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":nombre", $nombre, PDO::PARAM_INT );
				$st->bindValue( ":ruta", $ruta, PDO::PARAM_INT );
				$st->bindValue( ":subseccion", $subseccion, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarSeccion($id){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "DELETE FROM " . TABLA_SECCION . " WHERE id = :id";
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
