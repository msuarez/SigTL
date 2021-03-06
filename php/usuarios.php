<?php 
class usuarios
{

/*** Attributos: ***/

	private $dni;
	private $nombre;
	private $apellido;
	private $user;
	private $pass;
	private $estado;
	private $nivel;
	private $flagABM=0;
	private $delete=0;
	private $modificar=0;

/*** Funciones o metodos: ***/
	public function __construct ()
	{
		
	}
	
	public function usuarios ($dni,$nombre,$apellido,$user,$pass,$estado,$nivel)
	{
		$this->dni = $dni;
		$this->apellido = $apellido;
		$this->nombre = $nombre;
		$this->user = $user;
		$this->pass = $pass;
		$this->estado = $estado;
		$this->nivel= $nivel;
	}

	
	public function getDni(){ return $this->dni; }
	public function getApellido(){ return $this->apellido; }
	public function getNombre(){ return $this->nombre; }	
	public function getUser(){ return $this->user; }
	public function getPass(){ return $this->pass; }
	public function getEstado(){ return $this->estado; }
	public function getNivel(){ return $this->nivel; }


	public function setDni($var){$this->dni=$var; }
	public function setApellido($var){$this->apellido=$var; }
	public function setNombre($var){$this->nombre=$var; }
	public function setUser($var){$this->user=$var; }
	public function setPassword($var){$this->pass=$var; }
	public function setNivel($var){$this->nivel=$var; }

	public function validarAcceso($user,$pass){
	/*--------------------------------------------- Habria que hacer todo lo de bd modularizado en una clase (ver bd.php) -----------*/
		//genero la cadena de conexion
		$conexion = pg_connect("host=localhost dbname=GisTL port=5432 user=user password=user");
		if (!$conexion){ // si falla la conexion aviso y salgo
			header("location: ./error.php?error='100'");//echo ("Error: Fallo la coneXi&oacute;n con la base de datos:");
			exit;
		}
		//genero la cadena de consulta
		$consulta = "SELECT * FROM usuarios WHERE usuario='".$user."' AND pass='".$pass."'";
		//genero un conjunto de resultados derivados de la consulta realizada sobre la conexion anterior, si no puedo conectar aviso
		$resulset = pg_query($conexion,$consulta) or die("Fallo la coneXi&oacute;n con la base de datos");
						 

			if (pg_num_rows($resulset)>=1)	//si hay al menos un resultado concordante en la BD
				{
					$objeto = pg_fetch_object($resulset); 	//recupero el primer (o único) registro que concuerda
															//y pongo la información relevante en la instancia actual de usuario
					$this->dni= $objeto->dni;				//habria que evitar cargar en el objeto instanciado información clasificada o delicada
					$this->apellido=$objeto->apellido;		//sobre todo si no se encripta y queda accesible 
					$this->nombre=$objeto->nombre;
	 				$this->user=$objeto->usuario;
	 				$this->pass=$objeto->pass;
	 				$this->estado=$objeto->estado;
					$this->nivel=$objeto->nivel;
					$this->altaUsuario();		//doy de alta el usuario en la bd
					return 	TRUE;	 									
				}
		  	else 
	   			{
					return FALSE;			//
	   			}	
		   	pg_close($conexion);	   						 
	}


	public function altaUsuario(){
		//permite dar de alta un usuario que se conecta al sistema quedando como 
		//genero la cadena de conexion
		$conexion = pg_connect("host=localhost dbname=GisTL port=5432 user=user password=user");
		if (!$conexion){ // si falla la conexion aviso y salgo
			header("location: ./error.php?error='100'");//echo ("Error: Fallo la coneXi&oacute;n con la base de datos:");
			exit;
		}
		//genero la cadena de actualización
		$alta = "UPDATE usuarios SET estado='1' WHERE dni='".$this->dni."'";
		$resulset = pg_query($conexion,$alta) or die("Fallo la coneXi&oacute;n con la base de datos al intentar dar de alta al usuario.");	
		//echo $resulset;	
	   	pg_close($conexion);	   						 //cierro la conexion con la base de datos
		return 	TRUE;	 									
	}
		
