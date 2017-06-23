<?php 	 
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	session_start();
	require 'config.php';
	require 'funciones.php';

	$errors = array();

	if (!empty($_POST)) 
	{ 

		$usuario= $conexion->real_escape_string($_POST['usuario']);
		$contraseña= $conexion->real_escape_string($_POST['contraseña']);

			if (isnulllogin($usuario, $contraseña)) {
				$errors[]= "Debe llenar todos los campos";
			}
				$sql="SELECT usuario FROM tb_usuarios WHERE usuario='".$usuario."' AND pass='".$contraseña."'" ;
				/*despues de consultar recupera los datos que trajo la variable sql  */
				$resultado = $conexion->query( $sql );
		 		/*pregunta el numero de filas traido en la variable resultado y si exactamente igual a 0 muestra un mensaje de alerta si no inicia sesion con la variable $usuario y enlaza a stockdispo.php*/
				if (mysqli_num_rows($resultado)==0) 
				{
						echo "<script text='text/javascript'>;
								alert('el usuario o la contraseña no coinsiden');
								window.location= 'index.php';
							  </script>";
				}else{
							$_SESSION['usuario']=$usuario;
							header("location: stockdispo.php");
				}
				/*$errors[]= login($usuario, $contraseña);*/
	}	
?>	
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Ingreso</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	.carousel-inner > .item > img,
	.carousel-inner > .item > a > img {
	width: 100%;
	margin: auto;
	}
	</style>
	<?php include ("inc/headcommon.php");?>
	
</head>
<body> 
<section>
	<div class="container">
		<div class="row">
				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  "></div>
				
				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  ">
				<div class="col-xs-12 col-sm-12">
					<center><img src="images/logo1.png" class="img img-responsive"></center>
					<br><br>
				</div>

				<h1>Iniciar Sesión</h1>
					<div class="panel-heading">
						<div class="panel-title"></div><br>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="recuperarpass.php">¿Se te olvid&oacute; tu contraseña?</a></div>
					</div> <br>
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
						
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario o email" required>                                  
								</div>
								
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input id="password" type="password" class="form-control" name="contraseña" placeholder="contraseña" required>
								</div>
								
								<div style="margin-top:10px" class="form-group">
									<div class="col-sm-12 controls">
										<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-12 control">
										<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
											No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
										</div>
									</div>
								</div>    
						</form>
						<?php echo resultblock($errors); ?>			
				</div>	
				<div class="col-xs-12 col-sm-4 col-sd-4 col-lg-4  "></div>
		</div>
	</div>	
</section>
</body>
</html>
 