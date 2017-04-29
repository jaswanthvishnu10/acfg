<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id]; 
include('db.php');
			$sql="SELECT * FROM COURSE_CO  WHERE course_id='$course_id'";
			$result = mysqli_query($conn,$sql);
			$co_desc[10];
			$co_id[10];
			$i=0;
			if(mysqli_num_rows($result) > 0)
				{
					
					while($row = mysqli_fetch_assoc($result))
					{
						$co_id[$i] = $row[co_id];
						$co_desc[$i] = $row[co_desc];	
						$co_total[$i] = $row[total];
						$option .= "<option value='$row[co_id]'>$row[co_desc]</option>";
						$i++;						
					}

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
document.getElementById("eval-list-button").className+= " anotherClass1";
</script>

		<div class="col-sm-9"  id="right-bar">
			<div id="eval-list">
				<div class="form-style-10">
					<form method="post" enctype="multipart/form-data">
		    			<h1>Evaluation Plan<span>Select Evaluation Plan File to upload </span></h1>
					<div class="button-section">
		    				<input type="file" name="fileToUpload" id="fileToUpload"><br>
		    				<label>Description</label>
		    				<textarea name="description" rows="4" cols="70"></textarea><br>
		    				<input type="submit" value="Upload" id="references_submit" name="uploadEval"><br><br>
		    			</div>
					</form>
					
				</div> <!-- form-style-10 -->
		<?php
		if(isset($_POST['uploadEval'])){
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
			echo "Sorry, there was an error uploading your file.";
 
		    }
		}
		
		$filename = $_FILES["fileToUpload"]["name"];
		$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,description,year,semester) VALUES ('$user','$course_id','evalplan','$filename','$target_file','$description',$year,$sem)";

		if($uploadOk != 0 && mysqli_query($conn,$qry)){
			echo "DB update successful<br>";
		}
		else{
			echo "DB update failed<br>";
		}
		}
		?>
		</div> <!--eval list -->
		</div>				
	</div>
</div>



