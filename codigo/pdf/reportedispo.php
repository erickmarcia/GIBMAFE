<?php 
		include 'plantilla.php';
		require 'config.php';

		$sql="SELECT * FROM  tb_disponibles ORDER BY cod_producto ASC ";
		$resultado = $conexion->query( $sql );

		$pdf= new PDF();
		// $pdf->AliasNbPage();
		$pdf->AddPage();
		$pdf->Cell(120,10,'Reporte de Disponible ',0,1,'L');
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Cell(30,6,'CODIGO',1,0,'C',1);
		$pdf->Cell(70,6,'NOMBRE',1,0,'C',1);
		$pdf->Cell(45,6,'PRECIO DE COMPRA',1,0,'C',1);
		$pdf->Cell(45,6,'FECHA DE REGISTRO',1,1,'C',1);

		$pdf->SetFont('Arial','',10);

		while ($row = $resultado->fetch_assoc())
		{
			$pdf->Cell(30,6,$row['cod_producto'],1,0,'C');
			$pdf->Cell(70,6,utf8_decode($row['descripcion']) ,1,0,'L');
			$pdf->Cell(45,6, $row['precio_compra'],1,0,'C');
			$pdf->Cell(45,6,utf8_decode($row['fecha_registro']),1,1,'C');
		}


		$pdf->Output();
?>		