<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cSeccion.php");
  require_once($ruta."controlador/funcionesUtiles.php");

  function escribeFormularioNuevo(){
    $secciones = obtenerSecciones();
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarSeccion.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Nombre: </label>
            <input type="text" name="nombre" value="" required/>
          </td>
          <td>
            <label>Ruta: </label>
            <input type="text" name="ruta" value=""/>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <label>Subseccion de: </label>
            <select name="subseccion">
              <option value="NULL" selected>Sin seccion</option>
            ';
              for($i=0;$i<$secciones[1];$i++){
                echo '<option value="',$secciones[0][$i]->get("id"),'">',$secciones[0][$i]->get("nombre"),'</option>';
              }
      echo '
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarSecciones.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $secciones = obtenerSecciones();
    $seccion = obtenerSeccion($_GET["c"]);
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarSeccion.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Id: </label>
            <input type="text" name="id" value="',$seccion->get("id"),'" readonly/>
          </td>
          <td>
            <label>Nombre: </label>
            <input type="text" name="nombre" value="',$seccion->get("nombre"),'"/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Ruta: </label>
            <input type="text" name="ruta" value="',$seccion->get("ruta"),'"/>
          </td>
          <td>
            <label>Subseccion de: </label>
            <select name="subseccion">';
              if($seccion->get("subseccion") == NULL )
                echo '<option value="NULL" selected>Sin seccion</option>';
              else
                echo '<option value="NULL">Sin seccion</option>';

              for($i=0;$i<$secciones[1];$i++){
                if($secciones[0][$i]->get("id") == $seccion->get("subseccion"))
                  echo '<option value="',$secciones[0][$i]->get("id"),'" selected>',$secciones[0][$i]->get("nombre"),'</option>';
                else
                  echo '<option value="',$secciones[0][$i]->get("id"),'">',$secciones[0][$i]->get("nombre"),'</option>';
              }
      echo '
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarSecciones.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
    </form>';
	}

  if(esAdmin($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["nombre"])){ //Procesa una nueva insercion o modificacion

      if($_POST["subseccion"] == 0 )
        $sec = NULL;
      else
        $sec = $_POST["subseccion"];

      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarSeccion( $_POST["id"], $_POST["nombre"], $_POST["ruta"], $sec );
      else
        insertarSeccion( $_POST["nombre"], $_POST["ruta"], $sec );

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarSecciones.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar
      eliminarSeccion($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarSecciones.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
