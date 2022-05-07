<?php
   require_once 'php/session.php';
   require_once '../fpdf/fpdf.php';
  
   $pdf = new FPDF('p','mm','A4');


   if(isset($_POST['fullReportForm'])){
    $name = $_POST['fullName'];
    
    $result = $userObject->generateApprovedRequestsReport();
  

     if ($result) {
        foreach ($result as $row) {
      


       $pdf->Addpage();

//st font arial, bold, 14pt
 $pdf->SetFont('Arial','',12);
 
 //Image(file name, x position, y position, width[optional], height[optional])
 $pdf->Image('logo.jpg',75,0,40,40);
 
  $pdf->Cell(20,40,'',0,1); 
 //cell(width, height, text, border, end line, align)

 
 //St font to arial, regular, 12pt
 $pdf->SetFont('Arial','',12);

 // $pdf->Cell(130,5,,0,0);
 // $pdf->Cell(59,5,,0,1);

 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line

$pdf->SetFont('Arial','',11);

$pdf->SetFont('Arial','B',12);
//add a dummy cell at beginning of each cell for indentation
 $pdf->Cell(30,5,'Initiator',0,0);
 // $pdf->Cell(36,5,'E-mail',1,0);
 $pdf->Cell(30,5,'Department',0,0);
 $pdf->Cell(36,5,'Request',0,0);
 $pdf->Cell(45,5,'Date',0,0);
 $pdf->Cell(36,5,'Signed By',0,1);
 

$pdf->Cell(189,2,'',0,1);

$pdf->SetFont('Arial','',12);
  $pdf->Cell(30,5,$row['name'],0,0);
 // $pdf->Cell(36,5,$row['email'],1,0);
  $pdf->Cell(30,5,$row['department'],0,0);
   $pdf->Cell(36,5,$row['itemName'],0,0);
   $pdf->Cell(45,5,$row['createdAt'],0,0);
    $pdf->Cell(36,5,$row['hod_commentBy'],0,1);
    $pdf->Cell(141,5,'',0,0);
    $pdf->Cell(36,5,$row['dean_commentBy'],0,1);
    $pdf->Cell(141,5,'',0,0);
    $pdf->Cell(36,5,$row['registrar_commentBy'],0,1);
    $pdf->Cell(141,5,'',0,0);
    $pdf->Cell(36,5,$row['viceChancellor_commentBy'],0,1);
    $pdf->Cell(141,5,'',0,0);
    $pdf->Cell(36,5,$row['procurementOfficer_commentBy'],0,1);
    $pdf->Cell(141,5,'',0,0);
    $pdf->Cell(36,5,$row['directorOfFinance_commentBy'],0,1);
    
 
 
 


 
 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line


     }
    $pdf->Output();
    }
    else{
      echo '<h3 class="text-center text-secondary">An error occured!</h3>';
    }
  }

   ?>