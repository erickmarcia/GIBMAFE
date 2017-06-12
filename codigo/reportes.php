<?php
	/*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	session_start();
	include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	if (isset($_SESSION['usuario']))
	{		
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include ("inc/headcommon.php");?>
	<title>GIBMAFE | Reportes</title>	
</head>
<body> 
<?php	include "inc/header.php";?>
<section>
	<div class="container">
		<div class="row">
			<div class="contenedor-menu col-xs-12 col-sm-2 col-sd-2 ">
				<div class="smenu ">
					<?php include("inc/menu.php"); ?> 	
				</div>
				</div>
				<div class="contenedor-section0	 col-xs-12 col-sm-10 col-sd-10 ">
				 <br>	     
				<div class="panel panel-success">	
					<div class="panel-heading">
					    <div class="btn-group pull-right">
					    	 <h3>Reportes</h3>			
						</div>				
					</div>
					<br>
					<div class="panel-body">
						 <label id="">Reporte de:</label>
				    <select>
				    <option>Abastecimiento</option>
				    <option>Venta</option>
				    <option>Avería</option>
				    <option>Solicitud Garantía</option>
				    <option>Salida Garantía</option>
				    <option>llegada Garantía</option>
				    <option>Entrega Garantía</option>
				    </select> de <input type="date" name="">	hasta <input type="date" name="">		
				    <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-print"></span> Generar Reporte </button>	
					<br>
			 	 	</div>
	 	 		
				</div>


					<!-- 	<div class="panel panel-success">
							<div class="panel-heading">
							    <div class="btn-group pull-right">
							   		
							    		
								</div>
							</div>
						</div> -->

					
					
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
</body>
</html>
