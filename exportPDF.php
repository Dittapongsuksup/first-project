<?php 
  require('pdf/fpdf.php');

  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->AddFont('student-data','','courier.php');

  $pdf->SetFont('student-data','','10');
  $pdf->Cell(0,10,'Create Data Student',0,1,'C');

  $pdf->Output();
