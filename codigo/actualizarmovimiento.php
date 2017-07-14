<?php 
 	session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	if (isset($_SESSION['usuario']))
	 	{
	require 'config.php';
	require 'funciones.php';

	$cod_movimiento=$_GET['cod_movimiento'];
	$sql = "select * from tb_movimientos where cod_movimiento = '$cod_movimiento'";
	$resultado = $conexion->query( $sql );
	$row = mysqli_fetch_row($resultado);
	if (!empty($_POST)) 
	{ 
	$codigo_producto= $conexion->real_escape_string($_POST['codigo_producto']);
	//echo $codigo_producto;
	$descripcion= $conexion->real_escape_string($_POST['descripcion']);
	$cantidad= $conexion->real_escape_string($_POST['cantidad']);
	$tipo_movimiento= $conexion->real_escape_string($_POST['tipo_movimiento']);
	$valor_movimiento= $conexion->real_escape_string($_POST['valor_movimiento']);
	$factura= $conexion->real_escape_string($_POST['factura']);
	$codigo_externo= $conexion->real_escape_string($_POST['codigo_externo']);
	$usuario= $conexion->real_escape_string($_POST['usuario']);
	
	$sql = "update tb_movimientos set descripcion= '$descripcion', cantidad= '$cantidad', tipo_movimiento= '$tipo_movimiento', valor_movimiento= '$valor_movimiento', factura= '$factura', identificacion_externo= '$codigo_externo', usuario='$usuario', cod_producto='$codigo_producto' where cod_movimiento='$cod_movimiento'";
// echo $sql;
//indico cuales seran los campos a modificar con sus respectivos valores siguiendo con los parametros que se asigno en la funcion de actualizar
include("config.php");
	$resultado = $conexion->query( $sql );
	if( $conexion->affected_rows > 0 )
		{	echo "<script> alert ('Se han editado los datos.') </script>";
			echo "<script>location.href='movimientos.php'</script>";//me retorna a la pantalla inicial
			

		}else{
				echo "<script> alert ('Error: no se han actualizado los datos, Verifique la informacion que desea ingresar.') </script>";
				echo "<script>location.href='movimientos.php'</script>";//me retorna a la pantalla inicial

			}

	}


?>
<!DOCTYPE html>
<html>
<head>
	<?php include ("inc/headcommon.php");	?>
	<title>GIBMAFE | Actualizar Movimiento</title>
	
</head>
<body>
<section>
	<div class="container">
		<div class="row">
				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  "></div>
				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  ">
					<center><img src="images/logo1.png" class="img img-responsive"></center>
					<br><br>
					<div class="modal-body">
					
								  <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Editar Movimiento</h4>
									<form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" id="editar_vendedor" name="editar_vendedor">

										<div class="form-group">
										<label for="codigo_producto"  class="col-sm-3 control-label">Codigo del producto</label>
										<div class="col-sm-8">
										  <input type="text" pattern="[0-9]{1,11}" maxlength="11" class="form-control" id="codigo_producto" name="codigo_producto" required="" value="<?php  echo $row[9];?>">
										</div>
									  	</div>
									  
										<div class="form-group">
										<label for="Descripcion" class="col-sm-3 control-label">Descripcion</label>
										<div class="col-sm-8">
										  <input type="text"  class="form-control" id="descripcion" name="descripcion" required="" value="<?php  echo $row[1];?>">
										</div>
									  	</div>
									  
									  <div class="form-group">
										<label for="cantidad" class="col-sm-3 control-label">Cantidad</label>
										<div class="col-sm-8">
											<input type="text" pattern="[0-9]{1,5}" maxlength="5" class="form-control" id="cantidad" name="cantidad" required="" value="<?php  echo $row[2];?>">
										  
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
											<input type="text" pattern="[0-9]{1,10}" maxlength="10" class="form-control" id="valor_movimiento" name="valor_movimiento" required="" value="<?php  echo $row[4];?>">
										</div>
									  </div>	

									  <div class="form-group">
										<label for="Factura" class="col-sm-3 control-label">Factura</label>
										<div class="col-sm-8">
											<input type="text" pattern="[a-zA-Z0-9]{1,15}" maxlength="15" class="form-control" id="Factura" name="factura" required="" value="<?php  echo $row[6];?>">
										  
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
									<a href="movimientos.php"><button type="button" class="btn btn-default" data-dismiss="modal">Volver</button></a>
									<button type="submit" class="btn btn-primary" id="actualizar_datos">Editar datos</button>
								 
								  </form>
				</div>				
				</div>

				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  "></div>
		</div>
	</div>
</section>
		<?php 

		}else{
			
		 	header("location: index.php");
		} ?>
</body>
</html>
	<!-- Modal -->
							