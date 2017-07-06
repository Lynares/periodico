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
						echo '<h2>Nueva Seccion</h2>';
					} else {
						echo '<h2>Modificar Seccion</h2>';
					}

					echo '
					<a href="',ruta(),'gestion/listarSecciones.php" id="insertarGestion">Lista de Secciones</a>
					';

					require(ruta().'gestion/procesarSeccion.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
