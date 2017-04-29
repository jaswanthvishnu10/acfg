<?php 
session_start();
if(isset($_POST[course_submit]))
{
	$_SESSION[course_id] = $_POST[course_id];
	header("Location: course_home.php");
			exit();
}
?>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<link href='fullcalendar-3.0.1/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar-3.0.1/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='fullcalendar-3.0.1/lib/moment.min.js'></script>
<script src='fullcalendar-3.0.1/lib/jquery.min.js'></script>
<script src='fullcalendar-3.0.1/fullcalendar.min.js'></script>
</head>
<body class="container-fluid">
<?php
require("navbar.php");
$user= $_SESSION[user];
$pass= $_SESSION[pass];

include ("db.php");
	$sql="SELECT * FROM FACULTY WHERE faculty_id='$user' and password='$pass'";
	$result=mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);
$name=$row[name];
$dept_id=$row[dept_id];
$phone=$row[phone];
$email=$row[email];
$dob=$row[dob];
$_SESSION[name] = $name;
$_SESSION[dept_id] = $dept_id;
?>

<?php
$sql="SELECT b.course_name,b.course_id FROM FACULTY_COURSE as a,COURSE as b WHERE a.faculty_id='$user' and a.course_id=b.course_id and a.accepted=1";
	$result=mysqli_query($conn,$sql);
?>
<div class="col-sm-7">
<div class="form-style-10" style="width:100%">
<h1>Courses currently handled</h1>
<table style='width:100%'>
<tr><th class="col-xs-1" style="padding-left:0px;">Course Id</th><th class="col-xs-5" style="padding-left:0px;">Course Name</th><th class="col-xs-3"></th></tr>
<?php

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><form method='post'><td><input type='hidden' name='course_id' value=". $row[course_id] .">" . $row[course_id] ." </td><td>" . $row[course_name] ." </td>";
	echo "<td><input type='submit'  name='course_submit' value='get this course'></form></td></tr>";
    }
} else {
    echo "No courses";

}

?>
</table>
</div>
</div>
<div class="col-sm-5">
<a href='course_reg.php'><button type='button' class="btn">Register for new course</button></a><a href='organizer.php' style="float:right"><button type='button' class="btn">Add reminder/event</button></a><br><br><br>
	<div id="calendar">
		<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			defaultDate: '<?php echo date("Y-m-d");?>',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php 
$sql="select * from CALENDAR where id='admin' or id='$user'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
	
		while($row=mysqli_fetch_assoc($result))
		echo "{ title: '$row[event]', start: '$row[start_date]', end: '$row[end_date]' },"; 
	
}				
				?>		]
		});
		
	});

</script>
	</div>
</div>
</body>
</html>
