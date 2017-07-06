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
        <?php


					//Si no tiene id asociado es una nueva insercion
          if(!isset($_GET["c"])){
						echo '<h2>Nuevo Usuario</h2>';
					} else {
						echo '<h2>Modificar Usuario</h2>';
						$usuario = obtenerUsuario($_GET["c"]);
					}

					echo '
					<a href="',ruta(),'gestion/listarUsuarios.php" id="insertarGestion">Lista de Usuarios</a>
					';

					require(ruta().'gestion/procesarUsuario.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
