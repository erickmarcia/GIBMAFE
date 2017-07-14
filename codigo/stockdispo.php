<?php
	/*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	session_start();
	
	include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	if (isset($_SESSION['usuario']))
	{ 
			
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>GIBMAFE | Disponible</title>	
	
</head>
<body> 
	<?php include "inc/header.php";
	include "funciones.php";	
		?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
				<div class="smenu ">
					<?php include("inc/menu.php"); ?> 
				</div>
			</div>
			<div class="contenedor-section0	 col-xs-12 col-sm-10 col-sd-10 ">
				<div class="panel panel-success">
					<div class="panel-heading">
					    <div class="col-xs-12 col-sm-12 btn-group pull-right">
					    	<label style="float:left;padding: 10px;" class=" col-xs-6 wel"><?php	echo "Productos Registrados: ".retornar_dato_tabla( "tb_disponibles", "COUNT( * )" )."<br>";?></label>
					    	<a href="pdf/reportedispo.php " target="_black"> <button type="button" class="col-xs-6 btn btn-danger" ><span class="glyphicon glyphicon-print"></span> Imprimir </button></a>		
						</div>
					</div>
					<div class="panel-body">
					   	<div class="col-xs-12 contenedor-section" ">
							<?php 				 			
								$sql="SELECT * FROM  tb_disponibles WHERE mostrar='1' ORDER BY cod_producto ASC ";
								//echo $sql;
								include("config.php");
								$resultado = $conexion->query( $sql );
									echo "<table class='display' id='mitabla'> 
										<thead>
										<tr>	
											<th>#</th>
											<th>Codigo Producto</th>
											<th>Descripcion</th>
											<th>Cantidad</th>
											<th align='center' >Estado</th>
											<th>Precio de compra</th>	
											<th>Fecha registro</th>								
										</tr>
										</thead>";
								$i=1;
								while ($row=mysqli_fetch_assoc($resultado)) 
									 
								{
									echo "
										<tr>	
											<td>".$i++."</td>
											<td>".$row['cod_producto']."</td>
											<td>".$row['descripcion']."</td>
											<td>".$row['cantidad']."</td>	
											<td align='center' style='color:white' class='label-success'>".$row['estado']."</td>
											<td align='center'>".$row['precio_compra']."</td>
											<td>".$row['fecha_registro']."</td>
										</tr>
										";
								}
									echo "</table>";	
							?>	
						</div>
					</div>
				</div>		
			</div>		
		</div>
	</div>						
</section>
		<?php
		}else{
			header("location: index.php");
		}
			include "inc/footer.php";
 		?>
<script src="js/jquery.dataTables.min.js"></script>
 		<script>
		$(document).ready(function(){
		$('#mitabla').DataTable({
		"order": [[1, "asc"]],
		"language":{
		"lengthMenu": "Mostrar _MENU_ registros por pagina",
		"info": "Mostrando pagina _PAGE_ de _PAGES_",
		"infoEmpty": "No hay registros disponibles",
		"infoFiltered": "(filtrada de _MAX_ registros)",
		"loadingRecords": "Cargando...",
		"processing":     "Procesando...",
		"search": "Buscar:",
		"zeroRecords":    "No se encontraron registros coincidentes",
		"paginate": {
		"next":       "Siguiente",
		"previous":   "Anterior"
		},					
		}
		});	
		});	
	</script>
</body>
</html>


		