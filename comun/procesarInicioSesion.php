<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cUsuario.php");
  require_once($ruta."controlador/funcionesUtiles.php");

	//Comprobar si el usuario enviado por el formulario coincide con algun usuario en la BD
  function usuarioCorrecto(){
		//$usuariosTodos = Usuario::obtenerUsuarios();
    $usuariosTodos = obtenerUsuarios();
		$usuF = $_POST["nombreUsuario"];
		$pasF = $_POST["password"];
		$existe = false;
		for($i=0; $i<$usuariosTodos[1]&&$existe==false;$i++){
			$usu = $usuariosTodos[0][$i]->get("nombreUsuario");
			$cont = $usuariosTodos[0][$i]->get("password");
			//Si coincide con alguno de la base de datos

      //echo 'Usu: ', $usu, ', ', $usuF, '. Cont: ', $cont,', ', $pasF;
      //echo '<br>';
			if(strtolower($usuF)==strtolower($usu) && $pasF==$cont){
				$existe = true;
        $idUsuario = $usuariosTodos[0][$i]->get("id");
      }
		}

    if($existe == true)
      return $idUsuario;
    else
      return -1;
	}

	if($_SESSION["usuario"]==0){ //Si se pide iniciar sesion
    $idUsuario = usuarioCorrecto();
		if($idUsuario!=-1){ //Si existe el usuario en la BD
			$_SESSION["usuario"] = $idUsuario;
      $ruta_actual = $_POST["rutaClick"];
			//echo '<script>alert("Bienvenido "+ " ', obtenerNombreUsuario($_SESSION["usuario"]) ,'.")</script>';
      echo '<script>location.href="',$ruta_actual,'";</script>';
		} else { //Si no existe el usuario muestra error
      DataObject::desconectar(); //Desconectamos la BD
      echo '
				<script>alert("Los datos son erroneos, por favor, modifique los campos.")</script>
        <script>location.href="../";</script>
			';
		}
	} else { //Cierra sesion
		$usu = obtenerNombreUsuario($_SESSION["usuario"]);
		//echo '<script>alert("Gracias por visitarnos " + " ', $usu ,'" + ".\nHasta luego.");</script>';
		$_SESSION["usuario"]=0;

    DataObject::desconectar(); //Desconectamos la BD
		echo '<script>location.href="',$_SESSION["ruta_actual"],'";</script>';
	}
?>
