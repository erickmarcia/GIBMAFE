<?php 
/*importante poner el session de primera*/
	session_start();
	include "config.php";
/*estoy preguntando si ya se le dio click al botom de enviar*/
	if (isset($_POST['enviar'])) 
	{
		/*recibiendo valores por medio de metodo POST y guardandolo en variables */
		$usuario= $_POST['usuario'] ;
		$contraseña=  $_POST['contraseña'];
		/*creamos la estructura sql de consulta a la base de datos, para saber si la contraseña y el usuario son iguales a los que hay en base de datos y lo guarda en una variable */
		$sql="SELECT usuario FROM tb_usuarios WHERE usuario='".$usuario."' AND pass='".$contraseña."'" ;
		
		/*despues de consultar recupera los datos que trajo la variable sql  */
		$resultado = $conexion->query( $sql );
 		/*pregunta el numero de filas traido en la variable resultado y si exactamente igual a 0 muestra un mensaje de alerta si no inicia sesion con la variable $usuario y enlaza a chat.php*/
		if (mysqli_num_rows($resultado)==0) 
		{
				echo "<script text='text/javascript'>;
						alert('el usuario o la contraseña no coinsiden');
						window.location= 'dsd.php';
					  </script>";
		}else{
					$_SESSION['usuario']=$usuario;
					header("location: stockdispo.php");
		}

	}

 ?>