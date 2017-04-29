<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');

$sql="SELECT * FROM COURSE_CO  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
			$co_desc[10];
			$co_id[10];
			$i=0;
			if(mysqli_num_rows($result) > 0)
				{
					$option='';
					while($row = mysqli_fetch_assoc($result))
					{
						$co_id[$i] = $row[co_id];
						$co_desc[$i] = $row[co_desc];	
						$option .= "<option value='$row[co_id]'>$row[co_desc]</option>";
						$i++;						
					}
				}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title> Test 2 | CO</title>
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
<?php //require("navbar.php");
include('subnavbar.php');
 ?>
<script>
document.getElementById("qpapers").className+= " anotherClass";
</script>

<div class="container-fluid">
	<div class="row " style=" margin:2px;">   
			<div class="col-sm-3" id="left-bar">
			<table id="list">
				<tbody>
			    <tr>
			        <td id="qpapers-button" > <a href="t2.php">Question Paper</a> </td>
			    </tr>
			    <tr>
			        <td id="keysheet-button" ><a href="t2_key.php">Key Sheet</a></td>
			    </tr>
			    <tr>
			        <td id="marksheet-button" ><a href="t2_marks.php">Marks Sheet</a></td>
			    </tr>
			    <tr>
			        <td id="co-button" ><a href="t2_co.php">Course Outcome Attainment</a></td>
			    </tr>
				</tbody>
			</table>			
			</div>
<script>
document.getElementById("co-button").className+= " anotherClass1";
</script>
<?php
$sql = "SELECT * from CO_QUES where course_id = '$course_id' and test=2";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
echo "<script>
$(document).ready(function(){
				$('#co-list').hide();
				$('#co-file-insert').show();
				});</script>";
}
else
{
echo "<script>
$(document).ready(function(){
				$('#co-list').show();
				$('#co-file-insert').hide();
				});</script>";
}

?>
		<div class="col-sm-9"  id="right-bar">
			<div id="co-list">
				<div class="form-style-10">
					<form method="post">
		 	   			<h1>T2 Course Objective Attainment</h1>
						<input type = "number" name="numques" placeholder = "Number of questions in Test 2">
						<input type="submit" value = "Get CO-Question Map" name='co-ques-button'>
					</form>
				</div>
				<div id = "co-table">
				<?php
					
					if(isset($_POST['co-ques-button']))
					{	
						echo "<div class='form-style-10'><form method='post' action='t2_co2.php'>";
						echo "<table>";
						$k = $_POST[numques];
						$_SESSION[num] = $k;
						for($j=1;$j<=$k;$j++)
						{
							echo "<tr><td>$j </td><td><input type='number' step='0.01' name='max_ques$j' placeholder='Max Marks awarded'></td><td><select name = 'co_ques$j'>$option</select></td></tr>";
						}
						echo "</table>";
						echo "<input type='submit' value='Submit' name = 'submit-co'></form>";
					}
										 
				?>
				

				
			</div>
		</div> <!-- co-table end -->



		<div id='co-file-insert'>

<?php
	if(isset($_POST['uploadStudent']))
		{

		$file = $_FILES["file"]["tmp_name"];
		$handle = fopen($file, "r");
		$c = 0;
		$sql = "select count(*) from CO_QUES where course_id='" . $course_id . "' and test=2";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$count=$row[0];
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
		$i=1;
		
		while($i<=$count){
		$student_id = $filesop[0];
		$marks = $filesop[$i];
		$test = 2;
		$sql = "INSERT INTO MARKS VALUES ('$course_id','$student_id',$test,$i,$marks)";
		mysqli_query($conn,$sql);

		$i++;
	
	}
		}

}
		?>
	

			<div class="form-style-10">
			<form name="import" method="post" enctype="multipart/form-data">
		    <h1>Students-Marks List <span>Select File to upload</span></h1>
		    <div class="button-section">
		    <input type="file" name="file" id="fileToUpload"><br>
		    <input type="submit" value="Upload" id="students_button" name="uploadStudent">
		   </div>
		</form>
		
<?php
		$sql="CREATE VIEW CO_QUES_MAPPING AS (select c.course_id,c.co_id,c.ques,m.student_id,m.mark,c.test from CO_QUES as c join MARKS as m on m.ques=c.ques and c.test=2 and m.test=2 and c.course_id='$course_id' and m.course_id='$course_id')";
		mysqli_query($conn,$sql);
		$sql="CREATE VIEW CO_QUES_MAPPING_COUNT_AVG AS (select count(*)as cnt,AVG(c.mark) as av,c.co_id from CO_QUES_MAPPING as c group by c.co_id)";
		mysqli_query($conn,$sql);
		$sql="CREATE VIEW GREATER_THAN_AVG_COUNT AS (select a.course_id,a.co_id,a.ques,a.student_id,a.mark,a.test,b.cnt,b.av FROM CO_QUES_MAPPING as a,CO_QUES_MAPPING_COUNT_AVG AS b where a.mark >= b.av and a.co_id=b.co_id)";
		mysqli_query($conn,$sql);
		$sql="CREATE VIEW GREATER_THAN_AVG_COUNT_GROUP AS (select count(*) as cnt1,a.co_id FROM GREATER_THAN_AVG_COUNT as a group by a.co_id)";
		mysqli_query($conn,$sql);
		$sql="CREATE VIEW FINAL AS (select a.cnt1,a.co_id,b.cnt from GREATER_THAN_AVG_COUNT_GROUP as a join CO_QUES_MAPPING_COUNT_AVG as b on a.co_id=b.co_id )";
		mysqli_query($conn,$sql);
		$sql1 = "SELECT (a.cnt1/a.cnt*100) as perc,a.co_id as cot FROM FINAL AS a";
		$result = mysqli_query($conn,$sql1);

$cnt1 = mysqli_num_rows($result);


while($row = mysqli_fetch_assoc($result))
	{
if($row[perc]>=40 && $row[perc]<=59)
{
$score = 1;
}
else if($row[perc]>=60 && $row[perc]<=79)
{
$score = 2;
}
else if($row[perc]>=80 && $row[perc]<=100)
{
$score = 3;
}
else
{
$score = 0;
}
$sql = "UPDATE COURSE_CO SET t2=$score where co_id=$row[cot] and course_id = '$course_id'";
mysqli_query($conn,$sql);
}

$sql="DROP VIEW CO_QUES_MAPPING";
mysqli_query($conn,$sql);
$sql="DROP VIEW CO_QUES_MAPPING_COUNT_AVG";
mysqli_query($conn,$sql);
$sql="DROP VIEW GREATER_THAN_AVG_COUNT";
mysqli_query($conn,$sql);
$sql="DROP VIEW GREATER_THAN_AVG_COUNT_GROUP";
mysqli_query($conn,$sql);
$sql="DROP VIEW FINAL";
mysqli_query($conn,$sql);
$sql="SELECT * FROM COURSE_CO  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
$cnt1=mysqli_num_rows($result);
echo "<table><tr>";
if(mysqli_num_rows($result) > 0)
	{
for($q=1;$q<=$cnt1;$q++)
      {		
	echo "<th>CO$q</th>";
	}
echo "</tr><tr>";
	while($row = mysqli_fetch_assoc($result))
	{
	echo "<td> $row[t2] </td>";
	}
}
echo "</table>";
	?>


		
	</div>
	</div>
</div>	
