<!DOCTYPE HTML>

<html lang="es">
<!--Carga imprimir.css, luego en sec tiene que ir imprimir, crearlo en head-->
<?php

  $sec = "imprimir";
  require_once('../comun/head.php');

  escribeHead();
?>

	<body>
    <!--BORRAR Y CREAR FUNCION ESCRIBEHEADERIMPRIMIR-->
		<section id="header">
			<!--Cabecera del periodico-->
			<header id="cabeceraImprimir">
				<a href="../index.php">La <img src=../images/logo.png with="40px" height="40px"></a>
			</header>
		</section>
		<!--Eliminamos la barra de menu-->
    <?php

			$idNoticia = $_GET["noticia"];
			//$noticia = Noticia::obtenerNoticia($idNoticia);
      $noticia = obtenerNoticia($idNoticia);

			//$seccion = Seccion::obtenerSeccion($noticia->get("seccion"));
      $seccion = obtenerSeccion($noticia->get("seccion"));
			if($seccion->get("subseccion")!=NULL){ //Si pertenece a otra seccion
				//$seccionPadre = Seccion::obtenerSeccion($seccion->get("subseccion")); //Consulta la seccion padre
        $seccionPadre = obtenerSeccion($seccion->get("subseccion")); //Consulta la seccion padre
				$rutaSeccion = $seccionPadre->get("ruta"); //La prepara para la ruta de la imagen
			} else {
				$rutaSeccion = $seccion->get("ruta");
			}

			$autor = $noticia->get("autor");
			if($autor==NULL) //Si no tiene autor
				$autor = "Redaccion";
			else
				$autor = obtenerUsuario($autor)->get("nombre");
        //$autor = Usuario::obtenerUsuario($autor)->get("nombre");
		?>

		<section id="cuerpoImprimir">
			<p id="seccionImprimir">
          <?php echo $seccion->get("nombre");?>
      </p>
      <p id="tituloImprimir">
          <?php echo $noticia->get("titulo");?>
      </p><!--Titulo-->
      <section id="subtituloImprimir"
        <p>
          <?php echo $noticia->get("subtitulo");?>
        </p><!--Subtitulo-->
        <p id="entradillaImprimir">
          <?php echo $noticia->get("entradilla");?>
        </p><!--Entradilla-->
      </section>
      <p id="emisorImprimir">
        Escrito por <?php echo $autor;?>.
				Fecha de publicacion: <?php echo $noticia->get("fechaCreacion");?>.
				Ultima modificacion: <?php echo $noticia->get("fechaModificacion");?>.
      </p>
      <section id="cuerpoNoticiaImprimir">
        <img src="../images/<?php echo $rutaSeccion,"/",$noticia->get("foto");?>">
        <p id="textoNoticia">
					     <?php echo $noticia->get("cuerpo");?>
				</p>
      </section>

			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

	</body>
</html>
