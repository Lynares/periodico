<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta.'BD/rol.class.inc');

  function obtenerRoles(){
    $Comentarios = Rol::obtenerRoles();
    return $Comentarios;
  }

  function obtenerRol( $id ){
    $Comentario = Rol::obtenerRol($id);
    return $Comentario;
  }

  function insertarRol( $id, $rol ){
    Comentario::insertarRol( $id, $rol );
  }

?>
