<?php
session_start();
$user = $_SESSION[user];
$course_id='100';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title> Approval | Admin </title>

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
<script>
$(document).ready(function(){

	$("#teacher-reg").show();
	$("#course-reg").hide();
	$("#time-table").hide();
	$("#calendar-input").hide();
	$("#add-course").hide();
	

	$("#teachers-reg-button").click(function(){
	    $("#teacher-reg").show();
	    $("#course-reg").hide();
	    $("#time-table").hide();
	    $("#calendar-input").hide();
	    $("#add-course").hide();
	});

	

	$("#course-reg-button").click(function(){
	    $("#teacher-reg").hide();
	    $("#course-reg").show();
	    $("#time-table").hide();
	    $("#add-course").hide();
	    $("#calendar-input").hide();
	});

	$("#time-table-button").click(function(){
	    $("#teacher-reg").hide();
	    $("#course-reg").hide();
	    $("#time-table").show();
	    $("#calendar-input").hide();
	    $("#add-course").hide();
	});
	$("#calendar-input-button").click(function(){
	    $("#teacher-reg").hide();
	    $("#course-reg").hide();
	    $("#time-table").hide();
	    $("#calendar-input").show();
	    $("#add-course").hide();
	});
	$("#add-course-button").click(function(){
	    $("#teacher-reg").hide();
	    $("#course-reg").hide();
	    $("#time-table").hide();
	    $("#calendar-input").hide();
	    $("#add-course").show();
	});
});

</script>

<?php
session_start();
include('db.php'); ?>
<body>
<nav class = " row navbar navbar-default container-fluid" role = "navigation" style="background:#2A88AD;">
   
   <div class = "navbar-header col-sm-4">
      <a class = "navbar-brand" href = "approval.php" style="color:white;font-size:1.6em;margin-top:10px;">Automatic Course File Generator</a>
   </div>
   
   <div>
      <ul class = "nav navbar-nav navbar-right col-md-8">
	<form  action="logout.php" method="post" id="login_form">
	 <div class="col-sm-10"></div>
         <input class="col-sm-1 btn" style="margin:14px 5px 4px 5px;" type="submit" value="Logout" name="submit">	
	</form> 		
      </ul>
   </div>
   
