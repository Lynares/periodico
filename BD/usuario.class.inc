<?php
	//require_once ('datosObject.class.inc');
	class Usuario extends DataObject {
		protected $datos = array(
			"id" => "",
			"nombre" => "",
			"apellidos" => "",
			"password" => "",
			"nombreUsuario" => "",
			"email" => "",
			"rol" => ""
		);

		public static function obtenerUsuarios() {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_USUARIO;
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->execute();
				$varclass = array();
				foreach ( $st->fetchAll() as $fila ) {
					$varclass[] = new Usuario( $fila );
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

		public static function obtenerUsuario( $id ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_USUARIO . " WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Usuario( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerIdUsuario( $nombreUsuario ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_USUARIO . " WHERE nombreUsuario = :nombreUsuario";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":nombreUsuario", $nombreUsuario, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Usuario( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerUsuarioPorNombre( $nombreUsuario ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_USUARIO . " WHERE nombreUsuario = :nombreUsuario";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":nombreUsuario", $nombreUsuario, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Usuario( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function obtenerUsuarioPorRol( $rol ) {
			//$GLOBALS["conexion"] = parent::conectar();
			$sql = "SELECT * FROM " . TABLA_USUARIO . " WHERE rol = :rol";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":rol", $rol, PDO::PARAM_INT );
				$st->execute();
				$fila = $st->fetch();
				//parent::desconectar( $GLOBALS["conexion"] );
				if ( $fila )
					return new Usuario( $fila );
			} catch ( PDOException $e ) {
				//parent::desconectar( $GLOBALS["conexion"] );
				die( "Consulta fallada: " . $e->getMessage() );
			}
		}

		public static function modificarUsuario($id, $nombre, $apellidos, $password, $nombreUsuario, $email, $rol){
			$sql = "UPDATE " . TABLA_USUARIO . " SET nombre = :nombre, apellidos = :apellidos, password = :password, nombreUsuario = :nombreUsuario, email = :email, rol = :rol WHERE id = :id";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":id", $id, PDO::PARAM_INT );
				$st->bindValue( ":nombre", $nombre, PDO::PARAM_INT );
				$st->bindValue( ":apellidos", $apellidos, PDO::PARAM_INT );
				$st->bindValue( ":password", $password, PDO::PARAM_INT );
				$st->bindValue( ":nombreUsuario", $nombreUsuario, PDO::PARAM_INT );
				$st->bindValue( ":email", $email, PDO::PARAM_INT );
				$st->bindValue( ":rol", $rol, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Modificacion fallada: " . $e->getMessage() );
			}
		}

		public static function insertarUsuario($nombre, $apellidos, $password, $nombreUsuario, $email, $rol){
			$sql = "INSERT INTO " . TABLA_USUARIO . "(nombre, apellidos, password, nombreUsuario, email, rol) VALUES(:nombre, :apellidos, :password, :nombreUsuario, :email, :rol)";
			try {
				$st = $GLOBALS["conexion"]->prepare( $sql );
				$st->bindValue( ":nombre", $nombre, PDO::PARAM_INT );
				$st->bindValue( ":apellidos", $apellidos, PDO::PARAM_INT );
				$st->bindValue( ":password", $password, PDO::PARAM_INT );
				$st->bindValue( ":nombreUsuario", $nombreUsuario, PDO::PARAM_INT );
				$st->bindValue( ":email", $email, PDO::PARAM_INT );
				$st->bindValue( ":rol", $rol, PDO::PARAM_INT );
				$st->execute();
			} catch ( PDOException $e ) {
				die( "Insercion fallada: " . $e->getMessage() );
			}
		}

		public static function eliminarUsuario( $id ){
			$sql = "DELETE FROM " . TABLA_USUARIO . " WHERE id = :id";
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
