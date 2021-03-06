<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
Página para el manejo (visualización) de errores criticos del sitio
Tipos de errores:
100 - 199: de BD
200 - 299: de Autenticación
300 - 399: de Sesión
-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="../style/styleLogin.css" type="text/css" rel="stylesheet" />
		<title>ERROR</title>
	</head>
	<body id="login-page">
		
		<div class="login-wrap">
			<div class="mensaje">
				<div class="logo">
					<img width="200" height="150"  src="../style/images/error.gif" />
				</div>
				<h2>Error <?php if (isset($error)) {echo $error;} else {$error='000'; echo $error;}?></h1>
				</hr>
				<h1>Descripción:</h2>
				<p>
				<?php 
					switch($error)							//segun el nivel de acceso del usuario llamo a su pagina principal
						{
						//------------------------------------------ Errores varios
						case '000': 	//Error de tipo desconocido
							echo 'Ocurri&oacute un error no especificado.';				
							break;
						//------------------------------------------ Errores de BD
						case '100': 	//Error de conexion con BD
							echo 'Hubo un fallo tratando de establecer la conexi&oacute;n con la Base de Datos';				
							break;
						case '101': 	//Error de consulta a la BD
							echo 'Ocurri&oacute un error tratando de realizar una consulta a la BD';				
							break;
						//------------------------------------------ Errores de Autenticación
						case '200': 	//Error de sesión iniciada
							echo 'Este usuario ya ha iniciado sesi&oacute;n en el sistema y se encuentra utilizando el mismo.';				
							break;
						case '201': 	//Usuario o clave incorrecta
							echo 'El usuario o la clave ingresados son incorrectos o no estan registrados en el sistema, por favor verifique sus datos y si desea vuelva a intentar la autenticación de los mismos.<br> <br>Si Usted no cuenta con un usuario y clave de acceso puede ingresar como contribuyente o, de ser necesario, solicitar un usuario y clave al administrador del sistema.';				
							break;	
						case '202':		//Usuario registrado con nivel de acceso erroneo
							echo 'EL usuario esta ingresado en el sistema pero cuenta con un nivel de acceso inexistente o incorrecto.<br> <br>Por favor informe de esta situaci&oacute;n al administrador del sistema.';				
							break;
						
						default:
							echo 'Ocurri&oacute un error no especificado.';				
						}
				?>
				</p> 
				<div class="btnlogeo">
					<?php
						$host  = $_SERVER['HTTP_HOST'];
						echo '<a href="http://'. $host.'/Sigtl/index.php>Intentar Nuevamente.</a>';
					?>
				</div>
			</div>
		</div>
</body>
</html>

