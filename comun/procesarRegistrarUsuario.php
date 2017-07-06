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

function usuarioCorrecto(){
  $usuariosTodos = obtenerUsuarios();
  $usuF = $_POST["nombreUsuario"];
  $existe = false;
  for($i=0; $i<$usuariosTodos[1]&&$existe==false;$i++){
    $usu = $usuariosTodos[0][$i]->get("nombreUsuario");
    //Si coincide con alguno de la base de datos

    if(strtolower($usuF)==strtolower($usu)){
      $existe = true;
    }
  }

  return $existe;
}


if($_SESSION["usuario"]==0){//Si pide registrar
  if(usuarioCorrecto()==true){
    echo '
    <script>alert("Ya existe el nombre de usuario.");</script>
    <script>location.href="../comun/registrarUsuario.php";</script>
    ';
  } else {
    insertarUsuario( $_POST["nombre"], $_POST["apellidos"], $_POST["password"], $_POST["nombreUsuario"], $_POST["email"], 1);
    $_SESSION["usuario"] = obtenerIdUsuario( $_POST["nombreUsuario"]);
    DataObject::desconectar(); //Desconectamos la BD

    $ruta_actual = $_POST["rutaClick"];
    echo '<script>location.href="',$ruta_actual,'";</script>';
  }
}

?>
