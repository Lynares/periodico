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
			<h2>Lista de Palabras</h2>
		<?php
			$palabras = obtenerPalabras();
			echo '
				<a href="',ruta(),'gestion/gestionarPalabra.php" id="insertarGestion">Insertar Palabra</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>Palabra</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$palabras[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$palabras[0][$i]->get("id"),'</td>
						<td>',$palabras[0][$i]->get("palabra"),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarPalabra.php?c=',$palabras[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarPalabra.php?cm=',$palabras[0][$i]->get("id"),'">
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
