<?php 	
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';
	if (!empty($_POST)) 
	{
	$codigo_producto= $conexion->real_escape_string($_POST['codigo_producto']);
	/*$codigo_producto="'".$codigo_producto."'";*/
	$descripcion= $conexion->real_escape_string($_POST['Descripcion']);
	$cantidad= $conexion->real_escape_string($_POST['cantidad']);
	$precio_compra= $conexion->real_escape_string($_POST['precio_compra']);
	$factura= $conexion->real_escape_string($_POST['Factura']);
	$codigo_proveedor= $conexion->real_escape_string($_POST['codigo_producto']);
	$documento_almacenista= $conexion->real_escape_string($_POST['documento_almacenista']);
	date_default_timezone_set("america/bogota");
	$fecha_registro=date('y:m:d:h:i:s');
	/*$sql="INSERT INTO tb_abastecimientos (descripcion, cantidad, fecha_registro, precio_compra, factura, codigo_producto, codigo_proveedor, documento_almacenista) VALUES ('$descripcion', '$cantidad', '$hora', '$precio_compra', '$factura', '$codigo_producto', '$codigo_proveedor', '$documento_almacenista')";
	echo $sql;*/

	if($statement=$conexion->prepare("INSERT INTO `tb_abastecimientos` (`descripcion`, `cantidad`, `fecha_registro`, `precio_compra`, `factura`, `codigo_producto`, `codigo_proveedor`, `documento_almacenista`	) VALUES (?,?,?,?,?,?,?,?)"))
	{
	
    $statement->bind_param('ssssssss', $descripcion, $cantidad, $fecha_registro, $precio_compra, $factura, $codigo_producto, $codigo_proveedor, $documento_almacenista);
    
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
	<?php include ("inc/headcommon.php");

	
	?>
	<title>GIBMAFE | movimientos</title>
</head>
<body> 
<?php
	/*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	// session_start();
	// include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	// 	if (isset($_SESSION['usuario']))
	// 	{
	include "inc/header.php";			
			?>
	<section>
				<div class="row">
				<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
				<?php include("inc/menu.php"); ?> 	
				</div>
				<div class=" col-xs-12 col-sm-10 col-sd-10 well">
				    <div class="container">
				    <h4 id="">Movimientos</h4>
	<div class="panel panel-success">
		
		<div class="panel-heading">
		    <div class="btn-group pull-right">
		   		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevovendedor"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
		    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
			</div>
			
		</div>
		<br>
		<div class="panel-body">
		
			
			
					<!-- Modal -->
	<div class="modal fade" id="nuevovendedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Agregar nuevo Movimiento</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
			<div id="resultados_ajax"></div>
				<div class="form-group">
				<label for="codigo_producto"  class="col-sm-3 control-label">Codigo del producto</label>
				<div class="col-sm-8">
				  <input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="codigo_producto" name="codigo_producto" required="">
				</div>
			  	</div>
			  
				<div class="form-group">
				<label for="Descripcion" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" pattern="[a-zA-Z0-9]{1,30}" maxlength="30" class="form-control" id="Descripcion" name="Descripcion" required="">
				</div>
			  	</div>
			  
			  <div class="form-group">
				<label for="cantidad" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="cantidad" name="cantidad" required="">
				  
				</div>
			  </div>	 

			  <div class="form-group">
				<label for="tipo_movimiento" class="col-sm-3 control-label">Tipo de Movimiento</label>
				<div class="col-sm-8">
					<select  name="tipo_movimiento">	
					<option value="1">Venta</option>
					<option value="2">Abastecimiento</option>
					<option value="3">Garantia</option>
					<option value="4">Averia</option>
					<option value="5">Devolucion</option>
					</select> 
				  
				</div>
			  </div>

			  <div class="form-group">
				<label for="valor_movimiento" class="col-sm-3 control-label">Valor Movimiento</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="valor_movimiento" name="valor_movimiento" required="">
				  
				</div>
			  </div>	

			  <div class="form-group">
				<label for="Factura" class="col-sm-3 control-label">Factura</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,15}" maxlength="15" class="form-control" id="Factura" name="Factura" required="">
				  
				</div>
			  </div>	

			  <div class="form-group">
				<label for="codigo_proveedor" class="col-sm-3 control-label">identificacion Externo</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="codigo_proveedor" name="codigo_proveedor" required="">
				  
				</div>
			  </div>	
			
				<div class="form-group">
				<label for="usuario" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,15}" maxlength="15" class="form-control" id="usuario" name="usuario" required="">
				  
				</div>
			  </div>	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" name="enviar">Guardar datos</button>
			</form>
		  </div>
		  
		</div>
	  </div>
	</div>

				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-md-5">
								<input type="text" class="form-control col-xs-12" id="q" placeholder="Codigo del Producto" onkeyup="load(1);">
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default col-xs-12" onclick="load(1);">
									<span class="glyphicon glyphicon-search"></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div class="col-xs-12 contenedor-section" ">
					<?php 
					$enlaceeli='eliminardato.php';	
					$tabla='tb_abastecimientos';
					$primarykey='codigo_abastecimiento';
					$enlacefinal='abastecimientos.php';
					$sql="SELECT * FROM  tb_abastecimientos ";
					include("config.php");
					$resultado = $conexion->query( $sql );
					echo "	<table class='table table-condensed ' border=3px> 
							<tr>
									<td>Codigo Abastecimiento</td>
									<td>Codigo de producto</td>	
									<td>Descripcion</td>
									<td>Cantidad</td>
									
									<td>Precio de compra</td>
									<td>Factura de compra</td>
									
									<td>Codigo Proveedor</td>
									<td>Documento de Almacenista</td>
									<td>Fecha registro</td>	
									<td>editar</td>
									<td>eliminar</td>
							</tr>";

					while ($row=mysqli_fetch_row($resultado)) 
					{
						echo "<tr>
									<td>".$row[0]."</td>
									<td>".$row[6]."</td>
									<td>".$row[1]."</td>	
									<td>".$row[2]."</td>
									
									<td>".$row[4]."</td>
									<td>".$row[5]."</td>
									
									<td>".$row[7]."</td>
									<td>".$row[8]."</td>
									<td>".$row[3]."</td>
									<td><button class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal2'></button></a></td>
									<td><a id='eliminarnegro' href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey' ><button class='glyphicon glyphicon-trash'></button></a></td>
							</tr>"	;

					}
					echo "	</table>";	

			
				?>		
				</div>

						<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Editar vendedor</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_vendedor" name="editar_vendedor">
			<div id="resultados_ajax2"></div>
			 	<div class="form-group">
				<label for="codigo_producto"  class="col-sm-3 control-label">Codigo del producto</label>
				<div class="col-sm-8">
				  <input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="codigo_producto" name="codigo_producto" required="">
				</div>
			  	</div>
			  
				<div class="form-group">
				<label for="Descripcion" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" pattern="[a-zA-Z0-9]{1,30}" maxlength="30" class="form-control" id="Descripcion" name="Descripcion" required="">
				</div>
			  	</div>
			  
			  <div class="form-group">
				<label for="cantidad" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="cantidad" name="cantidad" required="">
				  
				</div>
			  </div>	 

			  <div class="form-group">
				<label for="precio_compra" class="col-sm-3 control-label">Precio de Compra</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="precio_compra" name="precio_compra" required="">
				  
				</div>
			  </div>	

			  <div class="form-group">
				<label for="Factura" class="col-sm-3 control-label">Factura</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,15}" maxlength="15" class="form-control" id="Factura" name="Factura" required="">
				  
				</div>
			  </div>	

			  <div class="form-group">
				<label for="codigo_proveedor" class="col-sm-3 control-label">Codigo Proveedor</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="codigo_proveedor" name="codigo_proveedor" required="">
				  
				</div>
			  </div>	
			
				<div class="form-group">
				<label for="documento_almacenista" class="col-sm-3 control-label">Documento Almacenista</label>
				<div class="col-sm-8">
					<input type="text" pattern="[0-9]{1,15}" maxlength="15" class="form-control" id="documento_almacenista" name="documento_almacenista" required="">
				  
				</div>
			 
			 
			
		  </form></div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  
		</div>
	  </div>
	</div>	
		
	
			
			
			
  </div>
</div>
		 
	</div>
	<hr>
	<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      
   </div>
</div>

				</div>
			
				</div>
						
	</section>
		
	
		<?php
		// }else{
			
		// 	header("location: index.php");
			
		// }
			include "inc/footer.php";
 		?>
 		
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>