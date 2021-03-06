<?php
session_start();

require_once "../usuarios.php";									//importo la clase usuarios

	$usuario = new usuarios();										//instancio un ojeto de clase usuarios


	if ($usuario->validarAcceso($_POST['usr'],$_POST['pass'])==TRUE)	//si el usuario y el pass son validados en la base de datos
	{
		if($usuario->getEstado()!=1)								//y ademas no tiene una sesión iniciada
			{
			
			$_SESSION["s_user"] = $usuario->getUser(); 				//pongo... (quiza deberia guardar como variable de sesión el objeto usuario completo?)
			$_SESSION["dni"] = $usuario->getDni();					 
			$usuario->altaUsuario();								//asiento en la base de datos que el usuario esta utilizando el sistema
			switch($usuario->getNivel())							//segun el nivel de acceso del usuario llamo a su pagina principal
				{
				case '0':											//nivel de usuario con menos privilegios, contribuyente
					header("location: ../principal.php");
					exit;
					break;
				case '1':											//nivel de usuario de mostrador, oficinista o administrativo
					header("location: ../principal.php");
					exit;
					break;
				case '2':											//nivel de usuario jefe de seccion
					header("location: ../principal.php");
					exit;
					break;
				case '3':											//nivel de usuario director de area o secretario
					header("location: ../principal.php");
					exit;
					break;
				case '4':											//nivel de usuario intendente
					header("location: ../principal.php");
					exit;
					break;
				case '5':											//nivel de usuario dataentry
					header("location: ../principal.php");
					exit;
					break;
/*				case '6':											//nivel de usuario no definido
					header("location: ../principal.php");
					exit;
					break;
				case '7':											//nivel de usuario no definido
					header("location: ../principal.php");
					exit;
					break;
				case '8':											//nivel de usuario no definido
					header("location: ../principal.php");
					exit;
					break;
*/				case '9':											//nivel de usuario administrador, desarrollador
					header("location: ../principal.php");
					exit;
					break;
				
				default:
					header("Location: ../error.php?error=202");		//error el usuario no posee un nivel de usuario válido
					exit;
				}
			}
		else												//si el usuario ya tiene sesión iniciada en el sistema se le impide el acceso
			{
			header("Location: ../error.php?error=200");
			exit;
			}		
	
	}
	else //Si el usuario no es validado le informo y le pido que reingrese sus datos
	{
			header("location: ../error.php?error=201");
			exit;
	}
?>
