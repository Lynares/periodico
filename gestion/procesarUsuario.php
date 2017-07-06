<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cUsuario.php");
  require_once($ruta."controlador/funcionesUtiles.php");

	//Comprobar si el usuario enviado por el formulario coincide con algun usuario en la BD
  function escribeFormularioNuevo(){
    $roles = obtenerRoles();
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarUsuario.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Nombre: </label>
            <input type="text" name="nombre" value="" required/>
          </td>
          <td>
            <label>Apellidos: </label>
            <input type="text" name="apellidos" value=""/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Nombre de Usuario: </label>
            <input type="text" name="nombreUsuario" value="" required/>
          </td>
          <td>
            <label>Email: </label>
            <input type="text" name="email" value=""/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Contrase&ntilde;a: </label>
            <input type="password" name="password" value="" required/>
          </td><td>
            <label>Confirmar contrase&ntilde;a: </label>
            <input type="password" name="password2" value="" required/>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <label>Rol: </label>
            <select name="rol">';
              for($i=0;$i<$roles[1];$i++){
                echo '<option value="',$roles[0][$i]->get("id"),'">',$roles[0][$i]->get("rol"),'</option>';
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
            <a href="listarUsuarios.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $roles = obtenerRoles();
    $usuario = obtenerUsuario($_GET["c"]);
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarUsuario.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td>
            <label>Id: </label>
            <input type="text" name="id" value="',$usuario->get("id"),'" readonly/>
          </td>
          <td>
            <label>Nombre: </label>
            <input type="text" name="nombre" value="',$usuario->get("nombre"),'"/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Apellidos: </label>
            <input type="text" name="apellidos" value="',$usuario->get("apellidos"),'"/>
          </td>
          <td>
            <label>Nombre de Usuario: </label>
            <input type="text" name="nombreUsuario" value="',$usuario->get("nombreUsuario"),'"/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Contrase&ntilde;a: </label>
            <input type="password" name="password" value="',$usuario->get("password"),'"/>
          </td><td>
            <label>Confirmar contrase&ntilde;a: </label>
            <input type="password" name="password2" value=""/>
          </td>
        </tr>
        <tr>
          <td>
            <label>Email: </label>
            <input type="text" name="email" value="',$usuario->get("email"),'"/>
          </td>
          <td>
            <select name="rol">';
              for($i=0;$i<$roles[1];$i++){
                if($roles[0][$i]->get("id")==$usuario->get("rol"))
                  echo '<option value="',$roles[0][$i]->get("id"),'" selected>',$roles[0][$i]->get("rol"),'</option>';
                else
                  echo '<option value="',$roles[0][$i]->get("id"),'">',$roles[0][$i]->get("rol"),'</option>';
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
            <a href="listarUsuarios.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>

      </table>
      <input type="hidden" name="id" value="',$usuario->get("id"),'" readonly/>
    </form>';
	}


	if(esAdmin($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["nombre"])){ //Procesa una nueva insercion o modificacion

      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarUsuario( $_POST["id"], $_POST["nombre"], $_POST["apellidos"], $_POST["password"], $_POST["nombreUsuario"], $_POST["email"], $_POST["rol"] );
      else
        insertarUsuario( $_POST["nombre"], $_POST["apellidos"], $_POST["password"], $_POST["nombreUsuario"], $_POST["email"], $_POST["rol"] );

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarUsuarios.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar comentario
      eliminarUsuario($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarUsuarios.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
