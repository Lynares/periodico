<!DOCTYPE HTML>

<html lang="es">

	<?php

		$sec = "seccion";
		require_once('../comun/head.php');


		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>

		<section id="cuerpo">

			<?php
				$idSeccion = $_GET["seccion"]; //Obtenemos la seccion del GET

				//$noticiasSub = Noticia::obtenerNoticiasOrdenadasSubSeccion($idSeccion); //Obtenemos las noticias pertenecientes a esta seccion
				$noticiasSub = obtenerNoticiasOrdenadasSubSeccion($idSeccion); //Obtenemos las noticias pertenecientes a esta seccion
				//$noticias2 = Noticia::obtenerNoticiasOrdenadasSeccion($idSeccion); //Obtenemos las noticias pertenecientes a esta seccion
				$noticias2 = obtenerNoticiasOrdenadasSeccion($idSeccion); //Obtenemos las noticias pertenecientes a esta seccion



				/*$pad = obtenerSeccionPadre($idSeccion);
				//echo $pad;
				if($pad!=0){ //Si tiene seccion padre
					$pad = obtenerSeccion( $pad );
					echo '<a href="#">',$pad->get("nombre"),'</a>';
					echo $idSeccion->get("nombre");
				} else {
					echo '<a href="#">',$idSeccion->get("nombre"),'</a>';
				}*/

				//echo $idSeccion->get("nombre");
				//Si tiene subsecciones creamos el submenu
				$subSec = obtenerSubsecciones($idSeccion);
				$seccion = obtenerSeccion($idSeccion);
				$pad = obtenerSeccionPadre($idSeccion);
				echo '<div id="menuSecc">';
				if($subSec[1]!=0){
						echo '<ul>
										<li>
											<a href="',$ruta,'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a>
										</li>
									';
						for($x=0;$x<$subSec[1];$x++){
									echo '
										<li>
											<a href="',$ruta,'noticias/seccion.php?seccion=',$subSec[0][$x]->get("id"),'">',$subSec[0][$x]->get("nombre"),'</a>
										</li>
										';
						}
						echo '</ul>';
					}else if($subSec[1]==0){
						if($pad!=0){ //Si tiene seccion padre
							$pad = obtenerSeccion( $pad );
							echo '
								<ul>
										<li><a href="',ruta(),'noticias/seccion.php?seccion=',$pad->get("id"),'">',$pad->get("nombre"),'</a></li>
										<li><a href="',ruta(),'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a></li>
								</ul>
							';

						} else {
							echo '
								<ul>
										<li><a href="',ruta(),'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a></li>
								</ul>';
						}
						/*echo '<li>
										<a href="',$ruta,'noticias/seccion.php?seccion=',$seccion->get("id"),'">',$seccion->get("nombre"),'</a>
									</li>
									';*/
					}
					echo '</div>';

				//Mezcla los dos arrays de noticias
				if($noticiasSub[1] == 0)
					$noticias = $noticias2;
				else if($noticias2[1] == 0)
					$noticias = $noticiasSub;
				else
					$noticias = array_merge($noticiasSub, $noticias2);

				$numeroDeNoticias = $noticias[1];

				//Si el numero de noticias no llega a 12 se hace una particion adecuada para columnas
				if($numeroDeNoticias<4)
					$corte = floor($numeroDeNoticias/2); //columnas
				else
					$corte = 4/2; //columnas

				//Mientras que queden noticias o se escriban menos de 12
			for($i=0;$i<$numeroDeNoticias && $i<4;$i++){
				$noticia = $noticias[0][$i]; //Obtenemos una noticia

				if($i==0)
						echo '<section id="seccIzq">';
				else if($i == $corte)
						echo '<section id="seccDer">';

				/* Obtenemos la seccion de la noticia*/
				$seccion = obtenerSeccion($noticia->get("seccion"));
				if($seccion->get("subseccion")!=NULL){ //Si pertenece a otra seccion
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

				echo '
				<article class=noticia>
					<a href="',rutaWeb(),'noticias/noticia.php?noticia=',$noticia->get("id"),'">
						<div>
							<h4>',$noticia->get("titulo"),'</h4>
							<p>',$noticia->get("subtitulo"),'</p>
							<img src="',rutaWeb(),'images/',$rutaSeccion,'/',$noticia->get("foto1"),'" width="200px" height="100px">
							<p>Escrito por ',$autor,'</p>
						</div>
					</a>
				</article>
				';

				if($i==$corte-1 || $i==$numeroDeNoticias-1)
					echo "</section>";
			}

			?>

			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
