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
	if(isset($_POST[register]))
	{
		$user=$_POST[reg_user]; 
		$sql="SELECT * FROM FACULTY WHERE faculty_id='$user' ";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if ($count==0) {
			$name=$_POST[name];
			$user=$_POST[reg_user];
			$password=$_POST[reg_pass];
			$department=$_POST[department];
			$dob=$_POST[dob];
			$email=$_POST[email];
			$phone=$_POST[phone];
			$qry="INSERT INTO FACULTY VALUES ('$user','$password','$name','$department','$phone','$email','$dob',0)";
			if(mysqli_query($conn,$qry))
				$msg_suc='Registration success';
			else
				$msg_suc='REgistration failed';
		}
		else{
			$msg = "user name already  exist";
		}
	}

	if(isset($_POST[submit]))
	{
		$user=$_POST[user]; 
		$pass=$_POST[pass];
		$sql="SELECT * FROM ADMIN WHERE admin_id='$user' and password='$pass'";
		$result=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($result);
		if($count==1)
		{
			header("Location: approval.php");
			exit();
		}
		else{
	
			$sql="SELECT * FROM FACULTY WHERE faculty_id='$user' and password='$pass' and accepted=1";
			$result=mysqli_query($conn,$sql);
			$count=mysqli_num_rows($result);
			if ($count==1) {
				$_SESSION[user] = $user;
			    	header("Location: faculty_home.php");
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
	 <div class="col-sm-4"></div>
         <input class="col-sm-3" style="margin:14px 5px 4px 5px;" type="text" placeholder="Username" name="user" required>
         <input class="col-sm-3" style="margin:14px 5px 4px 5px;" type="password" placeholder="Password" name="pass" required>
	 <input class="col-sm-1" style="margin:14px 5px 4px 5px;" type="submit" value="Login" name="submit" id="login_btn">
	 <div class="col-sm-1"></div>
	 <div class="col-sm-6"></div>
	 <div class="col-sm-3" style="margin-top:0px;font-size:0.9em;margin-left:23px;"><a href="forgot_password.php" style="color:white;">Forgot Password?</a></div>
	
	</form>  		
      </ul>
   </div>
   
</nav>
<div class="row">
	<div class="col-sm-6" align="center"><img src="images/nitc-logo.png" style="margin-top:40px;" width="50%" height="auto"></div>
	<div class="col-sm-6">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="form-style-10" style="margin-top:20px;">
			<h1 >Register here!</h1>
			<form id="reg_form" style="text-align:center;padding:10px;" method="post" action="<?php echo htmlentities($_SERVER[PHP_SELF]);?>">
				<div class="section">
				<?php echo $msg_suc; ?>
				<input type="text" name="name" placeholder="Name"	required>
				<input type="text" name="reg_user" placeholder="Username" required>
				<?php echo $msg; ?>
				<input type="password" name="reg_pass" id="reg_pass" placeholder="Password" required>
				<input type="password" name="check_pass" id="check_pass" placeholder="Re-enter Password" required>
				<select name="department">
				<option value="ar">Architecture</option>
				<option value="ch">Chemical Engineering</option>
				<option value="cy">Chemistry</option>
				<option value="ce">Civil Engineering</option>
				<option value="cs" selected>Computer Science & Engineering</option>
				<option value="ee">Electrical Engineering</option>
				<option value="ec">Electronics & Communication Engineering</option>
				<option value="ma">Mathematics</option>
				<option value="me">Mechanical Engineering</option>
				<option value="py">Physics</option>
			</select>
			<input type="date" name="dob" placeholder="Date of Birth(mm/dd/yyyy)">
			<input type="tel" name="phone" placeholder="Phone Number" required>
			<input type="email" name="email" placeholder="E-mail" required>
			<input type="submit" value="Register" name="register" id="reg_btn">
		</div>		
		</form>
		</div>
	</div>
</div>
</div>
<script>
$("#reg_btn").click(function () {
		
            var password = $("#reg_pass").val();
            var confirmPassword = $("#check_pass").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
</script>
</body>

</html>
