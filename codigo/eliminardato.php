<?php   
	require 'config.php';
	require 'funciones.php';

	$tabla=$_GET['tabla'];
	//echo $tabla;
	$primarykey=$_GET['primarykey'];
	//echo $primarykey;
	$documento=$_GET['codigo'];
	//echo $documento;	
	$enlacefinal=$_GET['enlacefinal'];
	//echo $enlacefinal;
 
	eliminar_dato_tabla($tabla,$primarykey,$documento,$enlacefinal);
?>