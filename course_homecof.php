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
					
					while($row = mysqli_fetch_assoc($result))
					{
						$co_id[$i] = $row[co_id];
						$co_desc[$i] = $row[co_desc];	
						$co_total[$i] = $row[total];
						$option .= "<option value='$row[co_id]'>$row[co_desc]</option>";
						$i++;						
					}

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
document.getElementById("co-list-button2").className+= " anotherClass1";
</script>

		<div class="col-sm-9"  id="right-bar">
						<div id="co-list2">

<?php
$sql = "CREATE VIEW T1_TOTAL AS (select sum(t1_max) as t1,course_id FROM COURSE_CO group by course_id)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW T2_TOTAL AS (select sum(t2_max) as t2,course_id FROM COURSE_CO group by course_id)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW T3_TOTAL AS (select sum(t3_max) as t3,course_id FROM COURSE_CO group by course_id)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW ASS_TOTAL AS (select sum(ass_max) as ass,course_id FROM COURSE_CO group by course_id)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW T1_CO_PERC AS (select a.co_id, (a.t1_max/b.t1) as t1_perc,a.course_id  FROM COURSE_CO as a,T1_TOTAL as b where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW T2_CO_PERC AS (select a.co_id, (a.t2_max/b.t2) as t2_perc,a.course_id  FROM COURSE_CO as a,T2_TOTAL as b where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW T3_CO_PERC AS (select a.co_id, (a.t3_max/b.t3) as t3_perc,a.course_id  FROM COURSE_CO as a,T3_TOTAL as b where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW ASS_CO_PERC AS (select a.co_id, (a.ass_max/b.ass) as ass_perc,a.course_id  FROM COURSE_CO as a,ASS_TOTAL as b where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);

$sql = "CREATE VIEW CO_TOTAL1 AS (select a.course_id,a.co_id,a.t1_perc,b.t1 FROM T1_CO_PERC as a JOIN COURSE_CO as b on a.co_id = b.co_id where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_TOTAL2 AS (select a.course_id,a.co_id,a.t2_perc,b.t2 FROM T2_CO_PERC as a JOIN COURSE_CO as b on a.co_id = b.co_id where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_TOTAL3 AS (select a.course_id,a.co_id,a.t3_perc,b.t3 FROM T3_CO_PERC as a JOIN COURSE_CO as b on a.co_id = b.co_id where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_TOTAL_ASS AS (select a.course_id,a.co_id,a.ass_perc,b.ass FROM ASS_CO_PERC as a JOIN COURSE_CO as b on a.co_id = b.co_id where a.course_id = '$course_id' and b.course_id = '$course_id')";
mysqli_query($conn,$sql);

$sql = "CREATE VIEW CO_TOTAL_FINAL AS (select a.course_id,a.co_id,a.t1_perc,a.t1,b.t2_perc,b.t2,c.t3_perc,c.t3,d.ass_perc,d.ass from CO_TOTAL1 as a JOIN CO_TOTAL2 as b JOIN CO_TOTAL3 as c JOIN CO_TOTAL_ASS as d ON a.co_id = b.co_id and a.co_id = c.co_id and a.co_id = d.co_id  where a.course_id ='$course_id' and b.course_id ='$course_id' and c.course_id ='$course_id' and d.course_id ='$course_id')";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_RESULT AS (select a.course_id,a.co_id, ((a.t1_perc*a.t1+a.t2_perc*a.t2+a.t3_perc*a.t3+a.ass_perc*a.ass)/(a.t1_perc+a.t2_perc+a.t3_perc+a.ass_perc)) as result FROM CO_TOTAL_FINAL as a)";
mysqli_query($conn,$sql);

$sql1 = "Select a.course_id,a.co_id,a.result, b.co_desc from CO_RESULT as a join COURSE_CO as b on a.co_id = b.co_id where a.course_id = b.course_id and a.course_id = '$course_id'";
$result = mysqli_query($conn,$sql1);
echo "<table>";
while($row = mysqli_fetch_assoc($result)){
$sql2 = "UPDATE COURSE_CO set total = $row[result] where co_id = $row[co_id]";
mysqli_query($conn,$sql2);
echo "<tr><td>$row[co_desc]</td><td>$row[result]</td><tr>";
}
echo "</table>";

$sql = "CREATE VIEW CO_INDIVDUAL_TOTAL AS (select a.co_id, sum(a.max_marks) as total,a.course_id FROM CO_QUES AS a where a.course_id='$course_id' group by a.co_id)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW COURSE_TOTAL AS (select sum(total) as fullscore from CO_INDIVDUAL_TOTAL)";
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_ATTAINED AS (select a.co_id,b.result,a.total from CO_INDIVDUAL_TOTAL as a JOIN CO_RESULT as b on a.co_id=b.co_id where a.course_id='$course_id' and b.course_id='$course_id')"; 
mysqli_query($conn,$sql);
$sql = "CREATE VIEW CO_AGGREGATE AS (select a.co_id,(a.result*a.total/b.fullscore) as agg FROM CO_ATTAINED as a,COURSE_TOTAL as b)";
mysqli_query($conn,$sql);
$sql = "SELECT sum(a.agg) as ans from CO_AGGREGATE as a";
$result = mysqli_query($conn,$sql);
if($row= mysqli_fetch_assoc($result))
{
	echo "<br><br><strong><center>CO aggregate attained: $row[ans]</center></strong>";
	$fin = $row[ans]/3*100;
	echo "<br><center><strong>Percentage/Weighted CO Attained = $fin</strong></center>";
	$sql2 = "UPDATE COURSE_PO set co_avg = $row[ans] where course_id = '$course_id'";
	mysqli_query($conn,$sql2);
}
$sql = "DROP VIEW T1_TOTAL";
mysqli_query($conn,$sql);
$sql = "DROP VIEW T2_TOTAL";
mysqli_query($conn,$sql);
$sql = "DROP VIEW T3_TOTAL";
mysqli_query($conn,$sql);
$sql = "DROP VIEW ASS_TOTAL";
mysqli_query($conn,$sql);
$sql = "DROP VIEW T1_CO_PERC";
mysqli_query($conn,$sql);
$sql = "DROP VIEW T2_CO_PERC";
mysqli_query($conn,$sql);
$sql = "DROP VIEW T3_CO_PERC";
mysqli_query($conn,$sql);
$sql = "DROP VIEW ASS_CO_PERC";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_TOTAL1";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_TOTAL2";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_TOTAL3";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_TOTAL_ASS";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_TOTAL_FINAL";
mysqli_query($conn,$sql);
$sql = "DROP VIEW CO_RESULT";
mysqli_query($conn,$sql);
?>
			</div>	<!--co-list2 -->		</div>				
	</div>
</div>



