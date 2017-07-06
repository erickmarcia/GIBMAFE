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
<link href="css/estilo.css" rel="stylesheet">

<script src="js/bootstrap.js"></script>	

<script src="js/jqueryb.js"></script>
<script src="js/myjava.js"></script>
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
			<div class="contenedor-section0	 col-xs-12 col-sm-10 col-sd-10  ">
				<div class="panel panel-success">	
					<div class="panel-heading">
					    <div class="btn-group pull-right">
					    	
					    	<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-edit"></i> Reportes</h4>	
						</div>				
					</div>
					<br>
					<div class="contenedor-section panel-body">
						<div class="container">
				    	<div class="row">
				   
				    		<div class="col-xs-12 col-sm-12">
				    			
				    			
    <table border="0" align="center">
    	<tr>
        	<td width="335"><input type="text" placeholder="Busca un producto por: Nombre o Tipo" id="bs-prod"/></td>
            <td><input type="date" id="bd-desde"/></td>
            <td>Hasta&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="date" id="bd-hasta"/></td>
            
            <td width="200"><a target="_blank" href="javascript:reportePDF();" class="btn btn-danger">Exportar Busqueda a PDF</a></td>
        </tr>
    </table>
    

    <div class="registros" id="agrega-registros"></div>
    <center>
        <ul class="pagination" id="pagination"></ul>
    </center>

				    	</div>
				    	</div>
				    </div>
				</div>									
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


		
