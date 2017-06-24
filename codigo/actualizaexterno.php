<?php 
 session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	if (isset($_SESSION['usuario']))
	 	{
	require 'config.php';
	require 'funciones.php';

	$identificacion_externo1=$_GET['identificacion_externo'];
	$sql = "select * from tb_externos where identificacion_externo = '$identificacion_externo1'";
	$resultado = $conexion->query( $sql );
	$row = mysqli_fetch_row($resultado);
	if (!empty($_POST)) 
	{ 
	$identificacion_externo= $conexion->real_escape_string($_POST['identificacion_externo']);
	$nombre= $conexion->real_escape_string($_POST['nombre']);
	$tipo= $conexion->real_escape_string($_POST['tipo']);
	$direccion= $conexion->real_escape_string($_POST['direccion']);
	$celular= $conexion->real_escape_string($_POST['celular']);

	$sql = "update tb_externos set identificacion_externo= '$identificacion_externo' , nombre= '$nombre', tipo= '$tipo', direccion= '$direccion', celular= '$celular' where identificacion_externo='$identificacion_externo1'";
//indico cuales seran los campos a modificar con sus respectivos valores siguiendo con los parametros que se asigno en la funcion de actualizar
include("config.php");
	$resultado = $conexion->query( $sql );
	if( $conexion->affected_rows > 0 )
		{	
			echo "<script> alert ('Se han editado los datos.') </script>";
			echo "<script>location.href='externos.php'</script>";//me retorna a la pantalla inicial
							

		}else{
				echo "<script> alert ('Error: no se han actualizado los datos, Verifique la informacion que desea ingresar.') </script>";
				echo "<script>location.href='externos.php'</script>";//me retorna a la pantalla inicial
				
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
						<!-- Modal 2-->
					
						 
							<h4 ><i class="glyphicon glyphicon-edit"></i> Editar Externo</h4>
						 
						  <div class="modal-body">
							<form class="form-horizontal" method="POST"  action="<?php $_SERVER['PHP_SELF'] ?>" name="miform" >
							<div id="resultados_ajax2"></div>
							 	<div class="form-group">
								<label for="identificacion_externo" class="col-sm-3 control-label">Identificación</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="identificacion_externo" name="identificacion_externo" value="<?php echo $row[0]; ?>">
								</div>
							    </div>
							  
								<div class="form-group">
								<label for="nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="nombre" name="nombre" required="" value="<?php echo $row[1]; ?>">
								</div>
							 	</div>

							 	 <div class="form-group">
								<label for="tipo" class="col-sm-3 control-label">Tipo de Externo</label>
								<div class="col-sm-8">
								<select class="form-control " name="tipo" >	
								<option value="proveedor">Proveedor</option>
								<option value="cliente">Cliente</option>
								</select> 
								</div>
								</div>

								<div class="form-group">
								<label for="direccion" class="col-sm-3 control-label">Direccion</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="direccion" name="direccion" required="" value="<?php echo $row[3]; ?>">
								</div>
							 	</div>
							  
								<div class="form-group">
								<label for="celular" class="col-sm-3 control-label">Celular</label>
								<div class="col-sm-8">
								<input type="text" class="form-control" id="celular" name="celular" required="" value="<?php echo $row[4]; ?>">
								</div>
								</div>
								
						  </div>
						  <div class="modal-footer">
							<a href="externos.php"><button type="button" class="btn btn-default" >Volver</button></a>
							<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
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
							