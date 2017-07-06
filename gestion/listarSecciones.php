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
			<h2>Lista de Secciones</h2>
		<?php
			$secciones = obtenerSecciones();
			echo '
				<a href="',ruta(),'gestion/gestionarSeccion.php" id="insertarGestion">Insertar Seccion</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Ruta</th>
						<th>Sub Seccion de</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$secciones[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$secciones[0][$i]->get("id"),'</td>
						<td><a class="link" href="',ruta(),'gestion/listarNoticiasSec.php?sec=',$secciones[0][$i]->get("id"),'">',$secciones[0][$i]->get("nombre"),'</a></td>
						<td>',$secciones[0][$i]->get("ruta"),'</td>
						<td>',$secciones[0][$i]->get("subseccion"),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarSeccion.php?c=',$secciones[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarSeccion.php?cm=',$secciones[0][$i]->get("id"),'">
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
