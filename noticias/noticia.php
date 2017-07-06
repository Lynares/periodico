<!DOCTYPE HTML>

<html lang="es">

	<?php

		$sec = "noticia";
		require_once('../comun/head.php');


		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>
		<?php

			$idNoticia = $_GET["noticia"];
			$noticia = obtenerNoticia($idNoticia);

			$seccion = obtenerSeccion($noticia->get("seccion"));
			if($seccion->get("subseccion")!=NULL){ //Si pertenece a otra seccion
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

			//
			$busqueda = $_GET["busqueda"];
		?>

		<section id="cuerpo">
			<div id="seccion">
				<p id="textSeccion">
				<?php
					$pad = obtenerSeccionPadre($seccion->get("id"));
					//echo $pad;
					if($pad!=0){ //Si tiene seccion padre
						$pad = obtenerSeccion( $pad );
						echo '<a href="',ruta(),'noticias/seccion.php?seccion=',$pad->get("id"),'">',$pad->get("nombre"),'</a>-->';
						echo $seccion->get("nombre");
					} else {
						echo '<a href="',ruta(),'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a>';
					}
				?>
				</p>
				<?php
				if(esAdmin($_SESSION["usuario"])==true)
					echo '<a href="',ruta(),'gestion/gestionarNoticia.php?c=',$_GET["noticia"],'" id="editarNoticia" >Editar Noticia</a>';
				 ?>
			</div>
			<p id="titulo">
				<?php //echo $noticia->get("titulo");?>
				<?php
						$bs = str_replace($busqueda, '<b class="palabraBusqueda">'.$busqueda.'</b>', $noticia->get("titulo"));
						echo $bs;
				?>
			</p><!--Titulo-->
			<section id="subtitulo">
				<p><?php echo $noticia->get("subtitulo");?></p><!--Subtitulo-->
				<p id="entradilla">
					<?php //echo $noticia->get("entradilla");?>
					<?php
							$bs = str_replace($busqueda, '<b class="palabraBusqueda">'.$busqueda.'</b>', $noticia->get("entradilla"));
							echo $bs;
					?>
				</p><!--Entradilla-->
			</section>
			<p id="emisor">
				Escrito por <?php echo $autor;?>.
				Fecha de publicacion: <?php echo $noticia->get("fechaCreacion");?>.
				Ultima modificacion: <?php echo $noticia->get("fechaModificacion");?>.
			</p>
			<section id="cuerpoNoticia">
				<p id="textoNoticia">
					<img src="../images/<?php echo $rutaSeccion,"/",$noticia->get("foto");?>">
					<?php echo $noticia->get("cuerpo");?>
				</p>
			</section><!--CuerpoNoticia-->

			<?php escribeFooter(); ?>

		</section><!--Cuerpo-->

		<?php escribeAux(); ?>

	</body>
</html>
