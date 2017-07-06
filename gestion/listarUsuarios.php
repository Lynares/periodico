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
			<h2>Lista de Usuarios</h2>
		<?php
			$usuarios = obtenerUsuarios();
			echo '
				<a href="',ruta(),'gestion/gestionarUsuario.php" id="insertarGestion">Insertar Usuario</a>
				<table id="tablaLista">
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Nombre de Usuario</th>
						<th>Email</th>
						<th>Rol</th>
						<th>Gesti&oacute;n</th>
					</tr>
				';

			for($i=0;$i<$usuarios[1];$i++){
				echo '
					<tr class="listaT',$i%2,'">
						<td>',$usuarios[0][$i]->get("id"),'</td>
						<td>',$usuarios[0][$i]->get("nombre"),'</td>
						<td>',$usuarios[0][$i]->get("apellidos"),'</td>
						<td>',$usuarios[0][$i]->get("nombreUsuario"),'</td>
						<td>',$usuarios[0][$i]->get("email"),'</td>
						<td>',obtenerNombreRol($usuarios[0][$i]->get("rol")),'</td>
						<td>
							<a href="',ruta(),'gestion/gestionarUsuario.php?c=',$usuarios[0][$i]->get("id"),'">
								<img src="',ruta(),'images/modificar.png" alt="Modificar" title="Modificar">
							</a>
							<a href="',ruta(),'gestion/procesarUsuario.php?cm=',$usuarios[0][$i]->get("id"),'">
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
