<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');

try{
$sql="SELECT b.name FROM FACULTY as b WHERE b.faculty_id='$user'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
$row = mysqli_fetch_assoc($result);
$name= 'temp.pdf';
}
include('template_generator.php');
include('filegenerator.php');

$filename='ACFG.pdf';
$path="uploads/$course_id/$course_path/$filename";
echo "<body><object data=". $path . ' type="application/pdf" width="100%" height="100%"><p>Sorry Document Not Available</p></object></body>';


$qry_main = "Select * from DOCUMENTS where doc_path = '" . $path . "' ";
$result = mysqli_query($conn,$qry_main);

if(mysqli_num_rows($result) == 0){

$qry="INSERT INTO DOCUMENTS (faculty_id,course_id,doc_type,doc_name,doc_path,year,semester) VALUES ('$user','$course_id','ACFG','$filename','$path',$rowx[year],$rowx[curr_sem])";

 mysqli_query($conn,$qry);
}
}

catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

?>
