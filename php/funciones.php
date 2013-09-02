<?php 
	function conectar (){
				$host ="localhost";
   				$user="postgres";
				$pwd="pgs161176";
    			$dbase="GisTL";
				//Conexion	
   				$conexion = pg_connect ("host=".$host." user=".$user." password=".$pwd." dbname=".$dbase) or die ("No se pudo establecer coneccion con la base de datos.". pg_last_error());
						return $conexion;
						};

	function CentroideX ($gid) {
							$conexion = conectar();
							$query = "SELECT x(centroid(the_geom)) FROM parcelas WHERE circuns=".$gid;
							//Realizo la consulta
						 	$resulset = pg_query($conexion,$query);
							 $objeto = pg_fetch_object($resulset);	
							return $objeto->x;
							};
							
	
	function CentroideY ($gid) {
							$conexion = conectar();
							$query = "SELECT y(centroid(the_geom)) FROM parcelas WHERE circuns=".$gid;
							//Realizo la consulta
						 	$resulset = pg_query($conexion,$query);
							 $objeto = pg_fetch_object($resulset);	
							return $objeto->y;
							};



?>
