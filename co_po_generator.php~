<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];	
require('fpdf/fpdf.php');
require('fpdi/fpdi.php');
include('db.php');
/*$name_co='temp1.pdf';
$user='nadiya';
$course_id='CS4036';*/
$pos = array();
$cos = array();
$cos_values = array();
		$sql="SELECT * FROM COURSE_PO  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$row1 = mysqli_fetch_assoc($result);
					for($i=1;$i<=12;$i++)
					{
					$str='PO';
					$str .= $i;
					array_push($pos, $row1[$str]);
					}
					array_push($pos,$row1['avg_po']);
					
				}

$sql="SELECT * FROM COURSE_CO  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
			$count_co=mysqli_num_rows($result);
			if(mysqli_num_rows($result) > 0)
				{
				while($row = mysqli_fetch_assoc($result)){
					array_push($cos, $row['co_desc']);
					array_push($cos_values,$row['total']);			
					}
					array_push($cos,'CO_AVG');
					array_push($cos_values,$row1['co_avg']);
				}
/*print_r($pos);
print_r($cos);
print_r($cos_values);*/

$pdf = new FPDI();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,20,'Course Outcome Attainment Scores',0,1,'C');
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Arial','',14);
for($i=1;$i<=$count_co;$i++)
{
$str=str_repeat('a',40);
$strsize=$pdf->GetStringWidth($str);
$temp= $cos[$i-1];
$tempsize=$pdf->GetStringWidth($temp);

$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$coval=round($cos_values[$i-1],2);
$pdf->Cell(0,8,  $cos[$i-1] . $dots ." : " . $coval ,0,1,'L');

}
$pdf->Cell(0,5,'',0,1,'C');

$temp='Weighted Average CO Attainment';
$tempsize=$pdf->GetStringWidth($temp);
$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$coavg=round($cos_values[$i-1],2);
$pdf->Cell(0,8,  $temp . $dots ." : " . $coavg ,0,1,'L');

$temp='Cumulative Percentage Attainment of COs';
$tempsize=$pdf->GetStringWidth($temp);
$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$perc=round((($cos_values[$i-1]/3)*100),2);
$pdf->Cell(0,8,  $temp . $dots ." : " . $perc ,0,1,'L');

$pdf->Cell(0,8,'',0,1,'C');
for($i=1;$i<=	12;$i++)
{
$temp= "PO";
$temp .= $i;
$tempsize=$pdf->GetStringWidth($temp);

$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$poval=round($pos[$i-1],2);
$pdf->Cell(0,8,  $temp . $dots ." : " . $poval ,0,1,'L');
}
$pdf->Cell(0,5,'',0,1,'C');
$temp='Weighted Average PO Attainment';
$tempsize=$pdf->GetStringWidth($temp);
$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$poavg=round($pos[$i-1],2);
$pdf->Cell(0,8,  $temp . $dots ." : " . $poavg ,0,1,'L');

$temp='Cumulative Percentage Attainment of POs';
$tempsize=$pdf->GetStringWidth($temp);
$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth(' ');
$dots=str_repeat(' ',$nb);
$perc=round((($pos[$i-1]/3)*100),2);
$pdf->Cell(0,8,  $temp . $dots ." : " . $perc ,0,1,'L');


try{
$pdf->Output("uploads/$course_id/$course_path/copo.pdf",'F');
array_push($stack, "uploads/$course_id/$course_path/copo.pdf.pdf");
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>
