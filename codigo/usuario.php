<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>Usuario</title>	
</head>
<body> 
<?php
	/*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	session_start();
	include "config.php";
	//si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	if (isset($_SESSION['usuario']))
		{
	include "inc/header.php";			
			?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
			<?php include("inc/menu.php"); ?> 	
			</div>
			<div class=" col-xs-12 col-sm-10 col-sd-10 well">
				    
				    <h4 id="">Usuarios</h4>
				<div class="panel panel-success">	
					<div class="panel-heading">
					    <div class="btn-group pull-right">
					    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-lock"></span> Cambiar contraseña </button>			
						</div>				
					</div>
					<br>
					<div class="panel-body">
							
			 	 	</div>
	 	 		
				</div><!-- ModalUser -->
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Editar usuario</h4>
					  </div>
					  <div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_vendedor" name="editar_vendedor">
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


		


		
