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
						echo '<h2>Nueva Palabra</h2>';
					} else {
						echo '<h2>Modificar Palabra</h2>';
						//$palabra = obtenerPalabra($_GET["c"]);
					}

					echo '
					<a href="',ruta(),'gestion/listarPalabras.php" id="insertarGestion">Lista de Palabras</a>
					';

					require(ruta().'gestion/procesarPalabra.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
