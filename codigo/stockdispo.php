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
	<?php include "inc/header.php";	?>
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
						    <div class="btn-group pull-right">
						    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
							</div>
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" id="datos_cotizacion">
							
									<div class="row">
									  <div class="col-xs-12 col-sm-5 col-lg-5">
									    <div class="input-group">
									      <input type="text" class="form-control" placeholder="Introduzca Codigo">
									      <span class="input-group-btn">
									        <button class="btn btn-default" type="button">Buscar!</button>
									      </span>
									    </div><!-- /input-group -->
									  </div><!-- /.col-lg-6 -->
									</div><!-- /.row -->
							</form><br>
									   	<div class="col-xs-12 contenedor-section" ">
											<?php 				 			
												$sql="SELECT * FROM  tb_productos ORDER BY cod_producto ASC ";
												include("config.php");
												$resultado = $conexion->query( $sql );
												echo "	<table class='table table-condensed '> 
														<tr>	
																<th>#</th>
																<th>Codigo Producto</th>
																<th>Descripcion</th>
																<th>Cantidad</th>
																<th>Estado</th>
																<th>Precio de compra</th>	
																<th>Fecha registro</th>								
														</tr>";
												$i=1;
												while ($row=mysqli_fetch_row($resultado)) 
													 
												{
														
													echo "<tr>	
																<td>".$i++."</td>
																<td>".$row[0]."</td>
																<td>".$row[1]."</td>
																<td>".$row[2]."</td>	
																<td>".$row[3]."</td>
																<td>".$row[4]."</td>
																<td>".$row[5]."</td>
																
														</tr>"	;
														
												}
												echo "	</table>";	
											?>	
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
