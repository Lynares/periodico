<?php

function escribeBuscar(){
  echo '
  <form id="form_buscar" action="#">
    <label>Busqueda de Noticia:</label>
    <section id="listaRenueva">
      <input type="text" id="like" name="like" onKeyUp="comprobarLike()"/>
      <ul id="rellena_lista">
      </ul>
    </section>
  </form>
  ';
}

function escribeIconos(){
  $ruta = ruta();

  if($_SESSION["seccion"]=="noticia"){
    $idNoticia=$_GET["noticia"];
		echo '
				<a href="noticia_imprimir.php?noticia=',$idNoticia,'" class="redesSociales"><img src="../images/imprimir.png"></a>
		';
	}

  if($_SESSION["seccion"]=="index" || $_SESSION["seccion"]=="seccion"){
		echo '
					<a href="https://www.facebook.com" class="redesSociales"><img src="', $ruta ,'images/facebook_gris.png"></a>
					<a href="https://www.twitter.com" class="redesSociales"><img src="', $ruta ,'images/twitter_gris.png"></a>
					<a href="https://plus.google.com" class="redesSociales"><img src="', $ruta ,'images/gplus_gris.png"></a>';
	}
	if($_SESSION["seccion"]=="noticia"){

		//$noticia = Noticia::obtenerNoticia($idNoticia);
    $noticia = obtenerNoticia($idNoticia);
		$ti=$noticia->get("titulo");
		$im=$noticia->get("foto");
    // Arreglar esto:
    $se=$noticia->get("seccion");

   if($se==1){
     $rs=local;
   } else if($se==3){
     $rs=economia;
   } else if($se==4){
     $rs=politica;
   }else{
     $rs=deportes;
   }

    echo '
			<div id="oculto">
				<input type="text" id="ti" value="',$ti,'">
				<input type="text" id="im" value="',$im,'">
			</div>
			';
		echo '

        <a href="#miModalF" class="redesSociales"><img src="', $ruta ,'images/facebook_gris.png"></a>
        <div id="miModalF" class="modal">
          <div class="modal-contenido">
            <a href="#">X</a>
            <h2>Se publicar&aacute; en Facebook el siguiente mensaje:</h2>
            <p>',$ti,'</p>
            <img src="',$ruta,'images/',$rs,'/',$im,'">
            <p>via @lagranada</p>
            <a href="#">Aceptar</a>
          </div>
        </div>

        <a href="#miModalT" class="redesSociales"><img src="', $ruta ,'images/twitter_gris.png"></a>
        <div id="miModalT" class="modal">
          <div class="modal-contenido">
            <a href="#">X</a>
            <h2>Se publicar&aacute; en Twitter el siguiente mensaje:</h2>
            <p>',$ti,'</p>
            <img src="',$ruta,'images/',$rs,'/',$im,'">
            <p>via @lagranada</p>
            <a href="#">Aceptar</a>
          </div>
        </div>
        <a href="#miModalG" class="redesSociales"><img src="', $ruta ,'images/gplus_gris.png"></a>
        <div id="miModalG" class="modal">
          <div class="modal-contenido">
            <a href="#">X</a>
            <h2>Se publicar&aacute; en Google Plus el siguiente mensaje:</h2>
            <p>',$ti,'</p>
            <img src="',$ruta,'images/',$rs,'/',$im,'">
            <p>via @lagranada</p>
            <a href="#">Aceptar</a>
          </div>
        </div>
        ';
	}
}

function noticiasRelacionadas(){
    $ruta = ruta();
    $idNoticia=$_GET["noticia"];
    $noticia = obtenerNoticia($idNoticia);
    $noticias = obtenerNoticiasVarias($noticia->get("seccion"), 10);

    if($noticias[1]>1){//Mayor que uno para que no se cuente a si misma
      echo '<section id="noticiasRelacionadas">';
      echo '<p>Noticias Relacionadas:</p>';
        for($i=0;$i<$noticias[1];$i++){
          $noticia = $noticias[0][$i];
          if($noticia->get("id")!=$idNoticia){
            echo '
              <article class="relacionada">
                - <a href="',$ruta,'noticias/noticia.php?noticia=',$noticia->get("id"),'">',$noticia->get("titulo"),'</a>
              </article>
            ';
          }
        }
    echo '
        </section>
        ';
    }
}

