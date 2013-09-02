<?php 
class bd
{
/**
Implementa el manejo de datos mediante el acceso a una BD postgresql.
**/

/*** Attributos: ***/

	private $host;				//direccion donde esta alojado el servidor
	private $db_name;			//nombre de la base de datos
	private $port;				//puerto en el que escucha el servidor
	private $user;				//nombre del usuario que intenta establecer la conección
	private $pass;				//clave del usuario que intenta establecer la conección
	private $modificar=0;		//no me acuerdo para que puse esto
	private str_conexion		//cadena de conexion 


/*** Funciones: ***/
	public function __construct ()	{
	// constructor de objetos bd
	this->$host='localhost';
	this->$db_name='GisTL';
	this->$port='5432';
	this->$user='user';
	this->$pass='user';
	}
	public function bd (){}
}
?>
