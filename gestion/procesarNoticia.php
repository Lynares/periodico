<?php

  session_start();

  //Si no existe la funcion
  if(function_exists('ruta'))
		$ruta = ruta();
	else
    $ruta = "../";

  require_once ($ruta.'BD/datosObject.class.inc');
  $conexion = DataObject::conectar(); //conectar la BD
	require_once($ruta."controlador/cNoticia.php");
  require_once($ruta."controlador/funcionesUtiles.php");

  function escribeFormularioNuevo(){
    $secciones = obtenerSecciones();
    $usuarios = obtenerUsuarios();
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarNoticia.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td colspan=2>
            <label>T&iacute;tulo: </label>
            <textarea name="titulo" cols="100" rows="4" placeholder="Titulo noticia"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan=2>
            <label>Subt&iacute;tulo: </label>
            <textarea name="subtitulo" cols="100" rows="4" placeholder="Subtitulo noticia"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan=2>
            <label>Entradilla</label>
            <textarea name="entradilla" cols="100" rows="4" placeholder="Entradilla noticia"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <label>Foto: </label>
            <input type="text" name="foto" value=""/>
          </td>
          <td>
            <label>Foto 1: </label>
            <input type="text" name="foto1" value=""/>
          </td>
        </tr>
        <tr>';
          //Si es redactor no puede elegir si la noticia estara publicada y la prioridad
          if(esAdmin($_SESSION["usuario"])==false){
            echo '
              <input type="hidden" name="estado" value="Pendiente"/>
              <input type="hidden" name="prioridad" value="1"/>
              <td colspan="2">
                ';
          } else {
                echo '
              <td>
                <label>Estado: </label>
                <select name="estado">
                  <option value="Publicada">Publicada</option>
                  <option value="Pendiente" selected>Pendiente de Validacion</option>
                </select>
              </td>
              <!--La prioridad-->
              <tr>
                <td colspan=2>
                  <label>Prioridad: </label>
                    <input type="number" name="prioridad" min="1" max="10" value=""/>

                </td>
              </tr>
              <!--La prioridad-->
              <td>
            ';
          }
          echo '
            <label>Seccion: </label>
            <select name="seccion">';
              for($i=0;$i<$secciones[1];$i++){
                echo '<option value="',$secciones[0][$i]->get("id"),'">',$secciones[0][$i]->get("nombre"),'</option>';
              }
      echo '
            </select>
          </td>
        </tr>';

          //Si no es admin(es redactor) la noticia se crea pendiente de validar y no se puede cambiar
          if(esAdmin($_SESSION["usuario"])==true){
            echo '
              <tr>
                <td colstpan=2>
                  <label>Autor: </label>
                  <select name="autor">';
                    for($i=0;$i<$usuarios[1];$i++){
                      if($usuarios[0][$i]->get("id") == $_SESSION["usuario"])
                        echo '<option value="',$usuarios[0][$i]->get("id"),'" selected>',$usuarios[0][$i]->get("nombre"),'</option>';
                      else
                        echo '<option value="',$usuarios[0][$i]->get("id"),'">',$usuarios[0][$i]->get("nombre"),'</option>';
                    }
                    echo '<option value="NULL">Redacci&oacute;n</option>';
                    echo '
                  </select>
                </td>
              </tr>
            ';
          } else {
            echo '<input type="hidden" name="autor" value="',$_SESSION["usuario"],'"/>';
          }
          echo '
        <tr>
          <td colspan=2>
            <label>Cuerpo</label>
            <textarea name="cuerpo" cols="100" rows="8" placeholder="Cuerpo noticia"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarNoticias.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
    </form>';
	}

  function escribeFormularioModificar(){
    $noticia = obtenerNoticia($_GET["c"]);
    $secciones = obtenerSecciones();
    $usuarios = obtenerUsuarios();
    echo '
    <form name="nmGestion" action="',$GLOBALS["ruta"],'gestion/procesarNoticia.php" method="POST">
      <table id="nmGestion">
        <tr>
          <td colspan=2>
            <label>T&iacute;tulo: </label>
            <textarea name="titulo" cols="100" rows="4" placeholder="Titulo noticia">',$noticia->get("titulo"),'</textarea>
          </td>
        </tr>
        <tr>
          <td colspan=2>
            <label>Subt&iacute;tulo: </label>
            <textarea name="subtitulo" cols="100" rows="4" placeholder="Subtitulo noticia">',$noticia->get("subtitulo"),'</textarea>
          </td>
        </tr>
        <!--La prioridad-->
        <tr>
          <td colspan=2>
            <label>Prioridad: </label>
              <input type="number" name="prioridad" min="1" max="10" value="',$noticia->get("prioridad"),'"/>

          </td>
        </tr>
        <!--La prioridad-->
        <tr>
          <td colspan=2>
            <label>Entradilla</label>
            <textarea name="entradilla" cols="100" rows="4" placeholder="Entradilla noticia">',$noticia->get("entradilla"),'</textarea>
          </td>
        </tr>
        <tr>
          <td>
            <label>Foto: </label>
            <input type="text" name="foto" value="',$noticia->get("foto"),'"/>
          </td>
          <td>
            <label>Foto 1: </label>
            <input type="text" name="foto1" value="',$noticia->get("foto1"),'"/>
          </td>
        </tr>
        <tr>';
          //Si no es admin(es redactor) la noticia se crea pendiente de validar y no se puede cambiar
          if(esAdmin($_SESSION["usuario"])==false){
            echo '
              <input type="hidden" name="estado" value="Pendiente"/>
              <td colspan="2">
                ';
          } else {
            echo '
              <td>
                <label>Estado: </label>
                <select name="estado">';
                  if($noticia->get("estado") == "Publicada"){
                    echo '
                      <option value="Publicada" selected>Publicada</option>
                      <option value="Pendiente">Pendiente de Validacion</option>
                    ';
                  } else {
                    echo '
                      <option value="Publicada">Publicada</option>
                      <option value="Pendiente" selected>Pendiente de Validacion</option>
                    ';
                  }
                echo '
                </select>
              </td>
              <td>';
          }
          echo '
            <label>Seccion: </label>
            <select name="seccion">';
              for($i=0;$i<$secciones[1];$i++){
                if($secciones[0][$i]->get("id") == $noticia->get("seccion"))
                  echo '<option value="',$secciones[0][$i]->get("id"),'" selected>',$secciones[0][$i]->get("nombre"),'</option>';
                else
                  echo '<option value="',$secciones[0][$i]->get("id"),'">',$secciones[0][$i]->get("nombre"),'</option>';
              }
      echo '
            </select>
          </td>
        </tr>';

        if(esAdmin($_SESSION["usuario"])==true){
          echo '
            <tr>
              <td colstpan=2>
                <label>Autor: </label>
                <select name="autor">';
                  for($i=0;$i<$usuarios[1];$i++){
                    if($usuarios[0][$i]->get("id") == $noticia->get("autor"))
                      echo '<option value="',$usuarios[0][$i]->get("id"),'" selected>',$usuarios[0][$i]->get("nombre"),'</option>';
                    else
                      echo '<option value="',$usuarios[0][$i]->get("id"),'">',$usuarios[0][$i]->get("nombre"),'</option>';
                  }
                  if($noticia->get("autor") == NULL)
                    echo '<option value="NULL" selected>Redacci&oacute;n</option>';
          echo '
                </select>
              </td>
            </tr>';
        } else {
          echo '<input type="hidden" name="autor" value="',$_SESSION["usuario"],'"/>';
        }

        echo '
        <tr>
          <td colspan=2>
            <label>Cuerpo</label>
            <textarea name="cuerpo" cols="100" rows="8" placeholder="Cuerpo noticia">',$noticia->get("cuerpo"),'</textarea>
          </td>
        </tr>
        <input type="hidden" name="id" value="',$noticia->get("id"),'"/>
        <input type="hidden" name="fechaCreacion" value="',$noticia->get("fechaCreacion"),'"/>
        <tr>
          <td>
            <input type="submit" value="Enviar" style="float:right"/>
          </td>
          <td>
            <a href="listarNoticias.php"><input type="button" value="Cancelar"/></a>
          </td>
        </tr>
      </table>
    </form>';
	}


	if(esRedactor($_SESSION["usuario"])==false){ //Si el ususario no esta autorizado
      echo '<script>location.href="',$GLOBALS['ruta'],'index.php";</script>';
	} else {
		if(isset($_POST["titulo"])){ //Procesa una nueva insercion o modificacion
      $fecha = date("Y-m-d G:i:s");
      //echo '<script>alert("Aqui "+',$_POST["seccion"],')</script>';
      //Modificadas insertar y modificar para que se le pase por post la prioridad
      if(isset($_POST["id"]))//Si existe el id, es modificacion
        modificarNoticia( $_POST["id"], $_POST["titulo"], $_POST["subtitulo"], $_POST["entradilla"], $_POST["fechaCreacion"], $fecha, $_POST["foto"], $_POST["foto1"], $_POST["estado"], $_POST["seccion"], $_POST["autor"], $_POST["cuerpo"], $_POST["prioridad"] );
      else
        insertarNoticia( $_POST["titulo"], $_POST["subtitulo"], $_POST["entradilla"], $fecha, $fecha, $_POST["foto"], $_POST["foto1"], $_POST["estado"], $_POST["seccion"], $_POST["autor"], $_POST["cuerpo"], $_POST["prioridad"] );

      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarNoticias.php"</script>';
    } else if (isset($_GET["c"])) { //Para mostrar la modificacion
      escribeFormularioModificar();
    } else if (isset($_GET["cm"])){ //Eliminar comentario
      eliminarNoticia($_GET["cm"]);
      echo '<script>location.href="',$GLOBALS["ruta"],'gestion/listarNoticias.php"</script>';
    } else { //Muestra el formulario vacio
      escribeFormularioNuevo();
    }
	}
?>
