<?php
		include 'plantilla.php';
		require 'config.php';

		$sql="SELECT * FROM  tb_movimientos ORDER BY cod_movimiento ASC ";
		$resultado = $conexion->query( $sql );

		$pdf= new PDF();
		// $pdf->AliasNbPage();
		$pdf->AddPage();
		$pdf->Cell(120,10,'Reporte de Movimientos ',0,1,'L');
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Cell(10,6,'#',1,0,'C',1);
		$pdf->Cell(30,6,'DESCRIPCION',1,0,'C',1);
		$pdf->Cell(25,6,'CANTIDAD',1,0,'C',1);
		$pdf->Cell(30,6,'ESTADO',1,0,'C',1);
		$pdf->Cell(20,6,'VALOR',1,0,'C',1);
		$pdf->Cell(30,6,'FECHA',1,0,'C',1);
		$pdf->Cell(30,6,'FACTURA',1,0,'C',1);
		$pdf->Cell(30,6,'EXTERNO',1,0,'C',1);
		$pdf->Cell(30,6,'ADMIN',1,0,'C',1);
		$pdf->Cell(40,6,'CODIGO PRODUCTO',1,1,'C',1);
		
		$pdf->SetFont('Arial','',10);

		while ($row = $resultado->fetch_assoc())
		{
			$pdf->Cell(10,6,$row['cod_movimiento'],1,0,'C');
			$pdf->Cell(30,6,utf8_decode($row['descripcion']) ,1,0,'C');
			$pdf->Cell(25,6, $row['cantidad'],1,0,'C');
			$pdf->Cell(30,6, $row['tipo_movimiento'],1,0,'C');
			$pdf->Cell(20,6, $row['valor_movimiento'],1,0,'C');
			$pdf->Cell(30,6, $row['fecha_movimiento'],1,0,'C');
			$pdf->Cell(30,6, $row['factura'],1,0,'C');
			$pdf->Cell(30,6, $row['identificacion_externo'],1,0,'C');
			$pdf->Cell(30,6, $row['usuario'],1,0,'C');
			$pdf->Cell(40,6,utf8_decode($row['cod_producto']),1,1,'C');
		}


		$pdf->Output();
?>		