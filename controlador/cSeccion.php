<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta.'BD/seccion.class.inc');

  function obtenerSecciones(){
    $Secciones = Seccion::obtenerSecciones();
    return $Secciones;
  }

  function obtenerSeccion( $id ){
    $Seccion = Seccion::obtenerSeccion($id);
    return $Seccion;
  }

  function obtenerSeccionesPadre(){
    $Secciones = Seccion::obtenerSeccionesPadre();
    return $Secciones;
  }

  function obtenerSubsecciones( $idSeccion ){
    $subSec = Seccion::obtenerSubsecciones( $idSeccion );
    return $subSec;
  }

  function insertarSeccion( $nombre, $ruta, $subseccion ){
    Seccion::insertarSeccion( $nombre, $ruta, $subseccion );
  }

  function modificarSeccion( $id, $nombre, $ruta, $subseccion ){
    Seccion::modificarSeccion( $id, $nombre, $ruta, $subseccion );
  }

  function eliminarSeccion( $id ){
    Seccion::eliminarSeccion( $id );
  }

?>
