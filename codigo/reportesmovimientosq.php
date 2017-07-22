<?php
 /*manejando sesiones siempre va de primero el session para no mostrar el sitio si no hay un usuario conectado*/ 
	session_start();
	 include "config.php";
	// si el usuario esta conectado muestra el sitio de chat si no lo redirige al index para que se logee o se registre
	 	$_SESSION['usuario'];
	 	
if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0){
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}
include('pdf/fpdf/fpdf.php');
require('config.php');

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pdf/images/sen2.png' , 10, 10,50);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(135,'','',0);
$pdf->Cell(140,5,'BOUTIQUE MARIA FERNANDA',0,1,'R');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(135,'','',0);
$pdf->Cell(140,5,'NIT 900354851-5',0,1,'R');
$pdf->Cell(135,'','',0);
$pdf->Cell(140,5,'Hoy: '.date('d-m-Y').'',0,1,'R');
$pdf->Cell(135,'','',0);
$pdf->Cell(140,5,'Usuario|'.$_SESSION['usuario'].'',0,1,'R');
$pdf->Ln(5);
//$pdf->Cell(40, 10, '',1, 0);
// $pdf->Cell(150, 10, 'Abarrotes "PHP & JQuery"', 0);
$pdf->SetFont('Arial', 'B', 11);
//$pdf->Cell(70, 0, '',1, 0);
$pdf->Cell(55, 8, 'REPORTE DE MOVIMIENTOS',0, 0,'C');

$pdf->Ln(5);
$pdf->Cell(190, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta,0, 1, 'L');
//$pdf->Ln(15);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(10, 6, '#', 1,0,'C',1);
$pdf->Cell(20, 6, 'CODIGO', 1,0,'C',1);
$pdf->Cell(60, 6, 'DESCRIPCION', 1,0,'C',1);
$pdf->Cell(15, 6, 'STOCK', 1,0,'C',1);
$pdf->Cell(40, 6, 'MOVIMIENTO', 1,0,'C',1);
$pdf->Cell(20, 6, 'VALOR', 1,0,'C',1);
$pdf->Cell(35, 6, 'FECHA', 1,0,'C',1);
$pdf->Cell(25, 6, 'FACTURA', 1,0,'C',1);
$pdf->Cell(20, 6, 'EXTERNO', 1,0,'C',1);
$pdf->Cell(30, 6, 'ADMIN', 1,0,'C',1);
$pdf->Ln(6);
$pdf->SetFont('Arial', '', 9);
//CONSULTA
$productos="SELECT * FROM tb_movimientos WHERE fecha_movimiento BETWEEN '$desde' AND '$hasta' ";
$resultado=mysqli_query($conexion,$productos);
$item = 0;
$totaldis = 0;
while($row = mysqli_fetch_array($resultado)){
	//$item = $item+1;
	$totaldis = $totaldis + $row['valor_movimiento'];
	//$pdf->Cell(10, 6, $item, 0,0,'C');
	$pdf->Cell(10, 6,$row['cod_movimiento'], 1,0,'C');
	$pdf->Cell(20, 6,$row['cod_producto'], 1,0,'C');
	$pdf->Cell(60, 6, $row['descripcion'], 1,0,'L');
	$pdf->Cell(15, 6,$row['cantidad'], 1,0,'C');
	$pdf->Cell(40, 6,utf8_decode($row['tipo_movimiento']), 1,0,'C');
	$pdf->Cell(20, 6, '$/. '.$row['valor_movimiento'], 1,0,'C');
	$pdf->Cell(35, 6, date('d/m/Y', strtotime($row['fecha_movimiento'])), 1,0,'C');
	$pdf->Cell(25, 6,$row['factura'], 1,0,'C');
	$pdf->Cell(20, 6,$row['identificacion_externo'], 1,0,'C');
	$pdf->Cell(30, 6,$row['usuario'], 1,0,'C');
	
	
	
	$pdf->Ln(6);

}
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(135,6,'',0);
	$pdf->Cell(32,6,'Total Dist: $/. '.$totaldis,0,0,'C');
	$pdf->SetY(165);
	$pdf->SetFont('Arial','I',8);
	$pdf->SetTextColor(128);
	$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');

$pdf->Output();
?>