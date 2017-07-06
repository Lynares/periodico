<?php

session_start();

if(!isset($_SESSION["seccion"])){ //Si no hay seccion en eleccion
  $_SESSION["seccion"] = "index";
}

function ruta2(){
  if($_SESSION["seccion"]=="index")
    return "";
  else
    return "../";
}

$ruta = "../";

//echo '<a><li>',$_SESSION["seccion"],'</li></a>';
//echo '<a><li>',$ruta,'</li></a>';

require_once ($ruta.'BD/datosObject.class.inc');
$conexion = DataObject::conectar(); //conectar la BD
require_once($ruta."controlador/cNoticia.php");

$like = $_GET["like"];
//echo '<a><li>Hola ',$like,'</li></a>';

$like = str_replace ( '"' , '\"', $like);
//echo '<a><li>Hola ',$like,'</li></a>';

if($_SESSION["usuario"]==0)
  $noticias = obtenerNoticiasPublicadasLike( $like );
else
  $noticias = obtenerNoticiasLike( $like );

echo '<a><li>Noticias encontradas: ',$noticias[1],'</li></a>';

$ruta = ruta2();
for($i=0;$i<$noticias[1];$i++){
  echo '
  <a href="',$ruta,'noticias/noticia.php?noticia=',$noticias[0][$i]->get("id"),'&busqueda=',$like,'">
    <li>- ',
      substr($noticias[0][$i]->get("titulo"),0,30);
      if(strlen($noticias[0][$i]->get("titulo"))>=30)
        echo '...';
      echo '
    </li>
  </a>';
}

DataObject::desconectar();

?>
