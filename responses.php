<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');
include('subnavbar.php');
?>
<script>
document.getElementById("feedback").className+= " anotherClass";
</script>
<head>
<title> Feedback </title>
	<link rel="stylesheet" href="css/bootstrap-theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="font/css/font-awesome.css">	
	<link rel="stylesheet" href="css/form.css" />
	<link rel="stylesheet" href="css/examples1.css" />
	<script src="js/jquery-2.2.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
	<div class="col-sm-3">
	<div class="form-style-10"><form action="feedback_request.php"><input type="submit" value="Collect feedback"></form></div>
	<table id="list">
		<tbody>
		    <tr>
			<td id="courses-list-button" ><a href="feedback.php">Add Questions</a></td>
		    </tr>
		    <tr>
			<td id="eval-list-button" ><a href="responses.php">View Responses</a></td>
		    </tr>
		  	</tbody>
		</table>
	</div>	<!--Left Side bar sm-3 -->
<script>
document.getElementById("eval-list-button").className+= " lightClass";
</script>

	<div class="col-sm-9">
<?php

	$sql = "SELECT DISTINCT(ques_id) FROM FEEDBACK_RESP where course_id = '$course_id'";
	$result = mysqli_query($conn,$sql);
	$i=1;
	while($row = mysqli_fetch_assoc($result)){
		$sql_sub1 = "SELECT * FROM FEEDBACK_QUES where course_id = '$course_id' AND ques_id = $row[ques_id]" ;
		$result_sub1 = mysqli_query($conn,$sql_sub1);
		$row_sub1 = mysqli_fetch_assoc($result_sub1);
		
		echo "<h2>Q$i. $row_sub1[question]</h2><br>";		//Print  question

		$sql_sub2 = "SELECT * FROM FEEDBACK_RESP where course_id = '$course_id' AND ques_id = $row[ques_id]" ;
		$result_sub2 = mysqli_query($conn,$sql_sub2);
		while($row_sub2 = mysqli_fetch_assoc($result_sub2)){	//while loop to print all responses for each question
		echo $row_sub2[student_id] ." -  $row_sub2[response]<br>";
		}
		$i++;
	}
	
?>
	</div>	<!--Right Side bar sm-9 -->
