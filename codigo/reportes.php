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
	<title>GIBMAFE | Reportes</title>	
</head>
<body> 
<?php	include "inc/header.php";?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
			<div class="smenu ">
					<?php include("inc/menu.php"); ?> 	
			</div>
			</div>
			<div class="contenedor-section0	 col-xs-12 col-sm-10 col-sd-10  ">
				<div class="panel panel-success">	
					<div class="panel-heading">
					    <div class="btn-group pull-right">
					    	
					    	<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Reportes</h4>	
						</div>				
					</div>
					<br>
					<div class="panel-body">
						<div class="container">
				    	<div class="row">
				    		<div class="col-xs-12 col-sm-3">
				    			<form class="form-horizontal" role="form" action="actualizar.php" method="POST" autocomplete="off">
							
								<div class="form-group">
									<label class="col-md-12 ">Reporte de:</label>
									<div class="col-sm-12 ">
										<select class="form-control" name="tipo_movimiento">	
										<option value="venta">Venta</option>
										<option value="abastecimiento">Abastecimiento</option>
										<option value="averia">Averia</option>
										<option value="devolucion">Devolucion</option>
										<option value="solicitudgarantia">Solicitud de Garantía</option>
										<option value="salidagarantia">Salida de Garantía</option>
										<option value="llegadagarantia">Llegada de Garantía</option>
										<option value="entregagarantia">Entrega de Garantía</option>
										
										</select> 
									  
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12 ">De</label>
									<div class=" col-md-12 ">
										<input class="form-control" type="date" name="">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-12 ">Hasta</label>
									<div class="col-md-12 ">
										<input class="form-control" type="date" name="">
									</div>
								</div>
							
								<div class="form-group">                                      
									<div class="col-md-12">
										<button id="btn-signup" type="submit" class="col-md-12 btn btn-success"><i class="icon-hand-right"></i>Generar Reporte</button> 
									</div>
								</div>
							</form>	
				    		</div>
				    		<div class="col-xs-12 col-sm-9"></div>
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


		