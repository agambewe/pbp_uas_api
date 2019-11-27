<?php

include('../db.php');


// Koneksi library FPDF
require('../fpdf181/fpdf.php');
// Setting halaman PDF
$pdf = new FPDF('l','mm','A4');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf->Cell(260,7,'Logs',0,1,'C');
// Setting spasi kebawah supaya tidak rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'NO',1,0);
$pdf->Cell(55,6,'EMAIL',1,0);
$pdf->Cell(55,6,'SEAT',1,0);
$pdf->Cell(55,6,'BOOK',1,1);

$pdf->SetFont('Arial','',12);
$query = mysqli_query($con, "SELECT * FROM logs");
$no = 1;
while ($data = mysqli_fetch_array($query)){
    $pdf->Cell(10,6,$no,1,0);
    $pdf->Cell(55,6,$data['email'],1,0);
    $pdf->Cell(55,6,$data['seat'],1,0);
    $pdf->Cell(55,6,$data['currentBook'],1,1);
    $no++;
}

$pdf->Output();
?>