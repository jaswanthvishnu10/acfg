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
document.getElementById("co-list-button1").className+= " anotherClass1";
</script>

		<div class="col-sm-9"  id="right-bar">
<div id="co-list1">		
				

			<?php
				if(isset($_POST[add_co_btn]))
			{
				$sql = "INSERT INTO COURSE_CO (course_id,co_desc) values ('$course_id','$_POST[co_name]') ";
				mysqli_query($conn,$sql);
							
			}
			if(isset($_POST[delete_course]))
			{
				$sql = "DELETE FROM COURSE_CO WHERE co_id = '$_POST[id]' ";
				mysqli_query($conn,$sql);
					
			}
			
?>
			<div class="form-style-10 ">
				<form method="post">
					<h1>Add New CO</h1>
					<!--<input type='text' name='course_id' placeholder="Course ID" style="width:30%"><br>-->
					<input type='text' name='co_name' placeholder="CO Name" style="width:50%"><br>
					<input type="submit" value="Add CO" name='add_co_btn'>
				</form> <br><br> <h1>Course Outcomes</h1>
			</div>
			<?php
			//echo $course_id;
			$sql="SELECT * FROM COURSE_CO WHERE course_id = '$course_id'";
			$result = mysqli_query($conn,$sql);
			echo "<table id ='selectCourses'><tr><th>CO Name</th></tr>";
			if(mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
	 				echo "<tr><td>".$row["co_desc"]."</td><td>";?>
					<form method='post' onsubmit="return confirm('Are you sure you want to delete the document?');">
					<?php echo "<input type='text' name='id' value='$row[co_id]' hidden><input type='submit' value='Delete' name='delete_course'></form></td></tr>";
				}
			}
			echo "</table>";	 	
			?>
		
			</div>	<!--co-list1 -->

		</div>				
	</div>
</div>



