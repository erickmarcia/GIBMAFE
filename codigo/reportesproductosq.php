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

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('pdf/images/sen2.png' , 10, 10,50);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(50,'','',0);
$pdf->Cell(140,5,'BOUTIQUE MARIA FERNANDA',0,1,'R');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50,'','',0);
$pdf->Cell(140,5,'NIT 900354851-5',0,1,'R');
$pdf->Cell(50,'','',0);
$pdf->Cell(140,5,'Hoy: '.date('d-m-Y').'',0,1,'R');
$pdf->Cell(50,'','',0);
$pdf->Cell(140,5,'Usuario|'.$_SESSION['usuario'].'',0,1,'R');
$pdf->Ln(5);
//$pdf->Cell(40, 10, '',1, 0);
// $pdf->Cell(150, 10, 'Abarrotes "PHP & JQuery"', 0);
$pdf->SetFont('Arial', 'B', 11);
//$pdf->Cell(70, 0, '',1, 0);
$pdf->Cell(190, 8, 'REPORTE DE PRODUCTOS',0, 0,'C');

$pdf->Ln(5);
$pdf->Cell(190, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta,0, 1, 'L');
//$pdf->Ln(15);

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(10, 8, '#', 1,0,'C');
$pdf->Cell(15, 8, 'Codigo', 1,0,'C');
$pdf->Cell(95, 8, 'Item', 1,0,'C');
$pdf->Cell(35, 8, 'Precio Distribuidor', 1,0,'C');
$pdf->Cell(35, 8, 'Fech. Registro', 1,0,'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 9);
//CONSULTA
$productos="SELECT * FROM tb_productos WHERE fecha_registro BETWEEN '$desde' AND '$hasta' ";
$resultado=mysqli_query($conexion,$productos);
$item = 0;
$totaldis = 0;
while($row = mysqli_fetch_array($resultado)){
	$item = $item+1;
	$totaldis = $totaldis + $row['precio_compra'];
	$pdf->Cell(10, 8, $item, 0,0,'C');
	$pdf->Cell(15, 8,$row['cod_producto'], 0,0,'C');
	$pdf->Cell(95, 8, $row['descripcion'], 0,0,'L');
	$pdf->Cell(35, 8, '$/. '.$row['precio_compra'], 0,0,'C');
	$pdf->Cell(35, 8, date('d/m/Y', strtotime($row['fecha_registro'])), 0,0,'C');
	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(125,8,'',0);
$pdf->Cell(32,8,'Total Dist: $/. '.$totaldis,0,0,'C');

$pdf->Output();
?>
