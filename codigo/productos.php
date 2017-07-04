<?php 	
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';
	if (!empty($_POST)) 
	{ 
	$descripcion= $conexion->real_escape_string($_POST['descripcion']);
	$precio_compra= $conexion->real_escape_string($_POST['precio_compra']);
	date_default_timezone_set("america/bogota");
	$fecha_registro=date('y:m:d:h:i:s');
	if($statement=$conexion->prepare("INSERT INTO `tb_productos` (`descripcion`, `precio_compra`, `fecha_registro`) VALUES (?, ?, ?)"))
	{
    $statement->bind_param('sss', $descripcion, $precio_compra, $fecha_registro);
    $statement->execute();
	}if ($conexion-> affected_rows > 0 )  {
		echo "<script> alert ('guardado') </script>" ;
	}
	else
	{
		echo "<script> alert ('Verifique los datos ingresados') </script>";
	}
	}		
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>GIBMAFE | Productos</title>	
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
</head>
<body> 
	<?php
	/*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	 session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	if (isset($_SESSION['usuario']))
	 	{
	include "inc/header.php";			
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
							    <div class="col-xs-12 col-sm-6 btn-group pull-right">
							   		<button type="button" class="col-xs-6 btn btn-success" data-toggle="modal" data-target="#nuevovendedor"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
							    	<a href="pdf/reporteproductos.php" target="_blank"><button type="button" class="col-xs-6 btn btn-danger" ><span class="glyphicon glyphicon-print"></span> Imprimir </button></a>	
								</div>
							</div>
							<div class="panel-body">
								<!-- 	<form class="form-horizontal" role="form" id="datos_cotizacion">
							
									<div class="row">
									  <div class="col-xs-12 col-sm-5 col-lg-5">
									    <div class="input-group">
									      <input type="text" class="form-control" placeholder="Introduzca Codigo">
									      <span class="input-group-btn">
									        <button class="btn btn-default" type="button">Buscar!</button>
									      </span>
									    </div><!/input-group -->
									  <!-- </div>/.col-lg-6 -->
									<!-- </div>/.row -->
							<!-- </form><br> --> 
						<div class="col-xs-12 contenedor-section" ">
						<?php 
											 			
							$sql="SELECT * FROM  tb_productos ";
							include("config.php");
							$resultado = $conexion->query( $sql );
							echo "	<table class='table table-condensed display' id='mitabla'> 
									<thead>
									<tr>
											<th>Codigo Producto</th>
											<th>Descripcion</th>
											<th>Precio de compra</th>	
											<th>Fecha registro</th>	
											<th>Opciones</th>
											
									</tr>
									</thead>";

							while ($row=mysqli_fetch_row($resultado)) 
							{
								echo "
										<tr>
											<td>".$row[0]."</td>
											<td>".$row[1]."</td>	
											<td>".$row[2]."</td>
											<td>".$row[3]."</td>
											<td align='center'><a id='eliminarnegro' href='actualizaproducto.php?cod_producto=$row[0]' ><button class='glyphicon glyphicon-pencil'></button></a>

											<a id='eliminarnegro' href='eliminardato.php?codigo=$row[0]&tabla=tb_productos&enlacefinal=productos.php&primarykey=cod_producto' ><button class='glyphicon glyphicon-trash'></button></a></td>
									</tr>
									";

							}
							echo "	</table>";	
						?>	
						</div>
					</div>		
						
						
						
										<!-- Modal -->
						<div class="modal fade" id="nuevovendedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Agregar nuevo Producto</h4>
							  </div>
							  <div class="modal-body">
								<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
								<div id="resultados_ajax"></div>
									<div class="form-group">
									<label for="descripcion" class="col-sm-3 control-label">Descripcion</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="descripcion" name="descripcion">
									</div>
								  </div>
								  
									<div class="form-group">
									<label for="precio_compra" class="col-sm-3 control-label">Precio de compra</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="precio_compra" name="precio_compra" required="">
									</div>
								  </div>	 
								
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
								</form>
							  </div> 
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
	
</body>
</html>


		