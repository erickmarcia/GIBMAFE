<?php
		include 'plantilla.php';
		require 'config.php';

		$sql="SELECT * FROM  tb_externos ORDER BY identificacion_externo ASC ";
		$resultado = $conexion->query( $sql );

		$pdf= new PDF();
		// $pdf->AliasNbPage();
		$pdf->AddPage();
		$pdf->Cell(120,10,'Reporte de Externos ',0,1,'L');
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Cell(20,6,'CODIGO',1,0,'C',1);
		$pdf->Cell(45,6,'NOMBRE',1,0,'C',1);
		$pdf->Cell(20,6,'TIPO',1,0,'C',1);
		$pdf->Cell(80,6,'DIRECCION',1,0,'C',1);
		$pdf->Cell(25,6,'CELULAR',1,1,'C',1);

		$pdf->SetFont('Arial','',10);

		while ($row = $resultado->fetch_assoc())
		{
			$pdf->Cell(20,6,$row['identificacion_externo'],1,0,'C');
			$pdf->Cell(45,6,utf8_decode($row['nombre']) ,1,0,'C');
			$pdf->Cell(20,6, $row['tipo'],1,0,'C');
			$pdf->Cell(80,6,utf8_decode($row['direccion']),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($row['celular']),1,1,'C');
		}


		$pdf->Output();
?>		