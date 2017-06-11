<?php   
//****************************//
		function buscar($campos,$tabla,$condicion)
	{
	/*cristhian mendoza 03/11/2016 funcion buscar algo de base de datos*/
		$sql="select ".$campos." from ".$tabla." where ".$condicion;

		 include("config.php");
		 return $resultado;
		
	}
//****************************//
		function nuevo($tabla,$campos,$valores)
	{
	/*cristhian mendoza 04/11/2016 funcion buscar algo de base de datos*/
		$sql="INSERT INTO  $tabla ( $campos ) VALUES( $valores )";
		//imprimir($sql);
		 include("config.php");
		 if($conexion-> affected_rows > 0 ) 
		{ 
			echo "<script>location.href='nuevo.php' </script>";

		}else{
				echo  "Error: los datos no se han guardado. Es probale que la información ya se encuentre en el sistema.";
			}

		 return $resultado;
		
	}
//****************************//
		function eliminar_tabla($tabla,$condicion)
	{
	/*cristhian mendoza 05/11/2016 funcion buscar algo de base de datos*/
		$sql="DELETE FROM  $tabla $condicion ";
		
		 include("config.php");
		if($conexion-> affected_rows > 0 ) 
		{ 
			echo  "Los datos se han eliminado correctamente.";

		}else{
				echo  "Error: los datos no se han eliminado. La información continua en el sistema.";
			}

		 return $resultado;
		
	}
//****************************//
		function drop_table($tabla)

	{
	/*cristhian mendoza 27/11/2016 funcion elimina tabla de base de datos*/
		$sql="DROP TABLE $tabla ";
		
		 include("config.php");

		 
			echo  "La tabla se ha eliminado correctamente.";

		
		
	}
//*********************
//****************************//
		function eliminar_dato_tabla($tabla,$primarykey,$documento,$enlacefinal)
	{
	/*cristhian mendoza 13/11/2016 funcion buscar algo de base de datos*/
		$sql="DELETE FROM $tabla WHERE $primarykey='$documento'";
		
		 include("config.php");
		$conexion->query( $sql );
		if($conexion-> affected_rows > 0 ) 
		{ 
				echo "<script>location.href='$enlacefinal' </script>";			

		}else{
				echo  "Error: los datos no se han eliminado. La información continua en el sistema.";
			}

		 return $resultado;
		
	}
//*********************
//****************************//

function mostrartabla($tabla,$enlaceeli,$primarykey,$enlacefinal)
	/*cristhian mendoza 25/11/2016 funcion muestra todo el contenido de una tabla de la datos de base de datos contiene opciones para editar y eliminar*/
	{
		
$sql="SELECT * FROM  $tabla ";
include("config.php");
$resultado = $conexion->query( $sql );
echo "	<table class='table table-condensed ' border=3px> 
		<tr>
				<td>documento</td>
				<td>nombre</td>	
				<td>celular</td>	
				<td>fecha registro</td>	
				<td>editar</td>
				<td>eliminar</td>
		</tr>";

while ($row=mysqli_fetch_row($resultado)) 
{
	echo "<tr>
				<td>".$row[0]."</td>
				<td>".$row[1]."</td>	
				<td>".$row[2]."</td>
				<td>".$row[3]."</td>
				<td><button class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal2'></button></a></td>
				<td><a id='eliminarnegro' href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey' ><button class='glyphicon glyphicon-trash'></button></a></td>
		</tr>"	;

}
echo "	</table>";	

	}		
//////////////////////////////////////////////////////////////


	/*cristhian mendoza 25/11/2016 funcion muestra formulario donde se pueden editar datos */
	/*para mostrar datos por medio de un formularo hay que tener en cuenta los campos que contiene la tabla a modificar su llave primaria y que el config este dirigido a la base de datos donde se encuentran los datos*/
function mostrarformulario($tabla,$enlace)
	{
		$documento=$_GET['documento'];
				session_start();
				$_SESSION['documento']=$documento;
				 $sql= "SELECT * FROM $tabla WHERE documento='$documento'";
				 include("config.php");
				 $resultado = $conexion->query( $sql );	
				 $row=mysqli_fetch_row($resultado);
				 echo "<form class='form-horizontal' action='$enlace'>";
				 echo "	<br>documento<br><input type='text' class='form-control' name='cj1' value=".$row[0]." required>";
				 echo "	<br>Nombre<br><input type='text' class='form-control' name='cj2' value=".$row[1]." required>";
				 echo "	<br>Celular<br><input type='text' class='form-control' name='cj4' value=".$row[2]." required>";
				 echo "	<br><input type='submit' value='Actualizar'> ";
				 echo "</form>";
	}


	/////////////////////////////////////////////////////////////////////////
