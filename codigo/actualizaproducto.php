<?php 
	session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	if (isset($_SESSION['usuario']))
	 	{
	require 'config.php';
	require 'funciones.php';

	$cod_producto=$_GET['cod_producto'];
	$sql = "select * from tb_productos where cod_producto = '$cod_producto'";
	$resultado = $conexion->query( $sql );
	$row = mysqli_fetch_row($resultado);
	if (!empty($_POST)) 
	{ 
	
	$descripcion= $conexion->real_escape_string($_POST['descripcion']);
	$precio_compra= $conexion->real_escape_string($_POST['precio_compra']);
	
	
	$sql = "update tb_productos set descripcion= '$descripcion', precio_compra= '$precio_compra' where cod_producto='$cod_producto'";
//indico cuales seran los campos a modificar con sus respectivos valores siguiendo con los parametros que se asigno en la funcion de actualizar
include("config.php");
	$resultado = $conexion->query( $sql );
	if( $conexion->affected_rows > 0 )
		 {	
		 	echo "<script> alert ('Se han editado los datos.') </script>";
			echo "<script>location.href='productos.php'</script>";//me retorna a la pantalla inicial
		}else{
				echo "<script> alert ('Error: no se han actualizado los datos, Verifique la informacion que desea ingresar.') </script>";
				echo "<script>location.href='productos.php'</script>";//me retorna a la pantalla inicial
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
				<center><img src="images/logo1.png" class="img img-responsive"></center><br><br>
				<div class="modal-body">
								<!-- Modal -->
						
									
										<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Editar Producto</h4>
									 
									  <div class="modal-body">
										<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" id="editar_vendedor" name="editar_vendedor">
										<div id="resultados_ajax2"></div>
										 	<div class="form-group">
											<label for="documento" class="col-sm-3 control-label">Descripcion</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="documento" value="<?php echo $row[1]; ?>" name="descripcion">
											</div>
										  	</div>
										  
											<div class="form-group">
											<label for="nombre" class="col-sm-3 control-label">Precio de compra</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="nombre" value="<?php echo $row[4]; ?>" name="precio_compra" required="">
											</div>
										 	</div>	 
										 
										 
										
									 
									  </div>
									  <div class="modal-footer">
										<a href="productos.php"><button type="button" class="btn btn-default" data-dismiss="modal">Volver</button></a>
										<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
										 </form>
									  </div> 
							
								
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
							