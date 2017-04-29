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
<script>
$(document).ready(function(){

	$("#courses-list").show();
	$("#eval-list").hide();
	$("#co-list1").hide();
	$("#co-list2").hide();

	$("#courses-list-button").click(function(){
	    	$("#courses-list").show();
		$("#eval-list").hide();
		$("#co-list1").hide();
		$("#co-list2").hide();
	   
	});

	$("#eval-list-button").click(function(){
	    $("#courses-list").hide();
	    $("#eval-list").show();
	    $("#co-list1").hide();
	    $("#co-list2").hide();
	});
	
	$("#co-list-button1").click(function(){
	    $("#courses-list").hide();
	    $("#eval-list").hide();
	    $("#co-list1").show();
	    $("#co-list2").hide();
	});
	
	$("#co-list-button2").click(function(){
	    $("#courses-list").hide();
	    $("#eval-list").hide();
	    $("#co-list1").hide();
	    $("#co-list2").show();
	});
});

</script>

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
document.getElementById("courses-list-button").className+= " anotherClass1";
</script>

		  <div class="col-sm-9"  id="right-bar">
			<div id="courses-list">		
				<div class="form-style-10">
					<form method="post" enctype="multipart/form-data">
		    			<h1>Course File <span>Select Course File to upload</span></h1>
		    			<div class="button-section">
		    				<input type="file" name="fileToUpload" id="fileToUpload"><br> 
		    				<label>Description</label>
		    				<textarea name="description" rows="4" cols="70"></textarea><br>
		    				<input type="submit" value="Upload" id="course_submit" name="uploadCourse">
		   			</div>
					</form>
		<div name="all-references">
			<table style="margin-top:10px;padding:10px;">
				<tr><th class="col-xs-3">Previous Course Files</th><th class="col-xs-5">Description</th><th class="col-xs-1"></th></tr>
				<?php	
$sql="SELECT * FROM DOCUMENTS WHERE course_id='$course_id' and doc_type='course'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{ 
		echo "<tr><form action='pdfviewer.php' method='post'><td>".$row[doc_name]."</td><td>".$row[description]."</td><td><input type='submit' value ='Open Doc'><input type='hidden' name='doc_path' value='".$row[doc_path]."'></td></form>";
if ($row[faculty_id] == $user){ 
?>
<form method='post' enctype='multipart/form-data' onsubmit="return confirm('Are you sure you want to delete the document?');">
<?php echo "<td><input type='submit' value ='Remove Doc'><input type='hidden' name='doc_qpaper_remove' value='".$row[doc_path]."'></td></tr></form>";}
	}
}
else
{
	echo 'No ACFG uploaded';
}
				?>
			</table>
		</div>
		
				</div>  <!-- Form style -->
			
		
			<?php
			if(isset($_POST['uploadCourse'])){
			$description = $_POST[description];
			$target_dir = "uploads/$course_id/$course_path/course_plan/";
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
			echo "<script type='text/javascript'>
					$('#courses-list').show();
					$('#eval-list').hide();
					$('#co-list1').hide();
					$('#co-list2').hide();
				</script>";
			$filename = $_FILES["fileToUpload"]["name"];
			$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,description,year,semester) VALUES ('$user','$course_id','course','$filename','$target_file','$description',$year,$sem)";

			if($uploadOk != 0 && mysqli_query($conn,$qry)){
			
				echo "DB update successful<br>";
			}
			else{
				echo mysqli_error();
			}
			}
			if(isset($_POST['doc_qpaper_remove'])){
			header("Refresh:0"); //check_here1
			$target_file = $_POST["doc_qpaper_remove"];
			$deleteOk=1;	
			// Check if file already exists
			if (!file_exists($target_file)) {
			    echo "Sorry, file already removed.<br>";
			    $deleteOk = 0;
			}
			if ($deleteOk == 0) {
			    echo "Sorry, your file was not removed.<br>";
			// if everything is ok, try to upload file
			} else {
				unlink($target_file);
				echo "file deleted from directory";
			}

			$qry="DELETE FROM DOCUMENTS WHERE doc_path = '$target_file'";
			if($deleteOk!= 0 && mysqli_query($conn,$qry) ){
				echo "DB delete_update successful<br>";
			}
			else{
				echo "DB delete_update failed<br>";
			}
			} //removing file ended
			?>
			</div>  <!-- courses-list -->
			

		<!--<div class="col-sm-9"  id="right-bar">-->

		</div>  <!-- right bar -->
	</div>	<!-- row-->	
</div>	<!-- container-fluid -->
</body>


</html>
    