/*cristhian mendoza 25/11/2016 esta funcion actualiza los datos cambiados en el formulario*/
function actualizardato($tabla,$documento,$nombre,$celular,$enlace)
	{

		session_start();
		$sql="update $tabla set documento='$documento',nombre='$nombre',celular='$celular' where documento='$_SESSION[documento]' ";
		
		include("config.php");
		$resultado = $conexion->query( $sql );	
		echo "<script>location.href='$enlace' </script>";
	}

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
function actualizardatoupdate($table,$camposandvalues,$idcon)
	{

			
		$sql="update $table set $camposandvalues where $idcon ";
		
		include("config.php");
		if($conexion-> affected_rows > 0 ) 
		{ 
			echo "<center><br/><b style='color:green; font-size:15rem' >Los datos se han actualizado.</b></center>";
		//echo "<script>location.href='actualizar.php' </script>";

		}else{
				echo  "<center><br/><b style='color:red; font-size:15rem' >Error: los datos no se han actualizado.</b></center> ";
			}

		
	}
//////////////////////////////////////////////////////////////////////////
/*	validacion para saber si algun campo es nulo*/
function isnull($usuario, $nombre, $celular, $email, $contraseña, $repitecontraseña){
	if (strlen(trim($usuario)) < 1 || strlen(trim($nombre)) < 1 || strlen(trim($email)) < 1 || strlen(trim($celular)) < 1 || strlen(trim($contraseña)) < 1 || strlen(trim($repitecontraseña)) < 1 ) 
	{
	return 	true;
	}else{
	return false;	
	}
}
//////////////////////////////////////////////////////////////////////////
/*esta funcion verifica que el email ////////////////////////////////7////
filter_var — Filtra una variable con el filtro que se indique///////////////
El filtro FILTER_VALIDATE_EMAIL valida una dirección de correo electrónico.
*/
function isemail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	return 	true;
	}else{
	return false;	
	}
}
//////////////////////////////////////////////////////////////////////////
/*aqui verificamos que las dos contraseñas sean iguales
strcmp — Comparación de string segura a nivel binario-
Tenga en cuenta que esta comparación considera mayúsculas y minúsculas.
*/
function validacontraseñas($contraseña, $repitecontraseña){
	if (strcmp($contraseña, $repitecontraseña) !== 0) 
	{
	return 	false;
	}else{
	return true;	
	}
}
//////////////////////////////////////////////////////////////////////////
/*para poner limites a los elementos a ingresar
strlen — Obtiene la longitud de un string
trim — Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena*/

