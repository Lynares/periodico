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
			<h2>Lista de Publicidad</h2>
		<?php
			$publicidad = obtenerPublicidadTodas();
			echo '
				<a href="',ruta(),'gestion/gestionarPublicidad.php" id="insertarGestion">Insertar Publicidad</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>Texto</th>
						<th>Img</th>
						<th>Enlace</th>
						<th>Click</th>
						<th>prioridad</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$publicidad[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$publicidad[0][$i]->get("id"),'</td>
						<td>',$publicidad[0][$i]->get("texto"),'</td>
						<td>',$publicidad[0][$i]->get("img"),'</td>
						<td>',$publicidad[0][$i]->get("enlace"),'</td>
						<td>',$publicidad[0][$i]->get("click"),'</td>
						<td>',$publicidad[0][$i]->get("prioridad"),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarPublicidad.php?c=',$publicidad[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarPublicidad.php?cm=',$publicidad[0][$i]->get("id"),'">
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
