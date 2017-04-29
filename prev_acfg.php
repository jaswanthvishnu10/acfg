<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');
			$sql="SELECT year,curr_sem FROM FACULTY_COURSE  WHERE course_id='$course_id' and faculty_id='$user'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					if($row[curr_sem]==1){$sem='Monsoon';}
					else{$sem='Winter';}
					$course_path = $row[year] . '_' . $sem ;
					$year=$row[year];
					$sem=$row[curr_sem];
				}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title> Course File </title>
	<link rel="stylesheet" href="css/bootstrap-theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="font/css/font-awesome.css">	
	<link rel="stylesheet" href="css/form.css" />
	<link rel="stylesheet" href="css/examples1.css" />
	<script src="js/jquery-2.2.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>


</head>
<body class="container-fluid">
<?php //include("navbar.php");
 include("subnavbar.php");?>
<script>
document.getElementById("course").className+= " anotherClass";
</script>
<div class="container-fluid">
	<div class="row " style=" margin:2px;">   
		<div class="col-sm-3" id="left-bar">
			<table id="list">
			<tbody>
			    <tr>
			        <td id="courses-list-button" ><a href="course_home.php">Course File</a></td>
			    </tr>
			    <tr>
			        <td id="eval-list-button" ><a href="course_homeep.php">Evaluation plan</a></td>
			    </tr>
			    <tr>
			        <td id="co-list-button1" ><a href="course_homecoi.php">CO - Inputs</a></td>
			    </tr>
			    <tr>
			        <td id="co-list-button2" ><a href="course_homecof.php">CO - Final</a></td>
			    </tr>
			    <tr>
			        <td id="po" ><a href="po.php">PO - Calculation</a></td>
			    </tr>
			    <tr>
			        <td id="prev-acfg" ><a href="prev_acfg.php">Previous Course files</a></td>
			    </tr>
			  	</tbody>
			</table>			
		  </div>		<!--Left Side bar sm-3 -->
<script>
document.getElementById("prev-acfg").className+= " anotherClass1";
</script>
 <div class="col-sm-9"  id="right-bar">
<div name="all-references">
			<table style="margin-top:10px;padding:10px;">
				<tr><th class="col-xs-3">Previous Course Files</th><th class="col-xs-5">Description</th><th class="col-xs-1"></th></tr>
				<?php	
$sql="SELECT * FROM DOCUMENTS WHERE course_id='$course_id' and doc_type='ACFG'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{ 
		if($row[semester] == 1)
		{
			$sem = 'Monsoon';
		}
		else
		{
			$sem = 'Winter';
		}
		echo "<tr><form action='pdfviewer.php' method='post'><td>".$row[doc_name]."</td><td>".$row[year]." ".$sem." </td><td><input type='submit' value ='Open Doc'><input type='hidden' name='doc_path' value='".$row[doc_path]."'></td></tr></form>";
	}
}
else
{
	echo 'No ACFG uploaded';
}
				?>
			</table>
</div>
		</div>
