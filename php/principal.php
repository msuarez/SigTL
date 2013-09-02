<?php
	session_start();		//iniciamos sesion php para acceder y registrar variables
	//require_once "./usuarios.php";									//importo la clase usuarios
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ar" xmlns="http://www.w3.org/1999/xhtml" style="background-color: rgb(200, 220, 220);">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	
	<link rel="stylesheet" type="text/css" href="/Sigtl/style/style.css" />				<!--Enlace con la hoja de estilos de este sitio-->
        <link href="/Sigtl/style/jquery-ui.css" rel="stylesheet" type="text/css"/>			<!--Enlace a los estilos de jquery para UI-->
		
	<script src="../OpenLayers-2.11/OpenLayers.js" type="text/javascript"></script> 	<!--Enlace a version local de libreria Openlayers -->
	<script src="http://maps.google.com/maps/api/js?v=3.3&amp;sensor=false"></script> 	<!--Enlace a API de google maps -->
	<script src="../jquery/jquery-1.7.2.js"></script>									<!--Enlace a jquery-->
	<script src="../jquery/jquery-ui-1.8.21.min.js"></script>							<!--Enlace a jquery UI-->
	<script src="../js/configCatastro.js"></script>										<!--Enlace a configuraci�n para mapa de catastro de OL-->
	<script src="../js/menu.js"></script>												<!--Enlace a generador de men�-->
 		
	<script> //menu acordeon
  			$(document).ready(function() {
				$("#accordion").accordion();
				var tmp= $("#barizq").height();
				$("#map").css("height",tmp);
  			});
  	</script>
        <script language="JavaScript" type="text/javascript">
     		//window.onbeforeunload = preguntarAntesDeSalir;			//detecto cuando se esta por cerrar la pagina o salir de ella hacia otra
			//IMPORTANTE: hay que filtrar el reload y posiblemente algun evento mas
    		

                

              window.onbeforeunload = confirmaSalida;  

              function confirmaSalida()   {    

                
                      window.location.href="/Sigtl/php/logout.php";
                      //return "Vas a abandonar esta pagina. Si has hecho algun cambio sin grabar vas a perder todos los datos.";  
                      alert("Se ha cerrado la sesion del sistema GIS");
                      //begin msuarez
                     
                      //end msuarez

                

              }



                function preguntarAntesDeSalir()
			{// esta funci�n es llamada cuando se cierra o se sale de la pagina y da de baja al usuario en la base de datos
			
			//window.open("logout.php");
                        
			
/*			$.ajax({url: "logout.php",
					error: function(xhr, status, error) {// Boil the ASP.NET AJAX error down to JSON.
														  var err = eval("(" + xhr.responseText + ")");
														  // Display the specific error raised by the server (e.g. not a
														  //   valid value for Int32, or attempted to divide by zero).
														  alert(err.Message);
							}
					}
				)
			.done(function() {alert("El usuario ha salido del sistema"); })
			.fail(function() {alert("Error al intentar dar de baja al usuario actual."); });
									  /*
				.always(function() { alert("complete"); });
			
			/*$.ajax({	url:   "./login/logout.php",		//script a ejecutar que genera en el .map un layer con la data consultada
						success:  function (json) {	 	//si la coneccion con el script tiene exito ejecuta function
						    //return "Esta dejando la aplicacion y se cerrar� su sesi�n.";
							alert("Al abandonar esta p�gina se ha cerrado su sesi�n, para volver a utilizar el sistema vuelva a loguearse.");    
						}
			});*/
			}
		</script>	
		
		<title>Sig Municipal</title>														<!--Titulo de la p�gina -->
	</head>
	
	<body onLoad="init()">

		<div id="contenedor">
			<div id="cabecera"> 
				<div class="titulo">
					S.I.G.   -   Municipal
				</div>
				<?php echo "Usuario: ".$_SESSION["dni"];?>
				<div class="logo">
					<a id="logo" href="http://www.frtl.utn.edu.ar" >
						<img alt="" src="../images/logo FRTL.png">
					</a> 
				</div>
            </div>
		   	
            <span class="separador_invisible"></span>
            
            <div id="barizq">	
				<div id="accordion">
					<h3><a class="linkmenu" href="#">Catastro</a></h3>	<!--href="#" es para que al hacer click sobre el link no te envie a ningun lado-->
					<div class="menu_body">
						<p class="parrafo">
							<form name="consParcela" onsubmit="return parcelaBuscar();">
								<label>Circunscripci&oacute;n (Romano)</label><br/><input type="text" name="txtCirc" id="txtCirc" size=10/><br />
								<label>Secci&oacute;n (Letra)</label><br/><input type="text" name="txtSec" id="txtSec" size=10/><br />
								<label>Chacra</label><br/><input type="text" name="txtChac" id="txtChac" size=10 /><br />
								<label>Quinta</label><br/><input type="text" name="txtQuint" id="txtQuint" size=10/><br />
								<label>Fracci&oacute;n (Romano)</label><br/><input type="text" name="txtFrac" id="txtFrac" size=10/><br />
								<label>Manzana</label><br/><input type="text" name="txtManz" id="txtManz" size=10/><br />
								<label>Parcela</label><br/><input type="text" name="txtParc" id="txtParc" size=10/><br />
								<input type="submit" value="Buscar >>" />
							</form>
                        </p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuSalud();" >Salud</a></h3>
					<div class="menu_body">
						<p class="parrafo">
							  
						</p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuTurismo();">Turismo</a></h3>
					<div class="menu_body">
						<p class="parrafo">
							
						</p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuContribuyentes();">Contribuyentes</a></h3>
					<div class="menu_body">
						<p class="parrafo">
							
						</p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuGestion();">Gesti&oacute;n Municipal</a></h3>
					<div class="menu_body">
						<p class="parrafo">
							
						</p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuCI();">Comercio e industria</a></h3>
					<div class="menu_body">
						<p class="parrafo">
							
						</p>
					</div>
					<h3><a class="linkmenu" href="#" onclick="return menuSeguridad();">Seguridad</a></h3>
					<div class="menu_body">
						<p class="parrafo">
														
						</p>
					</div>
				</div>		
			</div>		
			
			<div id="map"></div>
            
            <!-- <span class="separador_invisible"> </span>-->
            
			
			<div id="footer" align= "center">&copy; 2012 UTN-FRTL - SIG Libre</div>
			
		</div>			
	</body>
</html>