function escribeComentariosNoticia(){
  $idNoticia=$_GET["noticia"];
  $comentarios = obtenerComentariosVarios($idNoticia);

  echo '<section id="oculto">';
    echo '<input type="hidden" id="ruta_actualJ" value="',$_SESSION["ruta_actual"],'"/>';
    echo '<input type="text" id="usuarioActual" value="',$_SESSION["usuario"],'"/>';
    echo '<input type="text" id="idNoticia" value="',$idNoticia,'"/>';
  if($comentarios[1]>0){
    echo'
      <input type="text" id="todos" value="',$comentarios[1],'"/>
    ';

    $tot = $comentarios[1];
    if($tot>=3)
      $tot = 3;

    for($i=0;$i<$tot;$i++){
      $comentario = $comentarios[0][$i];
      $usuario = obtenerNombreUsuario($comentario->get("usuario"));
      $usuario = strtoupper($usuario);
      echo '
        <input type="text" id="cUsuario',$i,'" value="',$usuario,'"/>
        <input type="text" id="cTexto',$i,'" value="',$comentario->get("texto"),'"/>
        <input type="text" id="cFecha',$i,'" value="',$comentario->get("fecha"),'"/>
      ';
    }
  } else {
    echo'
      <input type="text" id="todos" value="0"/>
    ';
  }
echo '</section>';
}

//Obtiene las palabras prohibidas de la base de datos
function escribePalabras(){
  $palabras = obtenerPalabras();

  echo '<div id="oculto">';
  echo '<input type="text" id="totalPalabras" value="',$palabras[1],'"/>';
  for($i=0;$i<$palabras[1];$i++){
    echo '<input type="text" id="palabra',$i,'" value="',$palabras[0][$i]->get("palabra"),'"/>';
  }
  echo '</div>';
}

function escribePublicidad(){
  $ruta = ruta();
  echo '<section id="contenedor_columnaAux">';
    // Mostramos en index la publicidad con prioridad 1 solamente
    if($_SESSION["seccion"]=="index")
      $sec = 1;
    else
      $sec = 0;

    $publicidad = obtenerPublicidadPrioridad($sec);

    if($publicidad[1]==0){
      echo '<img id="contentP" src="', $ruta ,'images/anunciate.jpg"/>';
    }else{
      $random = rand(0,$publicidad[1]-1);

      if($publicidad[0][$random]->get("texto")!="")
         echo '<p id="textoPubli">',$publicidad[0][$random]->get("texto"),'</p>';

      echo '
        <a href="',$ruta,'comun/intermedioPublicidad.php?pb=',$publicidad[0][$random]->get("id"),'" target="_blank">
          <img id="contentP" src="', $ruta ,'images/publicidad/',$publicidad[0][$random]->get("img"),'"/>
        </a>
      ';
    }
  echo '</section>';
}

function escribeAux(){
  	$ruta = ruta();
  echo '
  		<section id="columnaAux">
  			<section id="contenido_columnaAux">
  		';

      escribeBuscar();

      escribeIconos();

    //Si esta conectado el Editor Jefe o el admin
    $usuContectado = obtenerUsuario( $_SESSION["usuario"] );
    if($_SESSION["usuario"]!=0 && $usuContectado->get("rol")>=3){
      echo '<section id="contenedor_columnaAux"></section>';
      echo '
        <p id="tituloGestion">Menu Gesti&oacute;n</p>
        <ul id="menuGestion">
          <li><a href="',ruta(),'gestion/listarComentarios.php">Gesti&oacute;n de Comentarios</a></li>
          <li><a href="',ruta(),'gestion/listarUsuarios.php">Gesti&oacute;n de Usuarios</a></li>
          <li><a href="',ruta(),'gestion/listarNoticias.php">Gesti&oacute;n de Noticias</a></li>
          <li><a href="',ruta(),'gestion/listarSecciones.php">Gesti&oacute;n de Secciones</a></li>
          <li><a href="',ruta(),'gestion/listarPalabras.php">Gesti&oacute;n de Palabras</a></li>
          <li><a href="',ruta(),'gestion/listarPublicidad.php">Gesti&oacute;n de Publicidad</a></li>
          <!--<li><a href="',ruta(),'gestion/listarRoles.php">Gesti&oacute;n de Roles</a></li>-->
        </ul>
      ';
    } else { //Si el usuario no tiene permisos para gestionar.

      	if($_SESSION["seccion"]=="noticia"){
      		echo '
      				<button type="button" onclick="escribir_comentarios()">
      						Deja aqu&iacute; tu comentario.
      				</button>
      		';

          noticiasRelacionadas();
          escribePalabras();
      	}

      escribePublicidad();

      escribeComentariosNoticia();
    }

    echo '
    	 </section> <!-- Fin Contenido ColumnaAux -->
  		</section> <!-- FIN columnaAux -->
  ';

  }

?>
