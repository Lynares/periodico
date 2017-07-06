<!DOCTYPE HTML>

<html lang="es">
	<?php

		$sec = "usuario";
		require_once('../comun/head.php');


		escribeHead();
	?>

	<body>
		<?php escribeHeader(); ?>

		<section id="cuerpo">
			<section id="usuarios">
				<h2>Introduzca el nombre de usuario y la contrase&ntilde;a para iniciar sesion</h2>
				<form action="procesarInicioSesion.php" method="POST" name="iniciarSesion" id="form_iniciarSesion">
					<article class="campo">
						Introduzca el nombre de usuario:<br/>
						<input type="text" id="nombreUsuario" name="nombreUsuario" required/>
					</article>

					<article class="campo">
						Introduzca la contrase&ntilde;a:<br/>
						<input type="password" id="password" name="password" required/>
					</article>

					<?php
						echo '<input type="hidden" name="rutaClick" value="',$_POST["rutaClick"],'"/>';
					?>

					<input type="submit" id="boton" name="Aceptar" value="Aceptar"/>
				</form>
			</section>

			<?php escribeFooter(); ?>
		</section><!--Cuerpo-->

		<?php escribeAux(); ?>

	</body>
</html>