	public function bajaUsuario(){
		//da de baja a un usuario cuando cuando deja de utilizar el sistema
		//genero la cadena de conexion
		$conexion = pg_connect("host=localhost dbname=GisTL port=5432 user=user password=user");
		if (!$conexion){ // si falla la conexion aviso y salgo
			header("location: ./error.php?error='100'");//echo ("Error: Fallo la coneXi&oacute;n con la base de datos:");
			exit;
		}
		//genero la cadena de actualización
		$baja = "UPDATE usuarios SET estado='0' WHERE dni='".$this->dni."'";
		$resulset = pg_query($conexion,$baja) or die("Fallo la coneXi&oacute;n con la base de datos al intentar dar de baja al usuario.");		
		//echo $resulset.pg_last_error($conexion)."</br>";	
	   	pg_close($conexion);	   						 //cierro la conexion con la base de datos
		return 	TRUE;	 									
	}

/*** Functions Bd: ***/
/*	
	public function saveBD(){
	
			if ($this->flagABM ==1)
				 		{
				 			$conexion = mysql_connect("localhost","root","");
							 mysql_select_db("stockventas", $conexion);
										
						    $consulta = "INSERT INTO usuarios (ape_nomb_user,user,password,nivel) VALUES ('".$this->ape_nomb_user."','".$this->user."','".$this->password."','".$this->nivel."')";
    						 $resulset = mysql_query($consulta, $conexion) or die(mysql_error());
    						 
    						 mysql_close($conexion);
    						 return true;
				 		}
				 	else
				 		{
							return false;				 		
				 		}
		
		
			      }

	
	public function consultBD($id) 
	 	{
				 	if ($this->flagABM ==2)
				 		{
				 			$this->delete = 1;	
							$this->modificar = 1;
				 			$conexion = mysql_connect("localhost","root","");
							 mysql_select_db("stockventas", $conexion);
										
						    $consulta = "SELECT * FROM usuarios WHERE id_usuario=".$id;
    						 $resulset = mysql_query($consulta, $conexion) or die(mysql_error());
    						 
    				
    						  if(($objeto = mysql_fetch_object($resulset)) == TRUE && $objeto->id_usuario != null )   
									{
									$this->id_usuario= $objeto->id_usuario;
									$this->ape_nomb_user=$objeto->ape_nomb_user;
    						 		$this->user=$objeto->user;
			 				 		$this->password=$objeto->password;
			 				 		$this->nivel=$objeto->nivel;
			 				 		    
									return true;	 									
 									}
 							  else 
 							   	{
 							   	return false;	
 							   	}		   						 
    						 
							 mysql_close($conexion);
    						 
				 		}
				 	else
				 		{
							return false;				 		
				 		}
	 	}
	 public function updateBD() 
	 	{
	 			if ($this->modificar == 1)
				 		{
				 			$conexion = mysql_connect("localhost","root","");
							 mysql_select_db("stockventas", $conexion);
										
						    $consulta = "UPDATE usuarios SET ape_nomb_user='".$this->ape_nomb_user."', user='".$this->user."', password='".$this->password."', nivel=".$this->nivel." WHERE id_usuario=".$this->id_usuario;
    						 $resulset = mysql_query($consulta, $conexion) or die(mysql_error());
    						 
    						 mysql_close($conexion);
    						 return true;
				 		}
				 	else
				 		{
							return false;				 		
				 		}
				 	
	 	}
	public function deleteBD() 
	 	{
				 	if ($this->delete == 1)
				 		{
				 			$conexion = mysql_connect("localhost","root","");
							 mysql_select_db("stockventas", $conexion);
										
						    $consulta = "DELETE FROM usuarios WHERE id_usuario=". $this->id_usuario;
						    $resulset = mysql_query($consulta, $conexion) or die(mysql_error());
    						 
    						 mysql_close($conexion);
    						 return true;
				 		}
				 	else
				 		{
							return false;				 		
				 		}	
	 	}
	public function listBD($codigo) 
                 {
                                         
                                                         $conexion = mysql_connect("localhost","root","");
                                                         mysql_select_db("stockventas", $conexion);
                                                                                
                                                    $consulta = "SELECT * FROM usuarios WHERE id_usuario LIKE '%".$codigo."%'";
                                                    $resulset = mysql_query($consulta, $conexion) or die(mysql_error());
                                                        
                                                         
                                                      while( $objeto = mysql_fetch_object($resulset) )   
                                                                        {
                                                                        $datos[] = array ("value" => $objeto->id_usuario,
                                                                                          "apellido_nombre" => $objeto->ape_nomb_user,                                                                        
                                                                                          "user" => $objeto->user,
                                                                                          "password" => $objeto->password,
                                                                                          "nivel" => $objeto->nivel
                                                                                          );                                                                                 
                                                                         }
                                                        
                                                        
                                                     
                                                     mysql_close($conexion);
                                                     
                                                        return $datos; 
                                                         
                }

*/

		
}
?>
