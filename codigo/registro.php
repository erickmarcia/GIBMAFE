<?php 	 
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	require 'config.php';
	require 'funciones.php';

	$errors = array();

	if (!empty($_POST)) 
	{
 
	$usuario= $conexion->real_escape_string($_POST['usuario']);
	$nombre= $conexion->real_escape_string($_POST['nombre']);
	$celular= $conexion->real_escape_string($_POST['celular']);
	$email= $conexion->real_escape_string($_POST['email']);
	$contraseña= $conexion->real_escape_string($_POST['contraseña']);
	$repitecontraseña= $conexion->real_escape_string($_POST['repitecontrasena']);
	date_default_timezone_set("america/bogota");
	$fecha_registro=date('Y-m-d H:i:s');
	
	if (isnull($usuario, $nombre, $celular, $email, $contraseña, $repitecontraseña, $fecha_registro)) {
		$errors[]= "   Debe llenar todos los campos.";
	}

	if (!isemail($email)) {
		$errors[]= "   Direccion de correo no valida.";
	}

	if (!validacontraseñas($contraseña, $repitecontraseña)) {
		$errors[]= "    Las contraseñas no coinciden.";
	}

	if (usuarioexiste($usuario)) {
		$errors[]= "    El nombre de usuario $usuario ya existe.";
	}

	if (emailexiste($email)) {
		$errors[]= "   El correo Electronico $email ya existe.";
	}

	if (count($errors)==0) {
		

			$registro= registroUsuario($usuario, $contraseña, $nombre, $celular, $email, $fecha_registro);	

			if ($registro > 0) {
				session_start();
				$_SESSION['usuario']=$usuario;
				header("location: stockdispo.php");
					exit;
				
			}else{
					$errors[]='    Error al registrar.';
			}
		
	}

	}
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="images/sen2.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>| Registro Administradores</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/estilos.css">
</head>
<body> 

<?php 
/*en caso de que el usuario se devuelva del chat al registro tendra que dirijirse  al inicio para ingresar al chat si no desea crear otro usuario*/	
	include "inc/header.php";	
?>
<section>
<div class="container">
			<div class="col-sm-4"></div>
			<div  style="margin-top:50px" class="col-xs-12 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading ">
						<div class="panel-title">Regístrate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesión</a></div>
					</div>  
					
					<div class="panel-body">
						
						<form class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="" required="">
								</div>
							</div>

							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="celular" class="col-md-3 control-label">Celular:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="celular" placeholder="Celular" value="" required="">
								</div>
							</div>
						
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="contraseña" class="col-md-3 control-label">Contraseña</label>
								<div class="col-md-9">
									<input type="contraseña" class="form-control" name="contraseña" placeholder="Contraseña" required="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_contraseña" class="col-md-3 control-label">Confirmar Contraseña</label>
								<div class="col-md-9">
									<input type="contraseña" class="form-control" name="repitecontrasena" placeholder="Confirmar Contraseña" required="">
								</div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-success"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
						</form>
						<?php echo resultblock($errors); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	<br><br>
</section>
<?php 
include "inc/footer.php";
?>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
