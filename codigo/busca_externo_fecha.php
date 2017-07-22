<?php
include('config.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}
function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = "SELECT * FROM tb_externos WHERE fecha_registro BETWEEN '$desde' AND '$hasta' ORDER BY identificacion_externo ASC";
$resultado=mysqli_query($conexion,$registro);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="50">Codigo</th>
                <th width="300">Nombre</th>
                <th width="150">Tipo</th>
                <th width="150"> Direccion</th>
                <th width="150">Celular</th>
                <th width="150">Fecha Registro</th>
                
            </tr>';
            	// <th width="50">Opciones</th>

if(!empty($resultado)){
	while($array = mysqli_fetch_array($resultado)){
		echo '<tr>
				<td>'.$array['identificacion_externo'].'</td>
				<td>'.$array['nombre'].'</td>
				<td>'.$array['tipo'].'</td>
				<td>'.$array['direccion'].'</td>
				<td>'.$array['celular'].'</td>
				<td>'.fechaNormal($array['fecha_registro']).'</td>
				
				</tr>';
				// <td><a href="javascript:editarProducto('.$array['cod_producto'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$array['cod_producto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>