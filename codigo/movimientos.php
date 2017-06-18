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
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");	?>
	<title>GIBMAFE | Movimientos</title>
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
				    
				    	<h4 id="">Movimientos</h4>
				<div class="panel panel-success">
					
					<div class="panel-heading">
					    <div class="btn-group pull-right">
					   		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevovendedor"><span class="glyphicon glyphicon-plus"></span> Nuevo </button>
					    	<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Imprimir </button>		
						</div>
						
					</div>
					<div class="panel-body">

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
					$tabla='tb_movimientos';
					$primarykey='cod_movimiento';
					$enlacefinal='movimientos.php';
					$sql="SELECT * FROM  tb_movimientos ORDER BY  cod_movimiento DESC ";
					include("config.php");
					$resultado = $conexion->query( $sql );
					echo "	<table class='table table-condensed ' border=3px> 
							<tr align='center'>	
									
									<td>Codigo Movimiento</td>	
									<td>Codigo Producto</td>	
									<td>Descripcion</td>
									<td>Cantidad</td>
									<td>Tipo Movimiento</td>
									<td>Valor Movimiento</td>
									<td>Factura</td>
									<td>Externo</td>
									<td>Admin</td>
									<td>Fecha registro</td>	
									<td>Editar</td>
									<td>Eliminar</td>

							</tr>";

					while ($row=mysqli_fetch_row($resultado)) 
					{
						echo "<tr>
									<td>".$row[0]."</td>
									<td>".$row[9]."</td>
									<td>".$row[1]."</td>	
									<td>".$row[2]."</td>
									<td>".$row[3]."</td>
									<td>".$row[4]."</td>
									<td>".$row[6]."</td>
									<td>".$row[7]."</td>
									<td>".$row[8]."</td>
									<td>".$row[5]."</td>
									<td><button class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#myModal2'></button></a></td>
									<td><a id='eliminarnegro' href='$enlaceeli?codigo=$row[0]&tabla=$tabla&enlacefinal=$enlacefinal&primarykey=$primarykey' ><button class='glyphicon glyphicon-trash'></button></a></td>
							</tr>"	;
					}
					echo "	</table>";	
				?>		
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
											<select  name="tipo_movimiento">	
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
										<label for="codigo_externo" class="col-sm-3 control-label">identificacion Externo</label>
										<div class="col-sm-8">
											<input type="text" pattern="[0-9]{1,15}" maxlength="15" class="form-control" id="codigo_externo" name="codigo_externo" required="">
										  
										</div>
									  </div>	
									
										<div class="form-group">
										<label for="usuario" class="col-sm-3 control-label">Usuario</label>
										<div class="col-sm-8">
											<input type="text" pattern="[a-zA-Z0-9]{1,30}" maxlength="30" class="form-control" id="usuario" name="usuario" required="">
										  
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
