// Funcion Ajax para buscar Parcelas
function parcelaBuscar(){
var circ = $("#txtCirc").val();	//le asigno a la variable parcela el texto contenido del textbox txt
	
	
   $.ajax({	data:  $("form[name=consParcela]").serialize(),//valores pasados al script en formato json
			url:   "buscarparcela.php",		//script a ejecutar que genera en el .map un layer con la data consultada
			type:  "GET",					//forma de pasar los parametros 
			dataType: "json",				//formato en el que se pasan y devuelven los valores
			success:  function (json) {	 	//si la coneccion con el script tiene exito ejecuta function
								var capaconsulta= olMap.getLayersByName("Consulta Parcelas");
								alert("entro");
								if (capaconsulta.length!=0){
										olMap.removeLayer(capaconsulta[0],false);
									}
								var layerparcelaConsulta = new OpenLayers.Layer.WMS("Consulta Parcelas",
																				urlWMS+mapaTL,
																				{layers: 'Consulta Parcelas',  transparent: true},
																				{isBaseLayer: false});  
								alert('Se ejecuto buscaparcela.php con success y entro al codigo de la funcion parcelaBuscar del ajax');
/*								alert(layerparcelaConsulta);
								
								select = new OpenLayers.Layer.Vector("Selection", {styleMap: 
													new OpenLayers.Style(OpenLayers.Feature.Vector.style["select"])
																					});
								hover = new OpenLayers.Layer.Vector("Hover");
								olMap.addLayers([hover, select]);
								
								control = new OpenLayers.Control.GetFeature({
									protocol: OpenLayers.Protocol.WFS.fromWMSLayer(layerparcelaConsulta),
									box: true,
									hover: true,
									multipleKey: "shiftKey",
									toggleKey: "ctrlKey"
								});
								control.events.register("featureselected", this, function(e) {
									select.addFeatures([e.feature]);
								});
								control.events.register("featureunselected", this, function(e) {
									select.removeFeatures([e.feature]);
								});
								control.events.register("hoverfeature", this, function(e) {
									hover.addFeatures([e.feature]);
								});
								control.events.register("outfeature", this, function(e) {
									hover.removeFeatures([e.feature]);
								});
								olMap.addControl(control);
								control.activate();
*/								
								olMap.addLayer(layerparcelaConsulta); 							//2� lo agrego al mapa de la pagina
								var marco = new OpenLayers.Bounds();
								alert(layerparcelaConsulta.getDataExtent());
								marco = layerparcelaConsulta.getDataExtent();
								olMap.zoomToExtent(marco);
								olMap.redraw;
					}
			});
return false;					//retorna falso para detener la ejecucion del form que llama al script
} 

function menuSalud(){
		
	alert("Mapa mostrando ubicaciones de centros de salud con popups donde se explique para cada centro cuales son los servicios que presta, areas de acci�n, eventos y avisos estacionales como 'Atenci�n: esta vigente la temporada de aplicaci�n de la vacuna antigripal para ancianos y ni�os.', datos de contacto del centro, direccion etc.");
	
	return false;
}

function menuTurismo(){
		
	alert("Mapa que presentar� visualmente: areas de recreaci�n, pesca deportiva, alojamientos, gastronom�a, oficinas de informes, servicios al viajero, estaciones de servicio, servicios de salud, cajeros autom�ticos, cine, teatro, campings, medios de transporte, etc.");
	
	return false;
}

function menuContribuyentes(){
		
	alert("Mapa que permitir�a localizar visualmente las propiedadeds a nombre de una persona y mostrar a traves de popups no solo la ubicacion de las mismas sino tambi�n datos como deuda de cada parcela, deuda total deuda por servicio y dem�s informaci�n que pueda ser relevante como moratorias vigentes, planes de regularizaci�n, etc.");
	
	return false;
}

function menuGesti�n(){
		
	alert("Mapa que podr�a mostrar de manera visual como se est� llegando a los diferentes sectores del partido con las distintas obras en curso y proyectadas pudiendo ubicarlas y obtener informaciones como plazo de entrega, descripcion de la obra avisos como 'Precauci�n: circulaci�n restringida hasta..', estado en el que se encuentra la misma, etc.");
	
	return false;
}

function menuCI(){
		
	alert("Mapa que mostrar�a comercios e industrias con sus datos de contacto y separados por categor�as de incumbencias o actividades.");
	
	return false;
}

function menuSeguridad(){
		
	alert("Mapa que mostrara destacamentos policiales, oficinas del jdiciales, servicios de emergencias, etc.");
	
	return false;
}
