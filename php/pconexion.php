<?php 

require_once "usuarios.php";

$usuario = new usuarios();

$usuario->validarAcceso($_GET['username'],$_GET['password']) ;

echo $usuario->getUser();
echo $usuario->getNivel();

?>	