function minmax($min, $max, $valor){
	if (strlen(trim($valor)) < $min) 
	{
	return true;
	}else if(strlen(trim($valor)) > $max) 
	{
	return true;
	}else
	{
		return false;
	}

}
//////////////////////////////////////////////////////////////////////////
function usuarioexiste($usuario){

	global $conexion;

	$stmt=$conexion->prepare("SELECT id FROM tb_usuarios WHERE usuario = ? LIMIT 1");

/*La seguridad en las consultas enviadas a la base de datos la daremos con el método bind_param.
Éste método agrega variables a una sentencia preparada como parámetros.
bind_param buscará en la sentencia preparada todos los signos de pregunta ? y los reemplazará por las variables que le asignemos.
Es obligatorio indicar de que tipo es el valor que estamos inyectando, la sintaxis es la siguiente

SELECT * from paises WHERE nombre = ?
bind_param('s', 'Argentina');
SELECT * from paises WHERE nombre = 'Argentina'
Como puede observarse en la primera línea tenemos “nombre = ?”, no escapamos los caracteres ni tampoco agregamos las comillas que encierran la cadena de texto.
El primer parámetro ‘s’ indica que la variable que vamos a reemplazar es de tipo string, aquí la tabla con los tipos permitidos

i variable de tipo entero
d variable de tipo doble
s variable de tipo texto
b variable de tipo blob y se envía en paquetes*/

	$stmt->bind_param("s", $usuario);
	// ejecutamos el query
	$stmt->execute();
    //traemos los resultado	
	$stmt->store_result();
	//verificamos el numero de resultados
	$num= $stmt->num_rows;
	//cerramos la conexion
	$stmt->close();

	//validamos el numero de resultados
	if ($num > 0) 
	{
		return true;
	}else{
		return false;
	}
}
//////////////////////////////////////////////////////////////////////////
function emailexiste($email){

	global $conexion;

	$stmt=$conexion->prepare("SELECT id FROM tb_usuarios WHERE correo = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num= $stmt->num_rows;
	$stmt->close();
	if ($num > 0) 
	{
		return true;
	}else{
		return false;
	}
}
//////////////////////////////////////////////////////////////////////////
function generartoken(){
	//md5 — Calcula el hash md5 de un string
	//uniqid — Generar un ID único
	//mt_rand — Genera un mejor número entero aleatorio
	$generar=md5(uniqid(mt_rand(),false));
	return $generar;
}
//////////////////////////////////////////////////////////////////////////
function hashcontraseña($contraseña){
/*password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash fuerte de único sentido. password_hash() es compatible con crypt(). Por lo tanto, los hash de contraseñas creados con crypt() se pueden usar con password_hash().//////////////////////////////////////////////////////////////////////////////////////
PASSWORD_DEFAULT - Usar el algoritmo bcrypt (predeterminado a partir de PHP 5.5.0). Observe que esta constante está diseñada para cambiar siempre que se añada un algoritmo nuevo y más fuerte a PHP. Por esta razón, la longitud del resultado de usar este identificador puede cambiar con el tiempo. Por lo tanto, se recomienda almacenar el resultado en una columna de una base de datos que pueda apliarse a más de 60 caracteres (255 caracteres sería una buena elección).*/
	$hash=password_hash($contraseña, PASSWORD_DEFAULT);
	return $hash;
}
////////////////////////////////////////////////////////////////////////////////
function registroUsuario($usuario, $contraseña, $nombre, $celular, $email, $fecha_registro){

		global $conexion;
		//$sql="INSERT INTO tb_usuarios (usuario, pass, nombre, celular, correo, fecha_registro) VALUES ($usuario, $contraseña, $nombre, $celular, $email, $fecha_registro)";
		//echo $sql;
		$stmt=$conexion->prepare("INSERT INTO tb_usuarios (usuario, pass, nombre, celular, correo, fecha_registro) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param('ssssss', $usuario, $contraseña, $nombre, $celular, $email, $fecha_registro);
	 	$stmt->execute();
		//verificamos el numero de resultados
		$num= $stmt->affected_rows;
		//validamos el numero de resultados
		if ($num > 0) 
		{
			return true;
		}else{
			return false;
		}
}
////////////////////////////////////////////////////////////////////////////////7
function registros($tabla, $camposbd, $valoresusu){

		global $conexion;

		$stmt= $conexion->prepare("INSERT INTO $tabla ($camposbd) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param('sss', $valoresusu);

 		// if ($stmt->execute()) {
 		// 	return $conexion->insert_id;
 		// }else{
 		// 	return 0;
 		// }
}
////////////////////////////////////////////////////////////////////////////////
function enviaremail($email, $nombre, $asunto, $cuerpo){
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail= new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth=true;
	
	$mail->Host='localhost';
	
	
	$mail->Username='stmendozza@gmail.com';
	$mail->Password='3133957636';

	$mail->setFrom('stmendozza@gmail.com','sistema de usuarios');
	$mail->addAddress($email,$nombre);

	$mail->Subject=$asunto;
	$mail->Body=$cuerpo;
	$mail->IsHTML(true);

	if ($mail->send()) {
		return true;
	}else{
		return false;
	}
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
function resultblock($errors){
	if (count($errors)> 0) {
		echo "<div id='error' class='alert alert-danger' role='alert'><a href='#' onclick=\"showHide('error');\">[X]</a><ul>";
		foreach ($errors as $error) 
		{
				echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";	
	}
}
////////////////////////////////////////////////////////////////////////////////
function isnulllogin($usuario, $contraseña){
	if (strlen(trim($usuario)) < 1 || strlen(trim($contraseña)) < 1 ) 
	{
		return true;
	}
	else
	{
		return false;
	}
		
	
}
?>
