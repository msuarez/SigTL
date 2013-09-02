<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ar" xmlns="http://www.w3.org/1999/xhtml" style="background-color: rgb(200, 220, 220);">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />			
		<link rel="stylesheet" type="text/css" href="/Sigtl/style/style.css" />
		<link href="/Sigtl/style/jquery-ui.css" rel="stylesheet" type="text/css"/>	
		<script src="./jquery/jquery-1.7.2.js"></script>
		<script src="./jquery/jquery-ui-1.8.21.min.js"></script>
		
		<script> //menu acordeon
  			$(document).ready(function() {
							$("#accordion").accordion();
							var tmp= $("#barizq").height();
							$("#map").css("height",tmp);
  			});
  		</script>
		
	 <title>Bienvenido al SIG </title>

         <script>
                function init() {	//funcion que asegura que la página se cargue con el usuario por defecto aun cuando la misma se cargue desde el historial de un navegador donde se logueo otro usuario
                    var	nombre = document.getElementById("alfa").value; 	//recupero el texto del campo del usuario
                    if (nombre != "Contribuyente") {				// si es distinto al del usuario por defecto
	 		document.location.href = document.location.href;	//cargo la página original de login
                    }
                }
	 </script> 
</headD>

<body onLoad="init()">
    <div id="contenedor">
            <?php 
                  if(isset($mensaje)) {
                      echo "<script type='text/javascript'>alert('Error:".$mensaje."')</script>";				
                  }
            ?>
            <div id="cabecera"> 
                <div class="titulo">
                    S.I.G.   -   Municipal  	
                </div>			
                <div class="logo"> 
                     <a id="logo" href="http://www.frtl.utn.edu.ar" > <img alt="" src="./images/logo FRTL.png"> </a> </div>
                </div>		   	
                <span class="separador_invisible"></span>    
                <div id="barizq">	
                    <div id="accordion">
                        <h3><a class="linkmenu" href="#">Acceso</a></h3><!--href="#" es para que al hacer click sobre el link no te envie a ningun lado-->
                        <div class="menu_body">
                            <p class="parrafo">
                                <form method="post" action="/Sigtl/php/login/entrar.php">
                                    <label>Usuario</label><br/>
                                    <input type="text" name="usr" maxlength="15" size="10" value="Contribuyente" id="alfa"/><br />
                                    <label>Contrase&ntilde;a</label><br/>
                                    <input type="password" name="pass" maxlength="15" size="10" value="1234"/><br />
                                    <input type="submit" value="Continuar >>" />
                                </form>
                            </p>
                        </div>
                    </div>		
                </div>				
            <div id="comunicador_login" >
                    <h5>Si usted es un usuario no registrado solo presione continuar.</h5>
            </div>
            <span class="separador_invisible"> </span>            			
            <div id="footer" align= "center">&copy; 2012 UTN-FRTL - SIG Libre</div>	
    </div>
 </body>
 
</html>	
