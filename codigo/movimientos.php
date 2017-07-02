<?php 	
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';
	

	if (!empty($_POST)) 
{ 
	$codigo_producto= $conexion->real_escape_string($_POST['codigo_producto']);
	/*$codigo_producto="'".$codigo_producto."'";*/
	$descripcion= $conexion->real_escape_string($_POST['descripcion']);
	$cantidad= $conexion->real_escape_string($_POST['cantidad']);
	$tipo_movimiento= $conexion->real_escape_string($_POST['tipo_movimiento']);
	$valor_movimiento= $conexion->real_escape_string($_POST['valor_movimiento']);
	$factura= $conexion->real_escape_string($_POST['factura']);
	$codigo_externo= $conexion->real_escape_string($_POST['codigo_externo']);
	$usuario= $conexion->real_escape_string($_POST['usuario']);
	date_default_timezone_set("america/bogota");
	$fecha_registro=date('y:m:d:h:i:s');

		if ($tipo_movimiento=='abastecimiento' or $tipo_movimiento=='devolucion' or $tipo_movimiento=='venta' or $tipo_movimiento=='averia' ) {
				
					$sql= "SELECT * FROM tb_productos WHERE cod_producto='$codigo_producto'";
					include("config.php");
					$resultado=mysqli_query($conexion,$sql);
					$row=mysqli_fetch_row($resultado);

			if (!empty($row)) 
			{
				if ($row[3]=='Disponible' AND $tipo_movimiento=='venta' AND $row[2]>0 or $row[3]=='Disponible' AND $tipo_movimiento=='averia' AND $row[2]>0) 
				{	if ($row[2]>=$cantidad) 
					{

						$actualizar=$row[2]-$cantidad;
						$sql="update tb_productos set cantidad='$actualizar' where cod_producto='$codigo_producto' ";
						include("config.php");
						$resultado = $conexion->query( $sql );
						registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);
					}else
					{
						echo "<script> alert ('No se puede registrar $tipo_movimiento, No hay esa cantidad del producto codigo $row[0] solo hay disponible: $row[3]') </script>";
					}
				}

				if ($row[3]=='Disponible' AND $tipo_movimiento=='abastecimiento' or $row[3]=='Disponible' AND $tipo_movimiento=='devolucion')
				{
					$actualizar=$row[2]+$cantidad;
					$sql="update tb_productos set cantidad='$actualizar' where cod_producto='$codigo_producto' ";
			
					include("config.php");
					$resultado = $conexion->query( $sql );

					registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);

				}

			}else
			{/*si el codigo_producto no se encuentra en tb_productos registrarlo en la misma*/
				if ($tipo_movimiento=="abastecimiento" or $tipo_movimiento=="devolucion" ) 
				{	
					$tipo_movimientopro="Disponible";
					$sql= "INSERT INTO tb_productos (cod_producto, descripcion, cantidad, estado, precio_compra, fecha_registro) VALUES ('".$codigo_producto."','".$descripcion."','".$cantidad."','".$tipo_movimientopro."','".$valor_movimiento."','".$fecha_registro."')";

					include "config.php";
					$conexion->query( $sql );
					registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);	
				}
				
			}
			}else{
				if ($tipo_movimiento=="solicitudgarantia" or $tipo_movimiento=="llegadagarantia") {
					$sql= "SELECT * FROM tb_productos WHERE cod_producto='$codigo_producto' AND estado='$tipo_movimiento'";
					include("config.php");
				
					$resultado=mysqli_query($conexion,$sql);
					$row=mysqli_fetch_row($resultado);

					if (!empty($row)) 
					{ 	
						if($tipo_movimiento=="solicitudgarantia" or $tipo_movimiento=="llegadagarantia")
						{
						$actualizar=$row[2]+$cantidad;
						$sql="update tb_productos set cantidad='$actualizar' where cod_producto='$codigo_producto' ";
						//echo $sql;
						include("config.php");
						$resultado = $conexion->query( $sql );

						registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);
						}
					}else{
						
						if($tipo_movimiento=="solicitudgarantia" or $tipo_movimiento=="llegadagarantia")
						{

						$sql= "INSERT INTO tb_productos (cod_producto, descripcion, cantidad, estado, precio_compra, fecha_registro) VALUES ('".$codigo_producto."','".$descripcion."','".$cantidad."','".$tipo_movimiento."','".$valor_movimiento."','".$fecha_registro."')";

						include "config.php";
						$conexion->query( $sql );
						registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);
						}
						
					}
				}else{
					
					if($tipo_movimiento=="salidagarantia" )
						{
						$sql= "SELECT * FROM tb_productos WHERE cod_producto='$codigo_producto' AND estado='solicitudgarantia'";
						include("config.php");
				
						$resultado=mysqli_query($conexion,$sql);
						$row=mysqli_fetch_row($resultado);
						if ($row[2]>0) {
							$actualizar=$row[2]-$cantidad;
						$sql="update tb_productos set cantidad='$actualizar' where cod_producto='$codigo_producto' AND estado='solicitudgarantia'";
						//echo $sql;
						include("config.php");
						$resultado = $conexion->query( $sql );
						registromovimiento($descripcion, $cantidad, $tipo_movimiento, $valor_movimiento, $fecha_registro, $factura, $codigo_externo, $usuario, $codigo_producto);
							if ($actualizar==0) 
							{
								$sql="DELETE FROM tb_productos WHERE cod_producto='$codigo_producto' AND estado='solicitudgarantia'";
								include("config.php");
								$conexion->query( $sql );
							}
						}else{

							echo "<script> alert ('No hay Solicitudes de Garantia del producto codigo $codigo_producto ') </script>";
						}
						
						}
				}	
			}		
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");	?>
	<title>GIBMAFE | Movimientos</title>
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
					    <div class="btn-group pull-right">
					   		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevovendedor"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
					    	<a href="pdf/reportemovimietos.php" target="_blank"><button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button></a>		
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
									    </div><! /input-group -->
									  <!-- </div>/.col-lg-6 -->
									<!-- </div>/.row -->
							<!-- </form><br> --> 
				<div class="col-xs-12 contenedor-section" ">
					<?php 
					$enlaceeli='eliminardato.php';	
					$tabla='tb_movimientos';
					$primarykey='cod_movimiento';
					$enlacefinal='movimientos.php';
					$sql="SELECT * FROM  tb_movimientos ORDER BY  cod_movimiento DESC ";
					include("config.php");
					$resultado = $conexion->query( $sql );
					echo "	<table class='table table-condensed display' id='mitabla' > 
							<thead>
							<tr>	
									
									<th>#</th>	
									<th width='10'>Codigo Producto</th>	
									<th >Descripcion</th>
									<th width='10'>Stock</th>
									<th >Movimiento</th>
									<th >Valor</th>
									<th >Factura</th>
									<th >Externo</th>
									<th >Admin</th>
									<th >Fecha registro</th>	
									<th >Opciones</th>
									

							</tr>
							</thead>";

					while ($row=mysqli_fetch_row($resultado)) 
					{
						echo "
						<tbody>
						<tr>
									<td align='center'>".$row[0]."</td>
									<td align='center'>".$row[9]."</td>
									<td>".$row[1]."</td>	
									<td align='center'>".$row[2]."</td>
									<td>".$row[3]."</td>
									<td align='center'>".$row[4]."</td>
									<td>".$row[6]."</td>
									<td align='center'>".$row[7]."</td>
									<td>".$row[8]."</td>
									<td>".$row[5]."</td>
									<td align='center'><a id='eliminarnegro' href='actualizarmovimiento.php?cod_movimiento=$row[0]' ><button class='glyphicon glyphicon-pencil'></button></a>
										<a id='eliminarnegro' href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey' ><button class='glyphicon glyphicon-trash'></button></a></td> 
								
							</tr>
							</tbody>";
					}
					echo "	</table>";	
					
				?>			<!--// <th>Editar</th>
									// <th>Eliminar</th>
				 // <td><a id='eliminarnegro' href='actualizarmovimiento.php?cod_movimiento=$row[0]' ><button class='glyphicon glyphicon-pencil'></button></a></td>
									// <td><a id='eliminarnegro' href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey' ><button class='glyphicon glyphicon-trash'></button></a></td> -->
				</div>
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
										  <input type="text" pattern="[0-9]{1,11}" maxlength="11" class="form-control" id="codigo_producto" name="codigo_producto" required="">
										</div>
									  	</div>
									  
										<div class="form-group">
										<label for="Descripcion" class="col-sm-3 control-label">Descripcion</label>
										<div class="col-sm-8">
										  <input type="text"  class="form-control" id="descripcion" name="descripcion" required="">
										</div>
									  	</div>
									  
									  <div class="form-group">
										<label for="cantidad" class="col-sm-3 control-label">Cantidad</label>
										<div class="col-sm-8">
											<input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="cantidad" name="cantidad" required="">
										  
										</div>
									  </div>	 

									  <div class="form-group">
										<label for="tipo_movimiento" class="col-sm-3 control-label">Tipo de Movimiento</label>
										<div class="col-sm-8">
											<select class="form-control" name="tipo_movimiento" >	
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
										<label for="valor_movimiento" class="col-sm-3 control-label">Valor Movimiento</label>
										<div class="col-sm-8">
											<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="valor_movimiento" name="valor_movimiento" required="">
										</div>
									  </div>	

									  <div class="form-group">
										<label for="Factura" class="col-sm-3 control-label">Factura</label>
										<div class="col-sm-8">
											<input type="text" pattern="[a-zA-Z0-9]{1,15}" maxlength="15" class="form-control" id="Factura" name="factura" required="">
										  
										</div>
									  </div>	

									  <div class="form-group">
										<label for="codigo_externo" class="col-sm-3 control-label">Externo</label>
										<div class="col-sm-8">
										  	 <?php echo traer_lista_informacion( "codigo_externo", "tb_externos", "identificacion_externo", "nombre" ); ?>
										</div>
									  </div>	
									
									


										<div class="form-group">
										<label for="usuario" class="col-sm-3 control-label">Usuario</label>
										<div class="col-sm-8">
											<?php echo traer_lista_informacion( "usuario", "tb_usuarios", "usuario", "nombre" ); ?>
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
