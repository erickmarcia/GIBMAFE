 <?php 	
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';
	if (!empty($_POST)) 
	{

	$identificacion= $conexion->real_escape_string($_POST['identificacion']);
	$nombre= $conexion->real_escape_string($_POST['nombre']);
	$tipo= $conexion->real_escape_string($_POST['tipo']);
	$direccion= $conexion->real_escape_string($_POST['direccion']);
	$celular= $conexion->real_escape_string($_POST['celular']);
	date_default_timezone_set("america/bogota");
	$fecha_registro=date('y:m:d:h:i:s');
	if($statement=$conexion->prepare("INSERT INTO `tb_externos` (`identificacion_externo`, `nombre`, `tipo`, `direccion`, `celular`, `fecha_registro`) VALUES (?, ?, ?, ?, ?, ?)"))
	{
    $statement->bind_param('ssssss', $identificacion, $nombre, $tipo, $direccion, $celular, $fecha_registro);
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
	<title>GIBMAFE | Externos</title>	
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
			
				    <h4 id="">Externos</h4>
					<div class="panel panel-success">
						<div class="panel-heading">
						    <div class="btn-group pull-right">
						   		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevocliente"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
						    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
							</div>
						</div>
					<div class="panel-body">
							<form class="form-horizontal" role="form" id="datos_cotizacion">
									<div class="form-group row">
										<div class="col-md-5">
											<input type="text" class="form-control col-xs-12" id="q" placeholder="Nombre del Externo" onkeyup="load(1);">
										</div>
										<div class="col-md-3">
											<button type="button" class="btn btn-default col-xs-12" onclick="load(1);">
												<span class="glyphicon glyphicon-search"></span> Buscar</button>
											<span id="loader"></span>
										</div>	
									</div>
							</form>		
					<div class="col-xs-12 contenedor-section" ">
					<?php mostrartabla('tb_externos','eliminardato.php','identificacion_externo','externos.php');?>	
					</div>	
					</div>
					</div>
										<!-- Modal 1-->
					<div class="modal fade" id="nuevocliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  	<div class="modal-dialog" role="document">
							<div class="modal-content">
						  		<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Agregar nuevo Externo</h4>
						 		 </div>
						  		<div class="modal-body">
									<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
									<div id="resultados_ajax"></div>
										
										<div class="form-group">
										<label for="identificacion" class="col-sm-3 control-label">Identificacion Externo</label>
										<div class="col-sm-8">
										 <input type="text" class="form-control" id="identificacion" name="identificacion">
										</div>
							 			</div>
							  
										<div class="form-group">
										<label for="nombre" class="col-sm-3 control-label">Nombre</label>
										<div class="col-sm-8">
								 		<input type="text" class="form-control" id="nombre" name="nombre" required="">
										</div>
							    		</div>
							  				
							    		<div class="form-group">
										<label for="tipo" class="col-sm-3 control-label">Tipo</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="tipo" name="tipo">
								 		</div>
							  			</div>	 

							  			<div class="form-group">
										<label for="direccion" class="col-sm-3 control-label">Direccion</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="direccion" name="direccion">
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
							</div>
						</div>
					</div>
										<!-- Modal 2-->
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
								</form>
						  </div>
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
</section>		
		<?php
		}else{	
		 	header("location: index.php");
		}
			include "inc/footer.php";
 		?>
				<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
				<script src="js/bootstrap.min.js"></script>
</body>
</html>
