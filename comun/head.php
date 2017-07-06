<?php

	session_start();
	/*if(!isset($_SESSION["activa"])){ //Si no hay sesion activa.
		$_SESSION["activa"] = "Si";
		session_start();
	}*/

	if(!isset($_SESSION["usuario"])){ //Si no hay usuario activo
		$_SESSION["usuario"] = 0;
	}

	if(!isset($_SESSION["seccion"])){ //Si no hay seccion en eleccion
		$_SESSION["seccion"] = "index";
	}
	$_SESSION["seccion"] = $sec;

	function ruta(){
		if($_SESSION["seccion"]=="index")
			return "";
		else
			return "../";
	}

	function rutaWeb(){
		return "http://localhost/periodico/";
	}

	//Ruta actual de la pagina web
	$_SESSION["ruta_actual"] = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

	$rut = ruta()."BD/";


	//Conecta a la BD
	require_once ($rut.'datosObject.class.inc');
	$conexion = DataObject::conectar();

	$rut = ruta()."controlador/";
	require_once($rut.'cUsuario.php');
	require_once($rut.'cNoticia.php');
	require_once($rut.'cSeccion.php');
	require_once($rut.'cComentario.php');
	require_once($rut.'cPalabra.php');
	require_once($rut.'cRol.php');
	require_once($rut.'cPublicidad.php');
	require_once($rut.'funcionesUtiles.php');

	include(ruta().'comun/colum_aux.php');
	include(ruta().'comun/footer.php');


	//Si esta en cualquier seccion de gestion y no es admin(o editor jefe) lo redirige al index
	if($_SESSION["seccion"]=="gestion" && esAdmin($_SESSION["usuario"])==false)
		echo '<script>location.href="',ruta(),'index.php";</script>';

	//Si es la seccion de insertarNoticia como redactor
	if($_SESSION["seccion"]=="gestion2" && esRedactor($_SESSION["usuario"])==false)
		echo '<script>location.href="',ruta(),'index.php";</script>';


function escribeHead(){
	$ruta = ruta();
echo '
<head>
	<script src="', $ruta ,'js/head.js" type="text/javascript"></script>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />';
//echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '

	<meta name="description" content="Periodico La Granada">
	<meta name="author" content="Alvaro Maximino Linares Herrera, Gines Jesus Fuentes Sanchez">
	<title>La granada</title>
	<link rel="icon" type="image/png" href="', $ruta, 'images/logo.png" />
	<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/comun.css" />
	<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/pie.css" />
	<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/columnaPubli.css" />

	<script src="', $ruta ,'js/buscar.js" type="text/javascript"></script>
	';


	if($_SESSION["seccion"]=="noticia"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/noticias.css" />
			  <script src="', $ruta, 'js/comentarios.js" type="text/javascript"></script>';
	} else if($_SESSION["seccion"]=="index"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/style.css" />';
	} else if($_SESSION["seccion"]=="seccion"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/seccion.css" />';
	}	else if($_SESSION["seccion"]=="imprimir"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/imprimir.css" />';
	} else if($_SESSION["seccion"]=="usuario"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/usuarios.css" />';
	} else if($_SESSION["seccion"]=="gestion" || $_SESSION["seccion"]=="gestion2"){
		echo '<link rel = "stylesheet"  type = "text/css" href = "', $ruta, 'style/gestion.css" />';
	}

echo '
</head>';
}

function escribeHeader(){
	$ruta = ruta();
	//$secciones = Seccion::obtenerSeccionesPadre();
	$secciones = obtenerSeccionesPadre();

echo '
		<section id="header">
			<!--Cabecera del periodico-->
			<header id="cabecera">
				<a href="', $ruta ,'index.php">La <img src=', $ruta ,'images/logo.png with="40px" height="40px"></a>
			';

			echo '<section id="sectionUsuarios">';
				if($_SESSION["usuario"]==0){
					echo '
						<article>
							<form action="',ruta(),'comun/inicioSesion.php" class="formA" method="POST">
								<input type="hidden" name="rutaClick" value="',$_SESSION["ruta_actual"],'"/>
								<input type="submit" value="Iniciar Sesi&oacute;n"/>
							</form>
						</article>
						<article>
						<form action="',ruta(),'comun/registrarUsuario.php" class="formA" method="POST">
							<input type="hidden" name="rutaClick" value="',$_SESSION["ruta_actual"],'"/>
							<input type="submit" value="Registrate"/>
						</form>
						</article>
					';
				} else {
					//$ruta_actual = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
						//<input type="hidden" id="ruta_actual" value="',$ruta_actual,'"/>
					echo '
						<article>
							Hola ',obtenerNombreUsuario($_SESSION["usuario"]),'
						</article>
						<article>
							<a href="',ruta(),'comun/procesarInicioSesion.php">Cerrar Sesion</a>
						</article>
					';
				}

			echo '</section>';

echo '
			</header>
			<!--menu con las distintas secciones-->
			<nav id="menu">
				<ul id="menu2">';
		echo $secciones[1];
		for($i=0;$i<$secciones[1];$i++){
			$seccion = $secciones[0][$i];
			echo '
					<li id="a',$i,'">
						<a href="',$ruta,'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a>
			';

			//Si tiene subsecciones creamos el submenu
			$subSec = obtenerSubsecciones($seccion->get("id"));
			if($subSec[1]!=0){
					echo '<ul>';
					for($x=0;$x<$subSec[1];$x++){
								echo '
									<li>
										<a href="',$ruta,'noticias/seccion.php?seccion=',$subSec[0][$x]->get("id"),'">',$subSec[0][$x]->get("nombre"),'</a>
									</li>
									';
					}
					echo '</ul>';
			}
			echo '</li>';
		}

		if(esRedactor($_SESSION["usuario"])==true)
			echo '<li><a href="',ruta(),'gestion/gestionarNoticia.php" id="insertarNoticia">Insertar Noticia</a></li>';

echo '
				</ul>
			</nav>
		</section>
';
}

?>
