<?php 
require_once "./usuarios.php";								//importo la clase usuarios



class control
{


/*** Attributos: ***/

/*** Funciones o metodos: ***/
public function __construct ()	{							//constructor

		
}

public function bajaUsuario () {
$u = unserialize($_SESSION["usuarioRegistrado"]);			//deserializo el objeto usuario serializado en una variable de sesión 
$u->bajaUsuario();											//invoco el metodo bajausuario de la clase usuarios importada previamente
}


}
?>