</nav>
<div class="container-fluid">
		<div class="row " style=" margin:2px;">   
			<div class="col-sm-3" id="left-bar">
			<table id="list">
				<tbody>
			    <tr>
			        <td id="teachers-reg-button" >Teachers Registrations</td>
			    </tr>
			    <tr>
			        <td id="course-reg-button" >Course Registrations</td>
			    </tr>
			    <tr>
			        <td id="add-course-button" >Add/Delete Courses</td>
			    </tr>
			    <tr>
			        <td id="time-table-button" >Time Table</td>
			    </tr><tr>
			        <td id="calendar-input-button" >Calendar</td>
			    </tr>
				</tbody>
			</table>			
			</div>		<!--Left Side bar sm-3 -->
			<div class="col-sm-9" id="right-bar">
			<div id="teacher-reg">
	<?php 
		if(isset($_POST[approve])){
		$id=$_POST[faculty_id];

		$sql = "update  FACULTY set accepted=1 where faculty_id='$id' ";
		if($result=mysqli_query($conn,$sql))
		echo "Faculty reg success<br>";
		else
		echo "faculty reg error<br>";
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#teacher-reg').show();
	    			$('#course-reg').hide();
				$('#time-table').hide();
				$('#calendar-input').hide();
				$('#add-course').hide();
			});
			</script>";
		}
		if(isset($_POST[reject])){
		$id=$_POST[faculty_id];

		$sql = "delete from   FACULTY  where faculty_id='$id' ";
		if($result=mysqli_query($conn,$sql))
		echo "Faculty Request successfully Rejected<br>";
		else
		echo "Rejection not successful<br>";
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#teacher-reg').show();
	    			$('#course-reg').hide();
				$('#time-table').hide();
				$('#calendar-input').hide();
				$('#add-course').hide();
			});
			</script>";
		}

		$sql = "SELECT * FROM FACULTY WHERE accepted=0";
		$result=mysqli_query($conn,$sql);
		echo "<table id ='approve'>"; 
		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)){
			echo 	"<div id='faculty' class='form-style-10'> <tr> <td>" . $row[faculty_id] . "</td><td>" . $row[name] .
				"</td><td>" . $row[dept_id] . "</td><td>" . $row[phone] . "</td><td>" . $row[email] .
				"</td><td>" . $row[dob] . "</td><td> <form method='post' ><input type='text' name='faculty_id' value=" . 
				$row[faculty_id] . ' hidden> <input type="submit" class="btn"  name="approve" value="approve"></td> 
				<td><input type="submit" class="btn" name="reject" value="reject"> </form></td></tr> </div>';
			}
		}
		else{
			echo "No more new Teachers registration.";

		}
		echo "</table>";
	?>

			</div>	<!-- Teachers Registrations --><!-- Teachers Registrations -->	


			<div id="time-table">		
				<div class="form-style-10">
					<form method="post" enctype="multipart/form-data">
		    			<h1>Time Table<span>Select the File to upload</span></h1>
		    			<div class="button-section">
		    				<input type="file" name="fileToUpload" id="fileToUpload"><br> 
		    				<input type="submit" value="Upload" id="course_submit" name="uploadTimetable">
		   			</div>
					</form>
		
				</div>  <!-- Form style -->
		<?php
			if(isset($_POST['uploadTimetable'])){
			$target_dir = "uploads";
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
			echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('#teacher-reg').hide();
	    				$('#course-reg').hide();
					$('#time-table').show();
					$('#calendar-input').hide();
					$('#add-course').hide();
				});
				</script>";
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
			    } else {
				$uploadOk = 0;
				echo 'Sorry, there was an error uploading your file.';
			    }
			echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('#teacher-reg').hide();
	    				$('#course-reg').hide();
					$('#time-table').show();
					$('#add-course').hide();
					$('#calendar-input').hide();
				});
				</script>";
			}
			
			$filename = $_FILES["fileToUpload"]["name"];
			$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,year,semester) VALUES ('$user','$course_id','time-table','$filename','$target_file','2016','Monsoon')";

			if($uploadOk != 0 && mysqli_query($conn,$qry)){
			
				echo "DB update successful<br>";
			}
			else{
				echo mysqli_error();
			}
			}
			?>

		</div>  <!--time-table -->


			<div id="course-reg">
	<?php 

		if(isset($_POST[course_approve])){
		$fid=$_POST[faculty_id];
		$cid=$_POST[course_id];
		$year = date("Y");
		$month = date("m");
		if( $month >= 6 && $month < 12)
		{
			$sem=1;
			$sem_name='Monsoon';
		}
		else
		{
			$sem=2;
			$sem_name='Winter';
		}
		$sql = "update  FACULTY_COURSE set accepted=1,year=$year,curr_sem=$sem where course_id='$cid' and faculty_id='$fid' ";
			if($result=mysqli_query($conn,$sql)){
			echo "course success<br>";
			mkdir("uploads/$cid");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/reference");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/question_papers");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/course_plan");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/answer_keys");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/result");
			mkdir("uploads/$cid/$year" . "_" . "$sem_name/attendance");
			}
		else echo "course reg error<br>";
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#teacher-reg').hide();
	    			$('#course-reg').show();
				$('#time-table').hide();
				$('#calendar-input').hide();
				$('#add-course').hide();
			});
			</script>";
		}

		if(isset($_POST[course_reject])){
		$fid=$_POST[faculty_id];
		$cid=$_POST[course_id];
		$sql = "delete  from FACULTY_COURSE  where course_id='$cid' and faculty_id='$fid' ";
			if($result=mysqli_query($conn,$sql)){
			echo "course rejection success<br>";
			}
		else echo "course rejection error<br>";
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#teacher-reg').hide();
	    			$('#course-reg').show();
				$('#time-table').hide();
				$('#add-course').hide();
				$('#calendar-input').hide();
			});
			</script>";
		}

		$sql = "SELECT b.course_name,c.name,a.course_id,a.faculty_id 
			FROM FACULTY_COURSE as a,COURSE as b,FACULTY as c
			WHERE a.accepted=0 and 
			      b.course_id=a.course_id and 
			      a.faculty_id=c.faculty_id";
		$result=mysqli_query($conn,$sql);
		echo "<table id ='course'>"; 
		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)){
			echo 	"<div id='course'> <tr> <td>" . $row[name] . "</td><td> $row[course_id]  </td><td>" . $row[course_name] .
				 "</td><td><form method='post'>
				<input type='hidden' name='faculty_id' value=" . $row[faculty_id] . ' >
				<input type="hidden" name="course_id" value=' . $row[course_id] . ' >
				<input type="submit" class="btn" id="app_btn" name="course_approve" value="Approve"></td>
				<td><input type="submit" class="btn" name="course_reject" value="reject"></form></td></tr> </div>';
			}
			
		}

		else{
			echo "No new course registration";	
		}
		echo "</table>";
	?>
			</div>	<!-- Course Registrations --><!-- Course Registrations -->

		<div id="calendar-input" class="col-sm-6"> 
		<div class="form-style-10 ">
		 <h1>Calendar<span>Manually input Calendar events</span></h1>
		<form method="post">
		<script type='text/javascript'>
				$(document).ready(function(){
					$('#o_e').hide();
				});
				
		</script>
		<select name="event" id="event_admin" onchange="reveal()">
				<option value="t1_admin" selected>Test 1</option>
				<option value="t2_admin">Test 2</option>
				<option value="end_admin">End Semester Exam</option>
				<option value="cc1_admin">CC1</option>
				<option value="cc2_admin">CC2</option>
				<option value="cc3_admin">CC3</option>
				<option value="makeup_admin">Make Up Exam</option>
				<option value="endresult_admin">End Result Declaration</option>
				<option value="others">Others</option>
		</select>
		<input type="text" id="o_e" name="other_event" placeholder="Event" >
		<input type="date" name="start_date" placeholder="From Date" >
		<input type="date" name="end_date" placeholder="End Date">
		<input type='submit' name='add_event' value="Add Event">
		</form>
		</div>
		<script>
			function reveal()
				{
					if(document.getElementById('event_admin').value == 'others')
					$('#o_e').show();
					else
					$('#o_e').hide();
				}
		</script>
	
		<?php
		if(isset($_POST[add_event]))
		{
			if($_POST[event]=="others")
				$sql="INSERT INTO CALENDAR (event,start_date,end_date,id) VALUES ('$_POST[other_event]','$_POST[start_date]','$_POST[end_date]','admin')";
			else
				$sql="INSERT INTO CALENDAR (event,start_date,end_date,id) VALUES ('$_POST[event]','$_POST[start_date]','$_POST[end_date]','admin')";

			if(mysqli_query($conn,$sql))
			{
				echo "<br>Event added Successfully<br>";
			}
			else
			{
				echo "<br>Event failed to be added<br>" . mysqli_error();
			}
			echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('#teacher-reg').hide();
	    			$('#course-reg').hide();
				$('#time-table').hide();
				$('#add-course').hide();
				$('#calendar-input').show();
			});
			</script>";
		}
		?>
		</div> <!--calendar-input-->

		<div id="add-course">
			<?php
				if(isset($_POST[add_course_btn]))
			{
				$sql = "INSERT INTO COURSE (course_id,course_name,dept_id) values ('$_POST[course_id]','$_POST[course_name]','$_POST[dept]') ";
				mysqli_query($conn,$sql);
				$sql = "INSERT INTO COURSE_PO (course_id) values ('$_POST[course_id]') ";
				mysqli_query($conn,$sql);
				echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#teacher-reg').hide();
	    			$('#course-reg').hide();
				$('#time-table').hide();
				$('#add-course').show();
				$('#calendar-input').hide();
				});
				</script>";			
			}
			if(isset($_POST[delete_course]))
			{
				$sql = "DELETE FROM COURSE WHERE course_id = '$_POST[id]' ";
				mysqli_query($conn,$sql);
				echo "<script type='text/javascript'>
				$(document).ready(function(){
				$('#teacher-reg').hide();
	    			$('#course-reg').hide();
				$('#time-table').hide();
				$('#add-course').show();
				$('#calendar-input').hide();
				});
				</script>";		
			}
