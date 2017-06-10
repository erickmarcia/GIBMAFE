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
	<title>Productos</title>	
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
				    <h4 id="">Productos</h4>
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
									 			
					$sql="SELECT * FROM  tb_productos ";
					include("config.php");
					$resultado = $conexion->query( $sql );
					echo "	<table class='table table-condensed ' border=3px> 
							<tr>
									<td>Codigo Producto</td>
									<td>Descripcion</td>
									<td>Cantidad</td>
									<td>Precio de compra</td>	
									<td>Fecha registro</td>	
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
									<td>".$row[4]."</td>
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
			<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Editar Producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_vendedor" name="editar_vendedor">
			<div id="resultados_ajax2"></div>
			 	<div class="form-group">
				<label for="documento" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="documento" name="documento">
				</div>
			  </div>
			  
				<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Precio de compra</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required="">
				</div>
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


		