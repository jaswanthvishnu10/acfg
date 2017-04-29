<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');
?>
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
<?php

	$sql = "SELECT DISTINCT(ques_id) FROM FEEDBACK_RESP where course_id = '$course_id'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$sql_sub1 = "SELECT * FROM FEEDBACK_QUES where course_id = '$course_id' AND ques_id = $row[ques_id]" ;
		$result_sub1 = mysqli_query($conn,$sql_sub1);
		$row_sub1 = mysqli_fetch_assoc($result_sub1);
		
		echo "Q. $row_sub1[question]<br>";		//Print  question

		$sql_sub2 = "SELECT * FROM FEEDBACK_RESP where course_id = '$course_id' AND ques_id = $row[ques_id]" ;
		$result_sub2 = mysqli_query($conn,$sql_sub2);
		while($row_sub2 = mysqli_fetch_assoc($result_sub2)){	//while loop to print all responses for each question
		echo $row_sub2[student_id] ." -  $row_sub2[response]<br>";
		}

	}
