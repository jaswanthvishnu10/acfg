<?php
session_start();
$user = $_SESSION[user];
include('db.php');
?>
<head>
        <title> Calendar </title>
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
<?php include('navbar.php');?>
<div class="col-sm-3"></div>
<div id="calendar-input" class="col-sm-5" style="margin-top:20px;"> 
		<div class="form-style-10 ">
		 <h1>Calendar<span>Manually input Calendar events</span></h1>
		<form method="post">
		<input type="text" name="event" placeholder="Event" >
		<input type="date" name="start_date" placeholder="From Date" >
		<input type="date" name="end_date" placeholder="End Date">
		<input type='submit' name='add_event' value="Add Event">
		</form>
		</div>
<?php
if(isset($_POST[add_event]))
{

	$sql="INSERT INTO CALENDAR (event,start_date,end_date,id) VALUES ('$_POST[event]','$_POST[start_date]','$_POST[end_date]','$user')";

	if(mysqli_query($conn,$sql))
	{
		echo "<br>Event added Successfully<br>";
	}
	else
	{
		echo "<br>Event failed to be added<br>" . mysqli_error();
	}
}
?>
</body>
