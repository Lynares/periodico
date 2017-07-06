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
						echo '<h2>Nueva publicidad</h2>';
					} else {
						echo '<h2>Modificar publicidad</h2>';
						$publicidad = obtenerPublicidad($_GET["c"]);
					}

					echo '
					<a href="',ruta(),'gestion/listarPublicidad.php" id="insertarGestion">Lista de Publicidad</a>
					';

					require(ruta().'gestion/procesarPublicidad.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
