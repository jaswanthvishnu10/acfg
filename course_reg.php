<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title> Courses </title>


	<link rel="stylesheet" href="css/bootstrap-theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="font/css/font-awesome.css">
	<link rel="stylesheet" href="css/form.css" />
	<link rel="stylesheet" href="css/examples1.css" />

	<!-- jQuery -->
	 <script src="js/jquery-2.2.2.js"></script>
	 <script src="js/jquery-ui.js"></script>

	 <!-- Latest compiled javascript -->
	 <script src="js/bootstrap.js"></script>
</head>

<body>
<?php include('navbar.php'); ?>
<div class="col-sm-1"></div>
<div class="form-style-10 courses col-sm-10 " >
<form method="post">
	<?php
	$sql="SELECT * FROM COURSE";

	$result = mysqli_query($conn,$sql);
echo "<table id ='selectCourses'><tr><th></th><th>Course ID</th><th>Course Name</th>";
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
	 		echo "<tr> <td><input type='checkbox' name='courses[]' value='" . $row["course_id"] . "'></td><td>". $row["course_id"] . "</td><td>".$row["course_name"]."<br>";
		}
	}
		echo "</table>";
	?>
<div class="button-section" style="margin:20px 0px 0px 150px;">
<input type="submit" value="Submit Course" name="course_reg"/>
</div>
</form>
</div>
<?php
$user=$_SESSION['user'];

if(!empty($_POST['courses'])) {
    foreach($_POST['courses'] as $check) {
            $sql="insert into FACULTY_COURSE (faculty_id,course_id,accepted) values ('$user','$check',0)";
		if(mysqli_query($conn,$sql))
			echo "success";
		else
			echo "fail" . mysqli_error($conn);
    }
}
?>

</body>
