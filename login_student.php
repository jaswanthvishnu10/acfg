<?php
session_start();

?>

<html>

<head>
 <script src="js/jquery-2.2.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
</head>

<body class="container-fluid">
<?php 
include ("db.php");

	if(isset($_POST[submit]))
	{
		$_SESSION[course_id] = $_POST[course];
		$_SESSION[user]= $_POST[user];		
		$user=$_POST[user]; 
		$pass=$_POST[pass];
		$course = $_POST[course];
		$sql="SELECT * FROM STU_FEEDBACK WHERE student_id='$user' and password='$pass' and course_id ='$course'";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count==1)
		{
			
			$sql_sub="DELETE * FROM STU_FEEDBACK WHERE student_id='$user' and password='$pass' and course_id='$course'";
			$result_sub=mysqli_query($conn,$sql_sub);
			header("Location: feedback_student.php");
			exit();
		}
		else{
	
			$sql="SELECT * FROM FACULTY WHERE faculty_id='$user' and password='$pass' and accepted=1";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if ($count==1) {
				$_SESSION[user] = $user;
			    	header("Location: login_student.php");
	    			exit();
			}
	 		else{
	    			echo("<script type='text/javascript'> alert('Invalid Username/Password'); </script>");
			}
		}
	}
?>
<nav class = " row navbar navbar-default container-fluid" role = "navigation" style="background:#2A88AD;">
   
   <div class = "navbar-header col-sm-4">
      <a class = "navbar-brand" href = "login.php" style="color:white;font-size:1.6em;margin-top:10px;">Automatic Course File Generator</a>
   </div>
   
   <div>
      <ul class = "nav navbar-nav navbar-right col-md-8">
	<form  action="<?php echo htmlentities($_SERVER[PHP_SELF]);?>" method="post" id="login_form">
	
         <input class="col-sm-3" style="margin:14px 5px 4px 5px;" type="text" placeholder="Username" name="user" required>
         <input class="col-sm-3" style="margin:14px 5px 4px 5px;" type="text" placeholder="Course" name="course" required>
	 <input class="col-sm-3" style="margin:14px 5px 4px 5px;" type="password" placeholder="Password" name="pass" required>
	 <input class="col-sm-1" style="margin:14px 5px 4px 5px;" type="submit" value="Login" name="submit" id="login_btn">
	 <div class="col-sm-1"></div>
	 <div class="col-sm-6"></div>
	 </form>  		
      </ul>
   </div>
   
</nav>
</body>

</html>
