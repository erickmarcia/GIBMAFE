<?php 	 
/*importante poner el session de primera*/
require ('config2.php');
session_start();

/*aca estoy preguntango si el usuario ya inicio sesion, para que vaya directamente al chat*/
if (!empty($_POST)) 
{
	$usuario= mysqli_real_escape_string($conexion, $_POST['usuario']);			
	$contraseña= mysqli_real_escape_string($conexion, $_POST['contraseña']);
	$sha1_contraseña= sha1($contraseña);
	$sql= "SELECT usuario FROM tb_usuarios WHERE usuario='$usuario' AND contraseña= '$sha1_contraseña'";
	//echo $sql;
	$resultado=$conexion->query($sql);
	
	if (mysqli_num_rows($resultado)==0) {
		echo "<script text='text/javascript'>;
						alert('el usuario o la contraseña no coinsiden');
						window.location= 'index2.php';
					  </script>";
		
	}else{
			
		$_SESSION['usuario']=$usuario;
		header("location: abastecimiento2.php");	
	}
	
}
	
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
		<div class="row">
			<div class="col-xs-12 col-sm-3 tituloginfondo">
			<h1>Ingreso Administrador</h1>
			</div>	
				<div class="col-xs-12 col-sm-9  ">
				
				</div>	
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-3 loginfondo ">
			<center>
				<br>
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="miform"  >
						<input  name="usuario" class="form-control"  pattern="[a-zA-Z0-9]{1,20}" maxlength="20" placeholder="usuario" required >
						<br>
						<input type="password" class="form-control" name="contraseña"  placeholder="contraseña" required  /> 
						<br>
						<a href="">¿Olvido su contraseña?</a>
						<br>
						<br>
						<button type="submit" class="btn btn-warning" name="enviar" >Iniciar Sesión</button> 
					</form>	
					<br>
					<br>
					<br>
					
					
					<a class="floatright" href="registro.php">RegSSSSistrarse</a>
				</center>
			</div>	
				<div class="col-xs-12 col-sm-9 ">
				
				<br/>
				<center>
				<img src="images/yanbal.png" class="img img-responsive">
									
				</center>
				<br/>
				</div>	
		</div>
</section>
<?php 	

include "inc/footer.php";
?>
</body>
</html>
 