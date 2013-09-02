<?php
require_once "./usuarios.php";									//importo la clase usuarios
session_start(); 

$usuario = new usuarios();										//instancio un ojeto de clase usuarios
echo "Usuario creado </br>";
$usuario->setDni($_SESSION['dni']);								//le coloco al usuario el dni recuperado de la variable de sesion php
echo "Dni recuperado:".$usuario->getDni().".- </br>";
$usuario->bajaUsuario();										//método en el que se da de baja al usuario de la base de datos
echo "Usuario dado de baja </br>";
session_destroy(); 

?>
