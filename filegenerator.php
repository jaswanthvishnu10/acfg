<?php
include ("db.php");
$stack = array("uploads/$course_id/$course_path/temp.pdf");
array_push($stack, "uploads/$course_id/$course_path/index.pdf");










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

}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}





















$file_names = array();
$file_pages = array();

		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='course'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$coursepath=$row['doc_path'];
			$coursenum = count_pages($coursepath);
			array_push($stack, "$coursepath");
			array_push($file_names, "Course Plan");

			//array_push($file_pages, $coursenum);
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='evalplan'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$course_evalplan=$row['doc_path'];
			$course_evalplan_page_numbers=count_pages($course_evalplan);
			array_push($stack, "$course_evalplan");
			array_push($file_names, "Evaluation Plan");
			//array_push($file_pages, "$course_evalplan_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t1_quespaper'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t1_quespaper=$row['doc_path'];
			$t1_quespaper_page_numbers=count_pages($t1_quespaper);
			array_push($stack, "$t1_quespaper");
			array_push($file_names, "First Mid-term Question Paper");
			//array_push($file_pages, "$t1_quespaper_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t1_keysheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t1_keysheet=$row['doc_path'];
			$t1_keysheet_page_numbers=count_pages($t1_keysheet);
			array_push($stack, "$t1_keysheet");
			array_push($file_names, "First Mid-term Key");
			//array_push($file_pages, "$t1_keysheet_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t1_markssheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t1_markssheet=$row['doc_path'];
			$t1_markssheet_page_numbers=count_pages($t1_markssheet);
			array_push($stack, "$t1_markssheet");
			array_push($file_names, "First Mid-term Marks Sheet");
			//array_push($file_pages, "$t1_markssheet_page_numbers");

		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t2_quespaper'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t2_quespaper=$row['doc_path'];
			$t2_quespaper_page_numbers=count_pages($t2_quespaper);
			array_push($stack, "$t2_quespaper");
			array_push($file_names, "Second Mid-term Question Paper");
			//array_push($file_pages, "$t2_quespaper_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t2_keysheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t2_keysheet=$row['doc_path'];
			$t2_keysheet_page_numbers=count_pages($t2_keysheet);
			array_push($stack, "$t2_keysheet");
			array_push($file_names, "Second Mid-term Key");
			//array_push($file_pages, "$t2_keysheet_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t2_markssheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t2_markssheet=$row['doc_path'];
			$t2_markssheet_page_numbers=count_pages($t2_markssheet);
			array_push($stack, "$t2_markssheet");
			array_push($file_names, "Second Mid-term Marks Sheet");
			//array_push($file_pages, "$t2_markssheet_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='assgn'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$assgn=$row['doc_path'];
			$assgn_page_numbers=count_pages($assgn);
			array_push($stack, "$assgn");
			array_push($file_names, "Assignments");
			//array_push($file_pages, "$assgn_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='assg_key'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$assg_key=$row['doc_path'];
			$assg_key_page_numbers=count_pages($assg_key);
			array_push($stack, "$assg_key");
			array_push($file_names, "Assignments Key");
			//array_push($file_pages, "$assg_key_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='assgn_proj_marks'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$assgn_proj_marks=$row['doc_path'];
			$assgn_proj_marks_page_numbers=count_pages($assgn_proj_marks);
			array_push($stack, "$assgn_proj_marks");
			array_push($file_names, "Assignments Marks Sheet");
			//array_push($file_pages, "$assgn_proj_marks_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='attendance'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$attendance=$row['doc_path'];
			$attendance_page_numbers=count_pages($attendance);
			array_push($stack, "$attendance");
			array_push($file_names, "Attendance");
			
			//array_push($file_pages, "$attendance_page_numbers");
		}
		}

		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t3_quespaper'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t3_quespaper=$row['doc_path'];
			$t3_quespaper_page_numbers=count_pages($t3_quespaper);
			array_push($stack, "$t3_quespaper");
			array_push($file_names, "End-Semester Question Paper");
			//array_push($file_pages, "$t3_quespaper_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t3_keysheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t3_keysheet=$row['doc_path'];
			$t3_keysheet_page_numbers=count_pages($t3_keysheet);
			array_push($stack, "$t3_keysheet");
			array_push($file_names, "End-Semester Key");
			//array_push($file_pages, "$t3_keysheet_page_numbers");
		}
		}
		$sql="SELECT * from DOCUMENTS where faculty_id='$user' and course_id='$course_id' and doc_type='t3_markssheet'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_assoc($result))
			{

			$t3_markssheet=$row['doc_path'];
			$t3_markssheet_page_numbers=count_pages($t3_markssheet);
			array_push($stack, "$t3_markssheet");
			array_push($file_names, "End-Semester Marks");
			//array_push($file_pages, "$t3_markssheet_page_numbers");
		}
		}
