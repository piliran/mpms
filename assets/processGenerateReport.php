 <?php
   require_once 'php/session.php';
  require_once '../fpdf/fpdf.php';
  
   $pdf = new FPDF('p','mm','A4');
 
  
  //handle print report ajax request
if(isset($_POST['ReportForm'])){

 $id =$userObject->test_input($_POST['id']);
 $result = $userObject->printReportData($id);
  

 if ($result) {
     foreach ($result as $row) {
      


 $pdf->Addpage();

//st font arial, bold, 14pt
 $pdf->SetFont('Arial','',12);
 
 //Image(file name, x position, y position, width[optional], height[optional])
 $pdf->Image('logo.jpg',75,0,40,40);
 
  $pdf->Cell(20,40,'',0,1); 
 //cell(width, height, text, border, end line, align)

 $pdf->SetFont('Arial','B',12);
 $pdf->Cell(100,5,'',0,0);
 $pdf->Cell(42,5,'Supplier Name :',0,0);

  $pdf->SetFont('Arial','',12); 
 $pdf->Cell(40,5,$row['name'],0,1);//end of line
 
  $pdf->SetFont('Arial','B',12);
 $pdf->Cell(100,5,'',0,0);
 $pdf->Cell(42,5,'Email :',0,0);

  $pdf->SetFont('Arial','',12); 
 $pdf->Cell(40,5,$row['email'],0,1);//end of line

 $pdf->SetFont('Arial','B',12);
 $pdf->Cell(100,5,'',0,0);
 $pdf->Cell(42,5,'Mobile :',0,0);

  $pdf->SetFont('Arial','',12); 
 $pdf->Cell(40,5,$row['phone'],0,1);//end of line
 //St font to arial, regular, 12pt
 $pdf->SetFont('Arial','',12);

 // $pdf->Cell(130,5,,0,0);
 // $pdf->Cell(59,5,,0,1);

 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line

$pdf->SetFont('Arial','',11);

$pdf->SetFont('Arial','B',12);
//add a dummy cell at beginning of each cell for indentation
 $pdf->Cell(36,5,'Resources',0,0);
 $pdf->Cell(36,5,'Cost',0,0);
 $pdf->Cell(36,5,'Date',0,1);

$pdf->Cell(189,2,'',0,1);

$pdf->SetFont('Arial','',12);
  $pdf->Cell(36,5,$row['resourceName'],0,0);
 $pdf->Cell(36,5,$row['resourceCost'],0,0);
 $pdf->Cell(36,5,$row['dateSent'] ,0,1);
 
 $pdf->Cell(189,20,'',0,1);

 $pdf->SetFont('Arial','I',10);

 $pdf->Cell(25,10,'Signed By:',0,0);
 $pdf->Cell(24,10,$row['directorOfFinance_commentBy'],0,0);
 $pdf->Cell(40,10,'(Director of finance)',0,0);
 $pdf->Cell(7,10,'&',0,0);
 $pdf->Cell(28,10,$row['procurementOfficer_commentBy'],0,0);
  $pdf->Cell(20,10,'(Procurement Officer)',0,1);
 //make a dummy empty cell as a vertical spacer
 $pdf->Cell(189,10,'',0,1);//end of line


     }
    $pdf->Output();
    }
    else{
      echo '<h3 class="text-center text-secondary">An error occured!</h3>';
    }
  }



// $pdf->Cell('5','5',$n1,'1','0');
//   $pdf->Cell('50','5',ucfirst($row1['fname'])."    ".ucfirst($row1['surname']),'1','0');
//   $pdf->Cell('30','5','K'.number_format($row1['loan_amount'],2,'.',','),'1','0');
//   $pdf->Cell('32','5','K'.number_format($row1['total_amount'],2,'.',',')."(".$row1['interest_rate']."%)",'1','0');
//   $pdf->Cell('38','5',$row1['loan_duration'],'1','0');
//   $pdf->Cell('0','5',$row1['pnumber'],'1','1');
  
// //second table

// $pdf->SetFont('arial','B','12');
// $pdf->Cell('5','5','','1','0');
// $pdf->Cell('0','5','MEMBERS WITH UNSETTLED LOANS','1','1','C');
// $pdf->SetFont('arial','B','7');
// $pdf->Cell('5','5','#','1','0');
// $pdf->Cell('50','5','BORROWER NAME','1','0');
// $pdf->Cell('30','5','LOAN AMOUNT','1','0');
// $pdf->Cell('32','5','LOAN AMOUNT+interest','1','0');
// $pdf->Cell('38','5','LOAN DURATION','1','0');
// $pdf->Cell('0','5','PHONE NUMBER','1','1');

//   $pdf->Cell('5','5',$n2,'1','0');
//   $pdf->Cell('50','5',ucfirst($row2['fname'])."    ".ucfirst($row2['surname']),'1','0');
//   $pdf->Cell('30','5','K'.number_format($row2['loan_amount'],2,'.',','),'1','0');
//   $pdf->Cell('32','5','K'.number_format($row2['total_amount'],2,'.',',')."(".$row2['interest_rate']."%)",'1','0');
//   $pdf->Cell('38','5',$row2['loan_duration'],'1','0');
//   $pdf->Cell('0','5',$row2['pnumber'],'1','1');


// $pdf->SetFont('arial','B','12');
// $pdf->Cell('5','5','','1','0');
// $pdf->Cell('0','5','UN APPROVED LOANS','1','1','C');
// $pdf->SetFont('arial','B','7');
// $pdf->Cell('5','5','#','1','0');
// $pdf->Cell('50','5','LOAN REQUESTOR NAME','1','0');
// $pdf->Cell('30','5','LOAN AMOUNT','1','0');
// $pdf->Cell('32','5','LOAN AMOUNT+interest','1','0');
// $pdf->Cell('38','5','LOAN DURATION','1','0');
// $pdf->Cell('0','5','PHONE NUMBER','1','1');

//   $pdf->Cell('5','5',$n3,'1','0');
//   $pdf->Cell('50','5',ucfirst($row3['fname'])."    ".ucfirst($row3['surname']),'1','0');
//   $pdf->Cell('30','5','K'.number_format($row3['loan_amount'],2,'.',','),'1','0');
//   $pdf->Cell('32','5','K'.number_format($row3['total_amount'],2,'.',',')."(".$row3['interest_rate']."%)",'1','0');
//   $pdf->Cell('38','5',$row3['loan_duration'],'1','0');
//   $pdf->Cell('0','5',$row3['pnumber'],'1','1');

// $pdf->SetTextColor('150','0','0');
// $pdf->SetFont('times','','15');
// $pdf->RotatedText(70,93,'Chifuniro village Bank',50);
// //$pdf->RotatedImage('images/cvb.png',130,85,40,36,0);
// $pdf->Output();//D
 

 
  ?>