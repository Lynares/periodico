<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once($ruta.'BD/usuario.class.inc');

  function obtenerUsuarios(){
    $usuarios = Usuario::obtenerUsuarios();
    return $usuarios;
  }

  function obtenerUsuario( $id ){
    $usuario = Usuario::obtenerUsuario($id);
    return $usuario;
  }

  function obtenerIdUsuario( $nombreUsuario ){
    $usuario = Usuario::obtenerIdUsuario($nombreUsuario);
    return $usuario->get("id");
  }


  function obtenerUsuarioPorNombre( $nombre ){
    $usuarios = Usuario::obtenerUsuarioPorNombre( $nombre );
    return $usuarios;
  }

  function obtenerUsuarioPorRol( $nombre ){
    $usuarios = Usuario::obtenerUsuarioPorRol( $nombre );
    return $usuarios;
  }

  function modificarUsuario( $id, $nombre, $apellidos, $password, $nombreUsuario, $email, $rol ){
    Usuario::modificarUsuario( $id, $nombre, $apellidos, $password, $nombreUsuario, $email, $rol );
  }

  function insertarUsuario( $nombre, $apellidos, $password, $nombreUsuario, $email, $rol ){
    Usuario::insertarUsuario( $nombre, $apellidos, $password, $nombreUsuario, $email, $rol );
  }

  function eliminarUsuario( $id ){
    Usuario::eliminarUsuario( $id );
  }

?>
