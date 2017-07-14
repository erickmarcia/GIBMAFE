<?php 
session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	if (isset($_SESSION['usuario']))
	 	{
			$usuario=$_POST['usuario'];
			$nombre=$_POST['nombre'];
			$celular=$_POST['celular'];
			$correo=$_POST['correo'];

		include ('funciones.php');//llamo la funciones


		$sql = "update tb_usuarios set usuario= '$usuario', nombre= '$nombre', celular='$celular', correo='$correo' where usuario='$_SESSION[usuario]'";
		//echo $sql;
		//indico cuales seran los campos a modificar con sus respectivos valores siguiendo con los parametros que se asigno en la funcion de actualizar
		include("config.php");
		$resultado = $conexion->query( $sql );
			if( $conexion->affected_rows > 0 )
				{	session_destroy();
					session_start();
					$_SESSION['usuario']=$usuario;
					$_SESSION['nombre']=$nombre;
					echo "<script>location.href='usuario.php'</script>";//me retorna a la pantalla inicial

				}else{
						echo "<script> alert ('Error: no se han actualizado los datos de la tabla en la base de datos.') </script>";
						echo "<script>location.href='usuario.php'</script>";//me retorna a la pantalla inicial
					}
//echo "<script>location.href='usuario.php'</script>";//me retorna a la pantalla inicial
		}else{
			
		 	header("location: index.php");
		} 
?>