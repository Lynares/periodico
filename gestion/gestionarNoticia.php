<!DOCTYPE HTML>

<html lang="es">
	<?php
		$sec="gestion2";
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
						echo '<h2>Nueva Noticia</h2>';
					} else {
						echo '<h2>Modificar Noticia</h2>';
					}

					echo '
					<a href="',ruta(),'gestion/listarNoticias.php" id="insertarGestion">Lista de Noticias</a>
					';

					require(ruta().'gestion/procesarNoticia.php');
        ?>


			</section>
			<?php escribeFooter(); ?>
		</section> <!-- Fin cuerpo -->

		<?php escribeAux(); ?>
	</body>
</html>