?>
			<div class="form-style-10 ">
				<form method="post">
					<h1>Add New Course</h1>
					<input type='text' name='course_id' placeholder="Course ID" style="width:30%"><br>
					<input type='text' name='course_name' placeholder="Course Name" style="width:50%"><br>
					<select name="dept">
						<option value='cse' selected>Computer Science and Engineering</option>
					</select><br>
					<input type="submit" value="Add Course" name='add_course_btn'>
				</form> <br><br> <h1>Available Courses</h1>
			</div>
			<?php
			
			$sql="SELECT * FROM COURSE";
			$result = mysqli_query($conn,$sql);
			echo "<table id ='selectCourses'><tr><th>Course ID</th><th>Course Name</th></tr>";
			if(mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
	 				echo "<tr><td>". $row["course_id"] . "</td><td>".$row["course_name"]."</td><td>";?>
					<form method='post' onsubmit="return confirm('Are you sure you want to delete the document?');">
					<?php echo "<input type='text' name='id' value='$row[course_id]' hidden><input type='submit' value='Delete' name='delete_course'></form></td></tr>";
				}
			}
			echo "</table>";	 	
			?>
		</div>
			</div>	<!--Right bar sm-9 -->
		</div>	<!-- row-->	
	</div>	<!-- container-fluid -->



</body>
</html>


