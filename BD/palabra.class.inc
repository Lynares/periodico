<?php
	require_once ('datosObject.class.inc');
	class Palabra extends DataObject {
		protected $datos = array(
			"id" => "",
			"palabra" => ""
		);

		public static function obtenerPalabras() {
			//$conexion = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_PALABRA;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Palabra( $fila );
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

		public static function obtenerPalabra( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_PALABRA . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Palabra( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function insertarPalabra($palabra){
			//$conexion = parent::conectar();
			$sql = "INSERT INTO " . TABLA_PALABRA . "(palabra) VALUES(:palabra)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":palabra", $palabra, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $conexion );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function modificarPalabra( $id, $palabra ){
			//$conexion = parent::conectar();
			$sql = "UPDATE " . TABLA_PALABRA . " SET palabra = :palabra WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":palabra", $palabra, PDO::PARAM_INT );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $conexion );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarPalabra( $id ){
			//$conexion = parent::conectar();
			$sql = "DELETE FROM " . TABLA_PALABRA . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", "$id", PDO::PARAM_INT );
				$st->execute();
				//$fila = $st->fetch();
				//parent::desconectar( $conexion );
			} catch ( PDOException $e ) {
				//parent::desconectar( $conexion );
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}
	}
?>
