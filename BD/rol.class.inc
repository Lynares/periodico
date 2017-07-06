<?php
	//require_once ('datosObject.class.inc');
	class Rol extends DataObject {
		protected $datos = array(
			"id" => "",
			"rol" => ""
		);

		public static function obtenerRoles() {
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_ROL;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Rol( $fila );
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

		public static function obtenerRol( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_ROL . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Rol( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function insertarRol( $id, $rol ){
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "INSERT INTO " . TABLA_ROL . " VALUES(:id, :rol)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":rol", $rol, PDO::PARAM_INT );
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