array_push($file_pages, 2);
array_push($file_pages, 2);
array_push($file_pages, 2);
array_push($file_pages, 2);
array_push($file_pages, 2);
array_push($file_pages, 4);
$fileArray= $stack;
/*print_r($fileArray);
print_r($file_names);
print_r($file_pages);*/


$pdf= new FPDF(); 




$pdf->AddPage();
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,"Table of Contents " ,0,1,'C');

$total_count=3;
$i=0;
foreach($file_names as $temp) {
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Arial','',12);

$str=str_repeat('a',80);
$strsize=$pdf->GetStringWidth($str);
$temp= $i+1 . "  " . $temp . " ";
$tempsize=$pdf->GetStringWidth($temp);

$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth('.');
$dots=str_repeat('.',$nb);
$pdf->Cell(0,6,  $temp . $dots ." " . $total_count ,0,1,'L');



$total_count = $total_count + $file_pages[$i];
$i=$i+1;

}
$pdf->Cell(0,10,'',0,1,'C');
$temp='Course Outcome Attainment Scores';
$temp= $i+1 . "  " . $temp . " ";
$tempsize=$pdf->GetStringWidth($temp);

$w=$strsize-$tempsize;
$nb=$w/$pdf->GetStringWidth('.');
$dots=str_repeat('.',$nb);
$pdf->Cell(0,6,  $temp . $dots ." " . $total_count ,0,1,'L');

try{
$pdf->Output("uploads/$course_id/$course_path/index.pdf",'F');
//$pdf->Output(D);
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

array_push($fileArray, "uploads/$course_id/$course_path/copo.pdf");




$datadir = "uploads/$course_id/$course_path/";

$outputName = $datadir."ACFG.pdf";
unlink($outputName);
try{


$cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
//Add each pdf file to the end of the command
foreach($fileArray as $file) {
    $cmd .= $file . " ";
}

$result = shell_exec($cmd);
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}


require_once('fpdi/fpdf_tpl.php');
$fullPathToFile = "uploads/$course_id/$course_path/ACFG.pdf";
$pdf = new PDF();
$pdf->AddPage();
if($pdf->numPages>1) {
    for($i=2;$i<=$pdf->numPages;$i++) {
        //$pdf->endPage();
        $pdf->_tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
    }
}
$pdf->Output("uploads/$course_id/$course_path/ACFG.pdf",'D');


					function count_pages($f){
						$stream = fopen($f, "r");
						$content = fread ($stream, filesize($f));

						if(!$stream || !$content)
    							return 0;

						$count = 0;
						// Regular Expressions found by Googling (all linked to SO answers):
						$regex  = "/\/Count\s+(\d+)/";
						$regex2 = "/\/Page\W*(\d+)/";
						$regex3 = "/\/N\s+(\d+)/";

						if(preg_match_all($regex, $content, $matches))
    							$count = max($matches);

						return max($count);
					}

class PDF extends FPDI {

    var $_tplIdx;

    function Header() {

        global $fullPathToFile;

        if (is_null($this->_tplIdx)) {

            // THIS IS WHERE YOU GET THE NUMBER OF PAGES
            $this->numPages = $this->setSourceFile($fullPathToFile);
            $this->_tplIdx = $this->importPage(1);

        }
        $this->useTemplate($this->_tplIdx, 0, 0,200);

    }

    function Footer() {
	// Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

}

?>
