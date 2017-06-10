<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>Stock Disponible</title>	
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
				    <h4 id="">Stock Disponible</h4>
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
		    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
			</div>
		</div>
	</div>
		<br>
		
		  
		
				<form class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row">
							<div class="col-md-5">
								<input type="text" class="form-control col-xs-12" id="q" placeholder="Codigo de Producto" onkeyup="load(1);">
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
									
							</tr>";

					while ($row=mysqli_fetch_row($resultado)) 
					{
						echo "<tr>
									<td>".$row[0]."</td>
									<td>".$row[1]."</td>	
									<td>".$row[2]."</td>
									<td>".$row[3]."</td>
									<td>".$row[4]."</td>
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
				</div>
		</div>

				

	
						
</section>
		
			
		<?php
		// }else{
			
		// 	header("location: index.php");
			
		// }
			include "inc/footer.php";
 		?>
 		

   
</body>
</html>


		