<!DOCTYPE HTML>

<html lang="es">
	<?php
		$sec="gestion";
		require_once('../comun/head.php');

		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>


		<section id="cuerpo">
			<section id="listaGestion">
			<h2>Lista de comentarios</h2>
		<?php
			$comentarios = obtenerComentarios();
			echo '
				<a href="',ruta(),'gestion/gestionarComentario.php" id="insertarGestion">Insertar Comentario</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>Fecha</th>
						<th>Ip</th>
						<th>Texto</th>
						<th>Usuario</th>
						<th>Noticia</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$comentarios[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$comentarios[0][$i]->get("id"),'</td>
						<td>',$comentarios[0][$i]->get("fecha"),'</td>
						<td>',$comentarios[0][$i]->get("ip"),'</td>
						<td>',
						substr($comentarios[0][$i]->get("texto"),0,50);
						if(strlen($comentarios[0][$i]->get("texto"))>=50)
							echo '...';
				echo '
						</td>
						<td>',obtenerNombreUsuario($comentarios[0][$i]->get("usuario")),'</td>
						<td>',$comentarios[0][$i]->get("noticia"),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarComentario.php?c=',$comentarios[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarComentario.php?cm=',$comentarios[0][$i]->get("id"),'">
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
