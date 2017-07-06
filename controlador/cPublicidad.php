<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";



  require_once($ruta.'BD/publicidad.class.inc');

  function obtenerPublicidadTodas(){
    $publicidad = Publicidad::obtenerPublicidadTodas();
    return $publicidad;
  }
  
// Funcion para obtener la publicidad con prioridad 1 en el index y la de prioridad 0 en seccion o en noticia
  function obtenerPublicidadPrioridad( $prioridad ){
    $publicidad = Publicidad::obtenerPublicidadPrioridad($prioridad);
    return $publicidad;
  }

  function obtenerPublicidad( $id ){
    $publicidad = Publicidad::obtenerPublicidad($id);
    return $publicidad;
  }

  function aumentarClickPublicidad( $id ){
    Publicidad::aumentarClickPublicidad( $id );
  }
// Modificadas las dos funciones para insertar y modificar la prioridad de la publicidad
  function modificarPublicidad($id, $texto, $img, $enlace, $prioridad){
    Publicidad::modificarPublicidad( $id, $texto, $img, $enlace, $prioridad );
  }

  function insertarPublicidad($texto, $img, $enlace, $prioridad){
    Publicidad::insertarPublicidad( $texto, $img, $enlace, $prioridad );
  }

  function eliminarPublicidad( $id ){
    Publicidad::eliminarPublicidad( $id );
  }

?>
