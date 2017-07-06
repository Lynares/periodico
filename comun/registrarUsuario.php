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
				<h2>Registro de usuario</h2>
        <table id="registrarUsuario">
					<?php echo '
					<form action="',ruta(),'comun/procesarRegistrarUsuario.php" method="POST" name="registrarUsuario" id="form_iniciarSesion">
					'; ?>
  					<tr>
              <td>
  						   <label>Nombre:</label>
  						   <input type="text" name="nombre" required/>
              </td>
              <td>
  						   <label>Apellidos:</label>
  						   <input type="text" name="apellidos" required/>
              </td>
            </tr>
            <tr>
              <td>
  						   <label>Contrase&ntilde;a:</label>
  						   <input type="password" name="password" required/>
              </td>
              <td>
                <label>Repita Contrase&ntilde;a:</label>
                <input type="password" name="password2" required/>
              </td>
            </tr>
            <tr>
              <td>
  						   <label>Nombre Usuario:</label>
  						   <input type="text" name="nombreUsuario" required/>
              </td>
              <td>
                <label>Email:</label>
                <input type="email" name="email" required/>
              </td>
            </tr>

  					<?php
  						echo '<input type="hidden" name="rutaClick" value="',$_POST["rutaClick"],'"/>';
  					?>
						<tr>
							<td colspan="2">
  					<input type="submit" id="boton" name="Aceptar" value="Enviar"/>
							</td>
						</tr>
  				</form>
        </table>
			</section>

			<?php escribeFooter(); ?>
		</section><!--Cuerpo-->

		<?php escribeAux(); ?>

	</body>
</html>
