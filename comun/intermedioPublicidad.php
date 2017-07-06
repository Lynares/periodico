<?php

  session_start();

  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";



  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar();

  require_once($ruta.'controlador/cPublicidad.php');

  aumentarClickPublicidad( $_GET["pb"] );
  $enlace = obtenerPublicidad( $_GET["pb"])->get("enlace");

  $conexion = DataObject::desconectar();
  echo '<script>location.href="',$enlace,'"</script>';
?>
