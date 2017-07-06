<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD

	require_once($ruta."controlador/cComentario.php");
  date_default_timezone_set('Europe/Madrid');

	if($_SESSION["usuario"]!=0){ //Si el usuario es diferente de invitado
      $fecha = date("Y-m-d G:i:s");
      $texto = $_POST["texto"];
      $noticia = $_POST["idNoticia"];
      $ip = $_SERVER['REMOTE_ADDR'];
      //echo 'F: ', $fecha, ', N: ', $noticia, ', Ip: ', $ip, ', U: ', $_SESSION["usuario"], ', T: ', $texto;

      //Comentario::insertarComentario($fecha, $ip, $texto, $_SESSION["usuario"], $noticia);
      insertarComentario($fecha, $ip, $texto, $_SESSION["usuario"], $noticia);

      echo '
        <script>location.href="../noticias/noticia.php?noticia=',$noticia,'";</script>
			';
	} else {
		echo '<script>alert("Esta seccion no esta disponible para invitados.");</script>';
		echo '<script>location.href="',ruta(),'";</script>';
	}
?>
