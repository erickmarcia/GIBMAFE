<?php 
/*conexion a base de datos*/
$conexion=  new mysqli ('localhost', 'root', '' ,'bd_gibmafe2');
if ($conexion->connect_error) {
	die('Error en la conexion' . $conexion->connect_error);
}
?>
