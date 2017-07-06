<?php
  //Si no existe la funcion
  if(function_exists('ruta'))
    $ruta = ruta();
  else
    $ruta = "../";

  require_once($ruta."controlador/cNoticia.php");
  require_once($ruta."controlador/cSeccion.php");
  require_once($ruta."controlador/cUsuario.php");
  require_once($ruta."controlador/cRol.php");


  function  obtenerUsuarioNoticia( $idNoticia ){
    //$noticia = Noticia::obtenerNoticia($idNoticia);
    $noticia = obtenerNoticia($idNoticia);

    $autor = $noticia->get("autor");
    if($autor==NULL) //Si no tiene autor
      $autor = "Redaccion";
    else
      $autor = obtenerUsuario($autor)->get("nombre");
      //$autor = Usuario::obtenerUsuario($autor)->get("nombre");


    return $autor;
  }

  function obtenerNombreUsuario( $idUsuario ){
    if( $idUsuario == 0)
      return "invitado";
    else {
      //$usuario = Usuario::obtenerUsuario($idUsuario);
      $usuario = obtenerUsuario($idUsuario);
      return $usuario->get("nombre");
    }
  }

  function obtenerSeccionPadre( $idSeccion ){
    $seccion = obtenerSeccion($idSeccion);
    $secP = $seccion->get("subseccion");

    //Si no tiene seccion padre(Es seccion top)
    if($secP == NULL)
      return 0;
    else
      return obtenerSeccion($secP)->get("id");
  }


  function esAdmin( $id ){
    if( $id != 0){
      $usuario = obtenerUsuario( $id );
      if($usuario->get("rol")>=3)
        return true;
    } else
      return false;
  }

  function esRedactor( $id ){
    if( $id != 0){
      $usuario = obtenerUsuario( $id );
      if($usuario->get("rol")>=2)
        return true;
    } else
      return false;
  }

  function obtenerNombreRol( $id ){
    $rol = obtenerRol($id);
    if($rol->get("id")>0 && $rol->get("id")<5)
      return $rol->get("rol");
    else
      return "Invitado";
  }

  function obtenerNombreSeccion( $idSeccion ){
      $seccion = obtenerSeccion($idSeccion);
      return $seccion->get("nombre");
  }

?>
