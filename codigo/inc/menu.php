				<a class="btn-menu">Boutique Maria Fernanda<i class="icono glyphicon glyphicon-align-justify"></i></a>
				<ul class="menu">

				
					<li ><a href="stockdispo.php"><i class="icono izquierda glyphicon glyphicon-sort-by-alphabet" ></i>Stock disponible</a></li>
					
					<li  ><a href="movimientos.php"><i class="icono izquierda glyphicon glyphicon-log-in" ></i>Movimientos</a></li>
					<li ><a href="##"><i class="icono izquierda glyphicon glyphicon-copy" ></i>Registros<i class="icono derecha glyphicon glyphicon-menu-down" ></i></a>
						<ul >
							<li ><a href="productos.php">Productos</a></li>
							<li ><a href="externos.php">Externos</a></li>						
						</ul>
					</li>	
					<li ><a href="#"><i class="icono izquierda glyphicon glyphicon-user" ></i>Administrador<i class="icono derecha glyphicon glyphicon-menu-down" ></i></a>
						<ul >
							<li ><a href="usuario.php"><?php echo $_SESSION['nombre']; ?></a></li>
							<li ><a href="reportes.php">Reportes</a></li>
						</ul>	
					</li>
					<li><a href="logout.php"><i class="icono izquierda glyphicon glyphicon-off" ></i>Cerrar Sesión</a></li>
				</ul>