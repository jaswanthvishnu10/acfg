
<?php
require('fpdf/fpdf.php');
require('fpdi/fpdi.php');
include('db.php');
//$course_name='Computer Security';
//$faculty_name='Anu Mary Chaco';
//$sem='Monsoon-2016';
			$sql="SELECT name FROM FACULTY  WHERE faculty_id='$user'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					$faculty_name= $row['name'] ;
				}
			$sql="SELECT course_name FROM COURSE  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					$course_name= $row['course_name'] ;
				}
			$sql="SELECT year,curr_sem FROM FACULTY_COURSE  WHERE course_id='$course_id' and faculty_id='$user'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$rowx = mysqli_fetch_assoc($result);
					if($rowx[curr_sem]==1){$sem='Monsoon';}
					else{$sem='Winter';}
					$course_path = $rowx[year] . '_' . $sem ;					
					$sem = $sem . '-' . $rowx[year];
					
				}

$pdf = new FPDI();
$pdf->AddPage();
$pdf->Cell(0,50,'',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,$course_id . ' : ' . $course_name ,0,1,'C');
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,6,'A',0,1,'C');
$pdf->Cell(0,6,'Course File',0,1,'C');
$pdf->Cell(0,6,'By',0,1,'C');
$pdf->SetFont('Arial','B',18);$pdf->Cell(0,10,'',0,1,'C');
$pdf->Cell(0,10,$faculty_name,0,1,'C');
$pdf->SetFont('Arial','',16);
$pdf->Image('images/nitc-logo.png',85,130,40,50);
$pdf->Cell(0,155,'Department of Computer Science and Engineering',0,1,'C');
$pdf->Cell(0,-130,'National Institute of Technology, Calicut',0,1,'C');$pdf->Cell(0,130,'',0,1,'C');
$pdf->Ln;
$pdf->Cell(0,-105,$sem,0,1,'C');

/*$pdf->AddPage();
try{
$pdf->setSourceFile('SECURITY_ASSIGNMENT.pdf');
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
//$pdf->Output(D); 

$tplIdxA = $pdf->importPage(1);
$pdf->useTemplate($tplIdxA, 0, 0, 0);*/

try{
$pdf->Output("uploads/$course_id/$course_path/$name",'F');
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
//$pdf->Output();
?>
