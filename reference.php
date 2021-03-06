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
<html>
<head>
<title> Reference </title>
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
?>
<script>
document.getElementById("reference").className+= " anotherClass";
</script>
<div id="references-list">
	<div class="form-style-10">
		<div class="col-sm-3"></div>
		<div class="col-sm-9" name="all-references">
			<div>
			<form method="post" enctype="multipart/form-data">
			<h1>References<span>Select Reference File to upload </span></h1>
			<div class="button-section">
		    		<input type="file" name="fileToUpload" id="fileToUpload"><br>
				<label>Description</label>
				<textarea name="description" rows="4" cols="70"></textarea><br>
				<input type="submit" value="Upload" id="references_submit"name="uploadReference"><br><br>
			</div>
			</form>
			</div>
			<table style="padding:10px;">
				<tr><th class="col-xs-3">Reference File</th><th class="col-xs-5">Description</th><th class="col-xs-1"></th></tr>
				<?php	
				$sql="SELECT * FROM DOCUMENTS WHERE faculty_id='$user' and course_id='$course_id' and doc_type='reference'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
?>
						<tr><form action='pdfviewer.php' method='post' onsubmit="return confirm('Are you sure you want to delete the account?');"> 
<?php echo "<td>".$row[doc_name]."</td><td>".$row[description]."</td><td><input type='submit' value ='Open Doc'><input type='hidden' name='doc_path' value='".$row[doc_path]."'></td></form>
 <form method='post' enctype='multipart/form-data'>
<td><input type='submit' value ='Remove Doc'><input type='hidden' name='doc_path_remove' value='".$row[doc_path]."'></td></tr></form>";
					}
				}
				else
				{
					echo 'No references uploaded';
				}
				?>
			</table>
		</div>
		
	</div>
		<?php

		
		if(isset($_POST['uploadReference'])){
		header("Refresh:0"); //check_here2
		$description = $_POST[description];
		$target_dir = "uploads/$course_id/$course_path/reference/";
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
			} 
		    else {
			$uploadOk = 0;
			echo "Sorry, there was an error uploading your file.";
 
		    }
		}
		$filename = $_FILES["fileToUpload"]["name"];
		$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,description,year,semester) VALUES ('$user','$course_id','reference','$filename','$target_file','$description',$year,$sem)";

		if($uploadOk!= 0 && mysqli_query($conn,$qry) ){
			echo "DB update successful<br>";
		}
		else{
			echo "DB update failed<br>";
		}
		} //uploading file end

		/*Removing file*/
		if(isset($_POST['doc_path_remove'])){
		header("Refresh:0"); //check_here1
		$target_file = $_POST["doc_path_remove"];
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
</div><!-- List of references Uploads --><!-- List of references Uploads -->
</body>
