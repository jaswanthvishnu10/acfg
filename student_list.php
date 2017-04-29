<?php 
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
?>
<html>
<head>
<title> Students List </title>
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
<body>
<?php //include('navbar.php');
include('subnavbar.php');
if(isset($_POST["delete-student"]))
		{
		$sql = "DELETE FROM STUDENT WHERE student_id ='" . $_POST['student_id'] ."'" ;
		mysqli_query($conn,$sql);
		if(!mysqli_query($conn,$sql))
		{
		echo mysqli_error($conn);
		}
		header("student_list.php");
		}



	if(isset($_POST["update-student"]))
		{
		$sql = "UPDATE STUDENT SET 
			student_name='" . $_POST['student_name'] ."',
			email='" . $_POST['email'] ."',
			mobile='" . $_POST['mobile'] ."'
			 WHERE student_id='" . $_POST['student_id'] . "'";
		mysqli_query($conn,$sql);
		if(!mysqli_query($conn,$sql))
		{
		echo mysqli_error($conn);
		}
		header("student_list.php");
		}
?>
<script>
document.getElementById("student").className+= " anotherClass";
</script>
<div class="col-sm-3"></div>
<div class="col-sm-9"  id="right-bar">
		<div id="students-list" width="100%">		
		<div class="form-style-10">
		<form name="import" method="post" enctype="multipart/form-data">
		    <h1>Students List <span>Select Students list File to upload</span></h1>
		    <div class="button-section">
		    <input type="file" name="file" id="fileToUpload"><br>
		    <input type="submit" value="Upload" id="students_button" name="uploadStudent">
		   </div>
		</form>
		
		</div>
			<table style="padding:10px;">
			<tr>
			<th class="col-xs-4">Roll Number</th>
			<th class="col-xs-4">Student Name</th>
			<th class="col-xs-4">E-mail</th>
			<th class="col-xs-2">Mobile</th>
			<th class="col-xs-1"></th></tr>
			<?php	
			$sql="SELECT a.student_id,a.student_name,a.email,a.mobile  
				FROM STUDENT a,STUDENT_COURSE b 
				WHERE a.student_id=b.student_id and b.course_id='$course_id' ";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0)
			{
			$i=0;
			 while($row = mysqli_fetch_assoc($result))
				{
			echo "<tr>
			<td> " . $row[student_id] . "</td>
			<td> " . $row[student_name] . "</td>
			<td> " . $row[email] . "</td>
			<td> " . $row[mobile] . "</td>";
?>
			<td><form method='post' enctype='multipart/form-data' onsubmit="return confirm('Are you sure you want to delete the account?');">
<?php			echo "<input name='student_id' type='text' value ='" . $row[student_id] . " 'hidden>
			<input type='submit' name='delete-student' value ='Delete'>
			</form></td>
			
		<div class='container'>
		
  	<td><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal" . $i . "'>Update</button></td>
 		 <div class='modal fade' id='myModal" . $i . "' role='dialog'>
 		   <div class='modal-dialog'>
     			 <div class='modal-content'>
        			<div class='modal-header'>
          				<button type='button' class='close' data-dismiss='modal'>&times;</button>
          					<h4 class='modal-title'>Modal Header</h4>
       				 </div>
        		<div class='modal-body'>
			 <form method='post' enctype='multipart/form-data'>
			<input name='student_id' type='text' value ='" . $row[student_id] . " 'hidden>
			<input name='student_name'  type='text' value ='" . $row[student_name] . "'>
			<input name='email'  type='text' value ='" . $row[email] . "'>
			<input name='mobile' type='text' value ='" . $row[mobile] . "'>
			<input type='submit' name='update-student' value ='Update'>
			</form>
			
        			</div>
        		<div class='modal-footer'>
          		<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
       			 </div>
      		</div>
    		</div>

  	</div> 
</div></tr>";
$i++;
					}
				}
				else
				{
					echo 'Students are not available';
				}
				?>
			</table>
		</div>
		
	</div>

<?php
	

	

	if(isset($_POST["uploadStudent"]))
		{
		$file = $_FILES["file"]["tmp_name"];
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
		$student_id = $filesop[0];
		$student_name = $filesop[1];
		$student_email = $filesop[2];
		$student_mobile = $filesop[3];

		$sql = "INSERT INTO STUDENT (student_id, student_name, email, mobile) VALUES ('$student_id','$student_name','$student_email','$student_mobile')";
		mysqli_query($conn,$sql);
		$course_id = $_SESSION[course_id];
		$sql2 = "INSERT INTO STUDENT_COURSE VALUES ('$student_id','$course_id')";
		if(!mysqli_query($conn,$sql2))
		{
		echo mysqli_error($conn);
		}
		$c = $c + 1;
		}

		if($c>0){
		echo "You database has imported successfully. You have inserted ". $c ." records";
		echo "<script type='text/javascript'>
		$(document).ready(function(){

			$('#students-list').show();
			$('#courses-list').hide();
			$('#references-list').hide();

		});
		</script>";
		}else{
		echo "Sorry! There is some problem.";
		}
		}


		?>

</body>
