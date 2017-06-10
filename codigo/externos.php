 <?php 	
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';
	if (!empty($_POST)) 
	{

	$documento= $conexion->real_escape_string($_POST['documento']);
	$nombre= $conexion->real_escape_string($_POST['nombre']);
	$celular= $conexion->real_escape_string($_POST['celular']);
	date_default_timezone_set("america/bogota");
	$hora=date('y:m:d:h:i:s');
	if($statement=$conexion->prepare("INSERT INTO `tb_clientes` (`documento_cliente`, `nombre`, `celular`, `fecha_registro`) VALUES (?, ?, ?,?)"))
	{
    $statement->bind_param('ssss', $documento, $nombre, $celular, $hora);
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
	<title>Clientes</title>	
</head>
<body> 
<section>
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
				    <h4 id="">Clientes</h4>
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
		   		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevocliente"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
		    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
			</div>
		</div>
	</div>
		<br>
		<div class="panel-body">
							<!-- Modal -->
	<div class="modal fade" id="nuevocliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
			<div class="modal-content">
		  		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Agregar nuevo cliente</h4>
		 		 </div>
		  		<div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
					<div id="resultados_ajax"></div>
						
						<div class="form-group">
						<label for="documento" class="col-sm-3 control-label">Documento</label>
						<div class="col-sm-8">
						 <input type="text" class="form-control" id="documento" name="documento">
						</div>
			 			</div>
			  
						<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-8">
				 		<input type="text" class="form-control" id="nombre" name="nombre" required="">
						</div>
			    		</div>
			  
			  			<div class="form-group">
						<label for="celular" class="col-sm-3 control-label">Celular</label>
						<div class="col-sm-8">
						<input type="text" class="form-control" id="celular" name="celular">
				 		</div>
			  			</div>	 
			
		  		</div>
		  		
		  		<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" name="enviar">Guardar datos</button>
						</form>
						</div>
		  
		
				<form class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row">
							<div class="col-md-5">
								<input type="text" class="form-control col-xs-12" id="q" placeholder="Nombre del vendedor" onkeyup="load(1);">
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default col-xs-12" onclick="load(1);">
									<span class="glyphicon glyphicon-search"></span> Buscar</button>
								<span id="loader"></span>
							</div>	
						</div>
				</div>
		</div>
</div>
				</form>

				<div class="col-xs-12 contenedor-section" ">
				<?php 
				
				mostrartabla('tb_clientes','eliminardato.php','documento_cliente','clientes.php');
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
			<form class="form-horizontal" method="POST"  action="<?php $_SERVER['PHP_SELF'] ?>" name="miform" >
			<div id="resultados_ajax2"></div>
			 	<div class="form-group">
				<label for="documento" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="documento" name="documento">
				</div>
			    </div>
			  
				<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required="">
				</div>
			 	</div>
			  
				<div class="form-group">
				<label for="celular" class="col-sm-3 control-label">Celular</label>
				<div class="col-sm-8">
				<input type="text" class="form-control" id="celular" name="celular">
				</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
			</form>
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


		