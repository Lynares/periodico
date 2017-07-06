<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cPalabra.php");
  require_once($ruta."controlador/funcionesUtiles.php");

  function escribeFormularioNuevo(){
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarPalabra.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td colspan="2">
            <label>Palabra: </label>
            <input type="text" name="palabra" value=""/>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarPalabras.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $palabra = obtenerPalabra($_GET["c"]);
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarPalabra.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Id: </label>
            <input type="text" name="id" value="',$palabra->get("id"),'" readonly/>
          </td>
          <td>
            <label>Palabra: </label>
            <input type="text" name="palabra" value="',$palabra->get("palabra"),'"/>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarPalabras.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
    </form>';
	}


	if(esAdmin($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["palabra"])){ //Procesa una nueva insercion o modificacion

      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarPalabra( $_POST["id"], $_POST["palabra"] );
      else
        insertarPalabra( $_POST["palabra"] );

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarPalabras.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar comentario
      eliminarPalabra($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarPalabras.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
