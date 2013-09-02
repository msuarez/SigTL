<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
    include ('funciones.php');

			$oMapa =  ms_newMapObj('/var/www/GisTL/maps/GisTL.map'); 			//Genero un objeto mapa vinculado al .map especificado
			$oLayerAux= $oMapa->getLayerByName('Consulta Parcelas');	// Recupero del mapa generado la capa Consulta Parcelas
			if($oLayerAux == true)										// Si la misma existe
			{
			$oMapa->removeLayer($oLayerAux->index);	
			}
		 	$oLayerParcela = $oMapa->getLayerByName('Parcelas'); 			//Obtenemos el layer parcela
			$oLayerAuxParcela =  ms_newLayerObj($oMapa, $oLayerParcela); 	//Clono el layer parcela
			$oLayerAuxParcela->set("name","Consulta Parcelas");				//Le Asigno el nombre
			//$color=$oMapa->addcolor(255, 10, 10);
			//$oLayerAuxParcela->set("color",255 10 10);
			//FORMATEO CORRECTAMENTE LOS PARÁMETROS A BUSCAR que definen un dato de catastro para la cadena de SQL
			$datos="the_geom FROM (SELECT * FROM parcelas WHERE ";
			$hayAlgoAntes=false;
			
			//circunscripción
			if ($_GET['txtCirc']!=''){	$datos=$datos."circuns LIKE '".$_GET['txtCirc']."'";
										$hayAlgoAntes=true;
				}
			//sección
			if ($_GET['txtSec']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."seccion LIKE '".$_GET['txtSec']."'";
				$hayAlgoAntes=true;
				}
			//chacra
			if ($_GET['txtChac']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."chacra LIKE '".$_GET['txtChac']."'";
				$hayAlgoAntes=true;
				}
			//quinta
			if ($_GET['txtQuint']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."quinta LIKE '".$_GET['txtQuint']."'";
				$hayAlgoAntes=true;
				}
			//fraccion
			if ($_GET['txtFrac']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."fraccion LIKE '".$_GET['txtFrac']."'";
				$hayAlgoAntes=true;
				}
			//manzana
			if ($_GET['txtManz']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."manzana LIKE '".$_GET['txtManz']."'";
				$hayAlgoAntes=true;
				}
			//parcela
			if ($_GET['txtParc']!=''){
				if ($hayAlgoAntes){		$datos=$datos." AND ";	}
				$datos=$datos."parcela LIKE '".$_GET['txtParc']."'";
			} 
			//luego concatenamos con el fin de la instruccion
			$datos=$datos.") As foo USING UNIQUE gid USING srid=22195"; 
			//Consulta para obtener dato geografico
			$oLayerAuxParcela->set("data",$datos);

			$oClassAuxParcela = $oLayerAuxParcela->getClass(0);
            $oStyleAuxParcela = $oClassAuxParcela->getStyle(0);
            $oColorAuxParcela = $oStyleAuxParcela->color; 
            $oColorAuxParcela->setRGB(200, 180, 250);
			
			//$oMapa->Save('../../GisTL/maps/GisTL.map');
			$oMapa->Save('/var/www/GisTL/maps/GisTL.map');
			//$jsonrequest["x"] = CentroideX ($_GET['circunscripcion']);
			//$jsonrequest["y"] = CentroideY ($_GET['circunscripcion']);
			
			//echo  json_encode($jsonrequest);
	
?>
