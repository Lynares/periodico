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
						echo '<h2>Nuevo comentario</h2>';
					} else {
						echo '<h2>Modificar comentario</h2>';
						$comentario = obtenerComentario($_GET["c"]);
					}

					echo '
					<a href="',ruta(),'gestion/listarComentarios.php" id="insertarGestion">Lista de Comentarios</a>
					';

					require(ruta().'gestion/procesarComentario.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
