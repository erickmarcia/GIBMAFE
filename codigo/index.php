<?php 	 
/*importante poner el session de primera*/
session_start();
include "config.php";
/*aca estoy preguntango si el usuario ya inicio sesion, para que vaya directamente al chat*/
if (isset($_SESSION['usuario'])) {
				header("location: abastecimiento.php");
}else{
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>Ingreso</title> 
</head>
<body> 
<?php include "inc/header.php";	?>
<section>
	<div class="container">
		
		<div class="row">
				<div class="col-xs-12 col-sm-3 col-sd-3 col-lg-3 loginfondo well">
					<div class="panel-heading">
						<div class="panel-title">Ingreso Administrador</div><br>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="recupera.php">¿Se te olvid&oacute; tu contraseña?</a></div>
					</div> <br>
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
						
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="usuario o email" required>                                        
						</div>
						
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" type="password" class="form-control" name="password" placeholder="password" required>
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
								
					
				</div>	
				<div class="col-xs-12 col-sm-9 col-sd-9 col-lg-9 well">
				
				<br/>
				<center>
				<img src="images/yanbal.png" class="img img-responsive">
									
				</center>
				<br/>
				</div>	
		</div>
	</div>	
</section>
<?php 	
}
include "inc/footer.php";
?>
</body>
</html>
 