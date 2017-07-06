<!DOCTYPE HTML>

<html lang="es">
	<?php
		$sec="index";
		require_once('comun/head.php');

		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>


		<section id="cuerpo">
			<!--Creación de las tres columnas de noticias que se nos pide.-->
		<?php
			//$noticias = Noticia::obtenerNoticiasOrdenadas();
			//$noticias = obtenerNoticiasOrdenadas();
			// Insertamos que se muestren las noticias ordenadas por la prioridad
			$noticias = obtenerNoticiasOrdenadasPrioridad();
			$numeroDeNoticias = $noticias[1];

			//Si el numero de noticias no llega a 12 se hace una particion adecuada para columnas
			if($numeroDeNoticias<12)
				$corte = floor($numeroDeNoticias/3); //columnas
			else
				$corte = 12/3; //columnas

			//Mientras que queden noticias o se escriban menos de 12
			for($i=0;$i<$numeroDeNoticias && $i<12;$i++){
				$noticia = $noticias[0][$i]; //Obtenemos una noticia

				if($i==0)
						echo '<section id="noticiasIzq">';
				else if($i == $corte)
						echo '<section id="noticiasCentro">';
				else if($i == $corte+$corte)
						echo '<section id="noticiasDer">';

				/* Obtenemos la seccion de la noticia*/
				//$seccion = Seccion::obtenerSeccion($noticia->get("seccion"));
				$seccion = obtenerSeccion($noticia->get("seccion"));
				if($seccion->get("subseccion")!=NULL){ //Si pertenece a otra seccion
					//$seccionPadre = Seccion::obtenerSeccion($seccion->get("subseccion")); //Consulta la seccion padre
					$seccionPadre = obtenerSeccion($seccion->get("subseccion")); //Consulta la seccion padre
					$rutaSeccion = $seccionPadre->get("ruta"); //La prepara para la ruta de la imagen
				} else {
					$rutaSeccion = $seccion->get("ruta");
				}


				/* Obtenemos el autor de la noticia */
				$autor = $noticia->get("autor");
				if($autor==NULL) //Si no tiene autor
					$autor = "Redaccion";
				else
					$autor = obtenerUsuario($autor)->get("nombre");
					//$autor = Usuario::obtenerUsuario($autor)->get("nombre");

				echo '
				<article class=noticia>
					<a href="noticias/noticia.php?noticia=',$noticia->get("id"),'">
						<div>
							<h4>',$noticia->get("titulo"),'</h4>
							<p>',$noticia->get("subtitulo"),'</p>
							<img src="images/',$rutaSeccion,'/',$noticia->get("foto1"),'" width="200px" height="100px">
							<p>Escrito por ',$autor,'</p>
						</div>
					</a>
				</article>
				';

				if($i==$corte-1 || $i==($corte+$corte-1) || $i==$numeroDeNoticias-1)
					echo "</section>";
			}
		?>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
