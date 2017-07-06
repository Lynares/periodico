<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cPublicidad.php");
  require_once($ruta."controlador/funcionesUtiles.php");

	//Comprobar si el usuario enviado por el formulario coincide con algun usuario en la BD
  function escribeFormularioNuevo(){
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarPublicidad.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td colspan="2">
            <textarea name="texto" cols="70" rows="4" placeholder="Texto"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <label>Imagen: </label>
            <input type="text" name="img"/>
          </td>
          <td>
            <label>Enlace: </label>
            <input type="text" name="enlace"/>
          </td>
        </tr
        <!--La prioridad-->
        <tr>
          <td colspan=2>
            <label>Prioridad: </label>
              <input type="number" name="prioridad" min="0" max="1" value=""/>
          </td>
        </tr>
        <!--La prioridad-->
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarPublicidad.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $publicidad = obtenerPublicidad($_GET["c"]);
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarPublicidad.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td colspan="2">
            <textarea name="texto" cols="70" rows="4" placeholder="Texto">',$publicidad->get("texto"),'</textarea>
          </td>
        </tr>
        <tr>
          <td>
            <label>Imagen: </label>
            <input type="text" name="img" value="',$publicidad->get("img"),'"/>
          </td>
          <td>
            <label>Enlace: </label>
            <input type="text" name="enlace" value="',$publicidad->get("enlace"),'"/>
          </td>
        </tr>
        <!--La prioridad-->
        <tr>
          <td colspan=2>
            <label>Prioridad: </label>
              <input type="number" name="prioridad" min="0" max="1" value="',$publicidad->get("prioridad"),'"/>

          </td>
        </tr>
        <!--La prioridad-->
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarPublicidad.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
      <input type="hidden" name="id" value="',$publicidad->get("id"),'" readonly/>
    </form>';
	}


	if(esAdmin($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["enlace"])){ //Procesa una nueva insercion o modificacion

      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarPublicidad($_POST["id"], $_POST["texto"], $_POST["img"], $_POST["enlace"], $_POST["prioridad"] );
      else
        insertarPublicidad( $_POST["texto"], $_POST["img"], $_POST["enlace"], $_POST["prioridad"] );

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarPublicidad.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar comentario
      eliminarPublicidad($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarPublicidad.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
