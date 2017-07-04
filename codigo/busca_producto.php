<?php
include('conexion.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro="SELECT * FROM productos WHERE nomb_prod LIKE '%$dato%' OR tipo_prod LIKE '%$dato%' ORDER BY id_prod ASC";

$resultado=mysqli_query($conexion,$registro);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Nombre</th>
                <th width="200">Tipo</th>
                <th width="150">Precio Unitario</th>
                <th width="150">Precio Distribuidor</th>
                <th width="150">Fecha Registro</th>
                <th width="50">Opciones</th>
            </tr>';

if(!empty($resultado)){
	while($row=mysqli_fetch_array($resultado)){
		echo '<tr>
				<td>'.$row['nomb_prod'].'</td>
				<td>'.$row['tipo_prod'].'</td>
				<td>S/. '.$row['precio_unit'].'</td>
				<td>S/. '.$row['precio_dist'].'</td>
				<td>'.fechaNormal($row['fecha_reg']).'</td>
				<td><a href="javascript:editarProducto('.$row['id_prod'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$row['id_prod'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>