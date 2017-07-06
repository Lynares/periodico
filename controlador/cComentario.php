<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta.'BD/comentario.class.inc');

  function obtenerComentarios(){
    $Comentarios = Comentario::obtenerComentarios();
    return $Comentarios;
  }

  function obtenerComentario( $id ){
    $Comentario = Comentario::obtenerComentario($id);
    return $Comentario;
  }

  function obtenerComentariosVarios( $id, $cant ){
    $Comentarios = Comentario::obtenerComentariosVarios( $id, $cant );
    return $Comentarios;
  }

  function modificarComentario( $id, $fecha, $ip, $texto, $usuario, $noticia ){
    Comentario::modificarComentario( $id, $fecha, $ip, $texto, $usuario, $noticia );
  }

  function insertarComentario( $fecha, $ip, $texto, $usuario, $noticia ){
    Comentario::insertarComentario( $fecha, $ip, $texto, $usuario, $noticia );
  }

  function eliminarComentario( $id ){
    Comentario::eliminarComentario( $id );
  }

?>
