<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta.'BD/palabra.class.inc');

  function obtenerPalabras(){
    $Palabras = Palabra::obtenerPalabras();
    return $Palabras;
  }

  function obtenerPalabra( $id ){
    $Palabra = Palabra::obtenerPalabra( $id );
    return $Palabra;
  }

  function insertarPalabra( $palabra ){
    Palabra::insertarPalabra($palabra);
  }

  function modificarPalabra( $id, $palabra ){
    Palabra::modificarPalabra( $id, $palabra);
  }

  function eliminarPalabra( $id ){
    Palabra::eliminarPalabra( $id );
  }

?>
