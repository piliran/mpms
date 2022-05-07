<?php
 require_once '../fpdf/fpdf.php';
 
 $pdf = new FPDF('p','mm','A4');

 $pdf->Addpage();

//st font arial, bold, 14pt
 $pdf->SetFont('Arial','B',14);
 
 //cell(width, height, text, border, end line, align)
 $pdf->Cell(130,5,'Name',0,0);
 $pdf->Cell(59,5,'Email',0,1);//end of line

 //St font to arial, regular, 12pt
 $pdf->SetFont('Arial','',12);

 $pdf->Cell(130,5,'Piliran',0,0);
 $pdf->Cell(59,5,'Piliran@gmail.com',0,1);

 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line

//add a dummy cell at beginning of each cell for indentation
 $pdf->Cell(10,5,'',0,0);
 $pdf->Cell(90,5,'Gender',0,1);

  $pdf->Cell(10,5,'',0,0);
 $pdf->Cell(90,5,'Role',0,1);

  $pdf->Cell(10,5,'',0,0);
 $pdf->Cell(90,5,'Department',0,1);

 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line

 $pdf->Output();
 
?>