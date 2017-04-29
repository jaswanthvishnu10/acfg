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

<style>
th,td,input{
width:50px;

}
</style>
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
document.getElementById("po").className+= " anotherClass1";
</script>

		<div class="col-sm-9"  id="right-bar">
			<?php
			echo "<form method='post'><table><tr><th></th><th>PO1</th><th>PO2</th><th>PO3</th><th>PO4</th><th>PO5</th><th>PO6</th><th>PO7</th><th>PO8</th><th>PO9</th><th>PO10</th><th>PO11</th><th>PO12</th></tr>";
			for($j=1;$j<=$i;$j++)
			{
				echo "<tr><td>CO$j</td>
					<td><input type='number' name='p1_c$j' value=0 ></td>
					<td><input type='number' name='p2_c$j' value=0></td>
					<td><input type='number' name='p3_c$j' value=0></td>
					<td><input type='number' name='p4_c$j' value=0></td>
					<td><input type='number' name='p5_c$j' value=0></td>
					<td><input type='number' name='p6_c$j' value=0></td>
					<td><input type='number' name='p7_c$j' value=0></td>
					<td><input type='number' name='p8_c$j' value=0></td>
					<td><input type='number' name='p9_c$j' value=0></td>
					<td><input type='number' name='p10_c$j' value=0></td>
					<td><input type='number' name='p11_c$j' value=0></td>
					<td><input type='number' name='p12_c$j' value=0></td>";
			}
			echo "</table><br><center><input type='submit' style='width:100px;' value='Get PO' name='po-get'></center></form>";
		
			?>

<?php 
$sql ="select * from COURSE_PO where course_id ='$course_id'";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_assoc($result))
{

	if($row[flag]==1)
	{
	echo "<br><div id='fix-table'><table><tr>";
		for($z=1;$z<=12;$z++)
		{
			$s = 'PO';
			$s .= $z;		
			echo "<td>$row[$s]</td>";
		}
	echo "</tr></table></div>";
	echo "<br><br><center><strong>PO Attained = $row[avg_po]</strong></center>";
	$fin = $row[avg_po]/3*100;
	echo "<br><center><strong>Percentage/Weighted PO Attained = $fin</strong></center>";
	}


}
?>

<?php

if(isset($_POST['po-get']))
{
echo "	<script>
	$('#fix-table').hide();
	</script>";
	$sum3=0;
	echo "<table><tr>";
	for($k=1;$k<=12;$k++)
	{
		$sum1=0;
		$sum2=0;
		for($q=1;$q<=$i;$q++)
		{
			$str ='p';
			$str .= $k;
			$str .= '_c';
			$str .= $q;
			$sum1=$sum1+$co_total[$q-1]*$_POST[$str];
			$sum2=$sum2+$_POST[$str];
		}
		$res = $sum1/$sum2;
		
		$sum3=$sum3+$res;
		
		$res = round($res,2);
		$sql="update COURSE_PO set PO$k=$res where course_id='$course_id'";
		mysqli_query($conn,$sql);
		echo "<td>$res</td>";
	
			}

	echo "</tr></table>";
	$fin = $sum3/12;
$sql="update COURSE_PO set avg_po=$fin ,flag=1 where course_id='$course_id'";
		mysqli_query($conn,$sql);
	echo "<br><br><center><strong>PO Attained = $fin</strong></center>";
	$fin = $fin/3*100;
	echo "<br><center><strong>Percentage/Weighted PO Attained = $fin</strong></center>";
}

?>

		</div>				
	</div>
</div>



