<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cComentario.php");
  require_once($ruta."controlador/funcionesUtiles.php");

	//Comprobar si el usuario enviado por el formulario coincide con algun usuario en la BD
  function escribeFormularioNuevo(){
    $usuarios = obtenerUsuarios();
    $noticias = obtenerNoticias();
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarComentario.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Usuario: </label>
            <select name="usuario" required>
              <!--input type="text" name="usuario" value=""/>-->
            ';
              for($i=0;$i<$usuarios[1];$i++){
                echo '<option value="',$usuarios[0][$i]->get("id"),'">',obtenerNombreUsuario($usuarios[0][$i]->get("id")),'</option>';
              }
      echo '</select>
          </td>
          <td>
            <label>Noticia: </label>
            <!--<input type="text" name="noticia" value=""/>-->
            <select name="noticia">';
              for($i=0;$i<$noticias[1];$i++){
                echo '<option value="',$noticias[0][$i]->get("id"),'">',$noticias[0][$i]->get("id"),'</option>';
              }
      echo '
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <textarea name="texto" cols="40" rows="4" placeholder="Escriba el comentario"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarComentarios.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $usuarios = obtenerUsuarios();
    $noticias = obtenerNoticias();
    $comentario = obtenerComentario($_GET["c"]);
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarComentario.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Id: </label>
            <input type="text" name="id" value="',$comentario->get("id"),'" readonly/>
          </td>
          <td>
            <label>Ip: </label>
            <input type="text" name="ip" value="',$comentario->get("ip"),'" readonly/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Fecha: </label>
            <input type="text" name="fecha2" value="',$comentario->get("fecha"),'" readonly/>
            <input type="hidden" name="fecha" value="',$comentario->get("fecha"),'"/>
          </td>
          <td>
            <label>Usuario: </label>
            <select name="usuario" required>
              <!--input type="text" name="usuario" value=""/>-->
            ';
              for($i=0;$i<$usuarios[1];$i++){
                if($usuarios[0][$i]->get("id")==$comentario->get("usuario"))
                  echo '<option value="',$usuarios[0][$i]->get("id"),'" selected>',obtenerNombreUsuario($usuarios[0][$i]->get("id")),'</option>';
                else
                  echo '<option value="',$usuarios[0][$i]->get("id"),'">',obtenerNombreUsuario($usuarios[0][$i]->get("id")),'</option>';
              }
      echo '</select>
          </td>
        </tr>
        <tr>
          <td>
            <label>Noticia: </label>
            <!--<input type="text" name="noticia" value=""/>-->
            <select name="noticia">';
              for($i=0;$i<$noticias[1];$i++){
                if($noticias[0][$i]->get("id")==$comentario->get("noticia"))
                  echo '<option value="',$noticias[0][$i]->get("id"),'" selected>',$noticias[0][$i]->get("id"),'</option>';
                else
                  echo '<option value="',$noticias[0][$i]->get("id"),'">',$noticias[0][$i]->get("id"),'</option>';
              }
      echo '
            </select>
          </td>
          <td>
            <textarea name="texto" cols="40" rows="4">',$comentario->get("texto"),'</textarea>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarComentarios.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
      <input type="hidden" name="id" value="',$comentario->get("id"),'" readonly/>
    </form>';
	}


	if(esAdmin($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["usuario"])){ //Procesa una nueva insercion o modificacion
      $fecha = date("Y-m-d G:i:s");
      $ip = $_SERVER['REMOTE_ADDR'];

      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarComentario($_POST["id"], $fecha, $_POST["ip"], $_POST["texto"], $_POST["usuario"], $_POST["noticia"]);
      else
        insertarComentario($fecha, $ip, $_POST["texto"], $_POST["usuario"], $_POST["noticia"]);

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarComentarios.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar comentario
      eliminarComentario($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarComentarios.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
