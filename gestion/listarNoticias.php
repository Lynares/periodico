<!DOCTYPE HTML>

<html lang="es">
	<?php
		$sec="gestion2";
		require_once('../comun/head.php');

		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>


		<section id="cuerpo">
			<section id="listaGestion">
			<h2>Lista de Noticias</h2>
		<?php

			//obtiene las noticias del usuario.
			if( esAdmin($_SESSION["usuario"]) == true )
				$noticias = obtenerNoticias();
			else if ( esRedactor($_SESSION["usuario"]) == true )
				$noticias = obtenerNoticiasRedactor( $_SESSION["usuario"] );

			echo '
				<a href="',ruta(),'gestion/gestionarNoticia.php" id="insertarGestion">Insertar Noticia</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>T&iacute;tulo</th>
						<th>Fecha Creacion</th>
						<th>Fecha Modificacion</th>
						<th>Estado</th>
						<th>Prioridad</th>
						<th>Seccion</th>
						<th>Autor</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$noticias[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$noticias[0][$i]->get("id"),'</td>
						<td>',
							substr($noticias[0][$i]->get("titulo"),0,50);
							if(strlen($noticias[0][$i]->get("titulo"))>=50)
								echo '...';
						echo '
						</td>
						<td>',$noticias[0][$i]->get("fechaCreacion"),'</td>
						<td>',$noticias[0][$i]->get("fechaModificacion"),'</td>
						<td>',$noticias[0][$i]->get("estado"),'</td>
						<td>',$noticias[0][$i]->get("prioridad"),'</td>
						<td><a class="link" href="',ruta(),'gestion/listarNoticiasSec.php?sec=',$noticias[0][$i]->get("seccion"),'">',obtenerNombreSeccion($noticias[0][$i]->get("seccion")),'</a></td>
						<td>',obtenerUsuarioNoticia($noticias[0][$i]->get("id")),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarNoticia.php?c=',$noticias[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarNoticia.php?cm=',$noticias[0][$i]->get("id"),'">
								<img src="',ruta(),'images/eliminar.png" alt="Eliminar" title="Eliminar">
							</a>
						</td>
					</tr>
				';
			}
			echo '</table>';
		?>
			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
