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
<body>
<?php include('db.php'); 
include('subnavbar.php');
if(isset($_POST['add_ques']))
{	
	if($_POST[q_type] == 0 )
		$sql1 ="INSERT INTO FEEDBACK_QUES (faculty_id,course_id,ques_type,question) VALUES ('$user','$course_id',$_POST[q_type],'$_POST[question]')";
	else
		$sql1 ="INSERT INTO FEEDBACK_QUES (faculty_id,course_id,ques_type,mini,maxi,question) VALUES ('$user','$course_id',$_POST[q_type],$_POST[mini],$_POST[maxi],'$_POST[question]')";
	mysqli_query($conn,$sql1);
}
?>
<script>
document.getElementById("feedback").className+= " anotherClass";

</script>
<div class="container-fluid">
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
document.getElementById("courses-list-button").className+= " lightClass";
</script>
<div class="col-sm-9">
	
	<div class="form-style-10">
	<form method="post">
		<h1> Questions in the Feedback</h1>
		<textarea style="width:60%" placeholder="Type your question here" name ="question"></textarea><br>
		Type of the response <br><br>
		<div style="border:solid #999 1px;border-radius:5px;padding:10px;"><input type="radio" name="q_type" value=0>&nbsp;&nbsp;&nbsp;Text</div><br>
		<div style="border:solid #999 1px;border-radius:5px;padding:10px;">
  		<input type="radio" name="q_type" value=1>&nbsp;&nbsp;&nbsp;Number &nbsp;&nbsp;&nbsp;<br>Expected response Range(only available for Numerical responses):<label>Minimum</label><input type="number" name="mini" placehoder="Min" style="width:50px;"><label>Maximum</label> <input type="number" name="maxi" style="display:inline;width:50px;"><br><br></div>
		<br><input type="submit" name="add_ques" value="Add Question"><br><br>
	</form>
	</div>

	<?php

	$sql = "SELECT question, ques_type FROM FEEDBACK_QUES WHERE faculty_id = '$user' and course_id = '$course_id'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		echo "<table><th class='col-sm-7'>Question</th><th>Response Type</th>";
		while($row=mysqli_fetch_assoc($result))
		{
			echo "<tr><td>" . $row[question] . "</td><td>" . $row[ques_type] . "</td></tr>";
		}
		echo "</table>";
	} 
	?>
	</div>	<!--Right side bar sm-9-->
	</div>	<!--Row-->
</body>
