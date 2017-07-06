<?php

  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta.'BD/noticia.class.inc');

  function obtenerNoticias(){
    $Noticias = Noticia::obtenerNoticias();
    return $Noticias;
  }

  function obtenerNoticia( $id ){
    $Noticia = Noticia::obtenerNoticia($id);
    return $Noticia;
  }

  function obtenerNoticiasOrdenadas(){
    $Noticias = Noticia::obtenerNoticiasOrdenadas();
    return $Noticias;
  }

  function obtenerNoticiasPublicadasLike( $like ){
    $Noticias = Noticia::obtenerNoticiasPublicadasLike( $like );
    return $Noticias;
  }
  function obtenerNoticiasLike( $like ){
    $Noticias = Noticia::obtenerNoticiasLike( $like );
    return $Noticias;
  }

  function obtenerNoticiasOrdenadasPrioridad(){
    $Noticias = Noticia::obtenerNoticiasOrdenadasPrioridad();
    return $Noticias;
  }
  function obtenerNoticiasOrdenadasSubSeccion( $id ){
    $Noticias = Noticia::obtenerNoticiasOrdenadasSubSeccion($id);
    return $Noticias;
  }

  function obtenerNoticiasOrdenadasSeccion( $id ){
    $Noticias = Noticia::obtenerNoticiasOrdenadasSeccion($id);
    return $Noticias;
  }

  function obtenerNoticiasVarias( $id, $numeroFilas ){
    $Noticias = Noticia::obtenerNoticiasVarias( $id, $numeroFilas );
    return $Noticias;
  }

  function obtenerNoticiasRedactor( $id ){
    $Noticias = Noticia::obtenerNoticiasRedactor( $id );
    return $Noticias;
  }

  function insertarNoticia( $titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad ){
    Noticia::insertarNoticia( $titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad );
  }

  function modificarNoticia( $id, $titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad ){
    Noticia::modificarNoticia( $id, $titulo, $subtitulo, $entradilla, $fechaCreacion, $fechaModificacion, $foto, $foto1, $estado, $seccion, $autor, $cuerpo, $prioridad );
  }

  function eliminarNoticia( $id ){
    Noticia::eliminarNoticia( $id );
  }

?>
