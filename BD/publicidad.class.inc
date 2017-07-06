<?php
	//require_once ('datosObject.class.inc');
	class Publicidad extends DataObject {
		protected $datos = array(
			"id" => "",
			"texto" => "",
			"img" => "",
			"enlace" => "",
			"click" => "",
			"prioridad" => ""
		);

		public static function obtenerPublicidadTodas() {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_PUBLICIDAD;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Publicidad( $fila );
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

		public static function obtenerPublicidadPrioridad( $prioridad ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_PUBLICIDAD . " WHERE prioridad = :prioridad";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":prioridad", $prioridad, PDO::PARAM_INT );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Publicidad( $fila );
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


		public static function obtenerPublicidad( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_PUBLICIDAD . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Publicidad( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function aumentarClickPublicidad( $id){

			$sql = "UPDATE " . TABLA_PUBLICIDAD . " SET click = click+1 WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Modificacion fallada: " . $e->getMessage() );
			}
		}
//Modificado para modificar prioridad
		public static function modificarPublicidad($id, $texto, $img, $enlace, $prioridad){

			$sql = "UPDATE " . TABLA_PUBLICIDAD . " SET texto = :texto, img = :img, enlace = :enlace, prioridad = :prioridad WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":texto", $texto, PDO::PARAM_INT );
				$st->bindValue( ":img", $img, PDO::PARAM_INT );
				$st->bindValue( ":enlace", $enlace, PDO::PARAM_INT );
				$st->bindValue( ":prioridad", $prioridad, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Modificacion fallada: " . $e->getMessage() );
			}
		}
// Modificado para insertar prioridad
		public static function insertarPublicidad($texto, $img, $enlace, $prioridad){

			$sql = "INSERT INTO " . TABLA_PUBLICIDAD . "(texto, img, enlace, click, prioridad) VALUES(:texto, :img, :enlace, 0, :prioridad)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":texto", $texto, PDO::PARAM_INT );
				$st->bindValue( ":img", $img, PDO::PARAM_INT );
				$st->bindValue( ":enlace", $enlace, PDO::PARAM_INT );
				$st->bindValue( ":prioridad", $prioridad, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarPublicidad( $id ){
			$sql = "DELETE FROM " . TABLA_PUBLICIDAD . " WHERE id = :id";
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
