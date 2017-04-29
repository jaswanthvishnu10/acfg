<?php
session_start();
include('db.php');
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
$ids = array();


echo "<form method='post'> ";
$sql = "select * from FEEDBACK_QUES WHERE course_id = '$course_id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{

	while($row = mysqli_fetch_assoc($result))
	{
		array_push($ids, $row[ques_id]);
	
		echo "$row[question]<br>";
		if($row[ques_type] == 0)
		{
			echo "<textarea rows=4 cols=40 name='$row[ques_id]'></textarea><br><br>";
		}
		else
		{
			echo "<select name='$row[ques_id]'>";
			for($i = $row[mini];$i <= $row[maxi]; $i++)
			{
				echo "<option value=$i>$i</option>"; 
			}
			echo "</select><br><br>";
		}
	}
echo "<input type='submit' value ='Submit Response' name= 'response'>";
} 
echo "</form>";
if(isset($_POST[response]))
{
echo "hello";

	foreach($ids as $id)
	{
	
	$sql1 = "INSERT INTO FEEDBACK_RESP (ques_id,student_id,course_id,response) VALUES ($id,'$user','$course_id','$_POST[$id]')";
	mysqli_query($conn,$sql1);
	}
}
?>
