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
		header("location: stockdispo.php");	
		}else{	
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
			</div>

			<div class="col-xs-12 col-sm-4">

					<center><img src="images/logo1.png" class="img img-responsive"></center>
					<br><br>
				
				<br>	
				<div style="margin-top:50px" class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Recuperar Password</div>
					<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesión</a></div>
				</div>     
				
				<div style="padding-top:30px" class="panel-body">
					
					<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
					
					<form id="loginform" class="form-horizontal AVAST_PAM_nonloginform" role="form" action="" method="POST" autocomplete="off">
						
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="email" type="email" class="form-control" name="email" placeholder="email" required="">                                        
						</div>
						
						<div style="margin-top:10px" class="form-group">
							<div class="col-sm-12 controls">
								<button id="btn-login" type="submit" class="btn btn-success">Enviar
							</button></div>
						</div>
						
						<div class="form-group">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
									No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
								</div>
							</div>
						</div>    
					</form>
									</div>                     
			</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				
			</div>
		</div>
		
	</div>
	
</section>
<footer id="footer2">
	<div class="container">
		<div class="row">
				<div class="col-xs-12" >
				<center>	
				<p style="color: gray">Stmendozza &copy; <br>© 2017 - Boutique Maria Fernanda.</p>
				</center>
				</div>
		</div>
	</div>	
</footer>
		<?php  	
		}
 		?>
				<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
				<script src="js/bootstrap.min.js"></script>
</body>
</html>
