<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');
			$sql="SELECT year,curr_sem FROM FACULTY_COURSE  WHERE course_id='$course_id' and faculty_id='$user'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_assoc($result);
					if($row[curr_sem]==1){$sem='Monsoon';}
					else{$sem='Winter';}
					$course_path = $row[year] . '_' . $sem ;
					$year=$row[year];
					$sem=$row[curr_sem];
				}

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title> Attendance </title>
	<link rel="stylesheet" href="css/bootstrap-theme.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="font/css/font-awesome.css">	
	<link rel="stylesheet" href="css/form.css" />
	<link rel="stylesheet" href="css/examples1.css" />
	<script src="js/jquery-2.2.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>

 <?php include('db.php'); ?>
</head>
<script>
$(document).ready(function(){

	$("#students-list").hide();
	$("#courses-list").show();
	$("#references-list").hide();

	$("#students-list-button").click(function(){
	    $("#students-list").show();
	    $("#courses-list").hide();
	$("#references-list").hide();
	});


	$("#courses-list-button").click(function(){
	    $("#students-list").hide();
	    $("#courses-list").show();
	$("#references-list").hide();
	});

	$("#references-list-button").click(function(){
	    $("#courses-list").hide();
	    $("#students-list").hide();
	$("#references-list").show();
	});
});

</script>

<body class="container-fluid">
<?php //include("navbar.php");
include('subnavbar.php'); 
?>
<script>
document.getElementById("attendance").className+= " anotherClass";
</script>
		<div class="col-sm-3"></div>
		<div id="courses-list" class="col-sm-9">		
		<div class="form-style-10">
		 
		<form method="post" enctype="multipart/form-data">
		    <h1>Attendance <span>Select Attendance File to upload</span></h1>
		    <div class="button-section">
		    <input type="file" name="fileToUpload" id="fileToUpload"><br> 
		    
		    <input type="submit" value="Upload" id="course_submit" name="uploadCourse">
		   </div>
		</form>
		
		</div>  <!-- Form style -->
		<?php
		if(isset($_POST['uploadCourse'])){
		$description = $_POST[description];
		$target_dir = "uploads/$course_id/$course_path/attendance/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.<br>";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.<br>";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
		    } else {
			$uploadOk = 0;
			echo 'Sorry, there was an error uploading your file.';

			
		    }
		}
		$filename = $_FILES["fileToUpload"]["name"];
		$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,description,year,semester) VALUES ('$user','$course_id','attendance','$filename','$target_file','$description',$year,$sem)";

		if($uploadOk != 0 && mysqli_query($conn,$qry)){
			
			echo "DB update successful<br>";
		}
		else{
			echo mysqli_error();
		}
		}
		?>
		</div><!-- List of courses Plans --><!-- List of courses Plans -->
		
	</body>


</html>
    
