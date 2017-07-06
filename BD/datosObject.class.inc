<?php
require_once('configuracion.inc');
abstract class DataObject {
	protected $datos = array();
	public function __construct( $datos ) {
		foreach ( $datos as $clave => $valor )
			if ( array_key_exists( $clave, $this->datos ) )
				$this->	datos[$clave] = $valor;
	}

	public function get( $campo ) {
		if ( array_key_exists( $campo, $this-> datos ) ) {
			return $this->datos[$campo];
		} else
			die( "Campo no encontrado" );
	}

	public static function conectar() {
		try {
			$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
			// Se permite a PHP que mantenga la conexi�n MySQL abierta para
			// que se emplee en otras partes de la aplicaci�n.
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true );
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			die( "Conexi�n fallida: " . $e->getMessage() );
		}
		return $conexion;
	}

	public static function desconectar( $conexion ) {
		$conexion = "";
	}
}
?>
