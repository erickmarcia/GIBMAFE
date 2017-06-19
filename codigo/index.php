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
<?php include "inc/header.php";	?>
<section>
	<div class="container">
		<div class="row">
				<div class="col-xs-12 col-sm-3 col-sd-3 col-lg-3 loginfondo well">
					<div class="panel-heading">
						<div class="panel-title">Ingreso Administrador</div><br>
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
				<div class="col-xs-12 col-sm-9 col-sd-9 col-lg-9">
				<br/>
				<center>
											
				</center>
				<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <!-- <img src="img_chania.jpg" alt="Chania" width="460" height="345"> -->
        <img src="images/yanbal1.jpg" class="img img-responsive">
        <div class="carousel-caption">
        <!--   <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p> -->
        </div>
      </div>

      <div class="item">
<!--         <img src="img_chania2.jpg" alt="Chania" width="460" height="345">
 -->        <img src="images/yanbal1.jpg" class="img img-responsive">
        <div class="carousel-caption">
        <!--   <h3>Chania</h3>
          <p>The atmosphere in Chania has a touch of Florence and Venice.</p> -->
        </div>
      </div>
    
      <div class="item">
<!--         <img src="img_flower.jpg" alt="Flower" width="460" height="345">
 -->        <img src="images/yanbal1.jpg" alt="Flower" width="460" height="345"">
        <div class="carousel-caption">
        <!--   <h3>Flowers</h3>
          <p>Beautiful flowers in Kolymbari, Crete.</p> -->
        </div>
      </div>

      <div class="item">
<!--         <img src="img_flower2.jpg" alt="Flower" width="460" height="345">
 -->        <img src="images/yanbal1.jpg" class="img img-responsive">
        <div class="carousel-caption">
        <!--   <h3>Flowers</h3>
          <p>Beautiful flowers in Kolymbari, Crete.</p> -->
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
				<br/>
				</div>		
		</div>
	</div>	
</section>
<?php include "inc/footer.php";?>
</body>
</html>
