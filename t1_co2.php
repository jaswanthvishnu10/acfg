<?php
session_start();
include('db.php');
$course_id = $_SESSION[course_id];
$k = $_SESSION[num]; 
				if(isset($_POST['submit-co']))
				{
					for($j=1;$j<=$k;$j++)
					{
						$str1 = 'co_ques';
						$str1 .= $j;
						$str2 = 'max_ques';
						$str2 .= $j;
						$sql = "INSERT INTO CO_QUES values ('$course_id',$_POST[$str1],$j,1,$_POST[$str2])";
						mysqli_query($conn,$sql);
					}				
				}
	$sql = "Select  sum(max_marks) as t1_max, co_id from CO_QUES where test = 1 and course_id = '$course_id' group by co_id"; 
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$sql1 = "UPDATE COURSE_CO set t1_max = $row[t1_max] where co_id = $row[co_id]";
		mysqli_query($conn,$sql1);
	}

header('Location:t1_co.php');
				?>
