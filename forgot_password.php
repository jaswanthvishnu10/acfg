<html>
<head>
<title> Change Password </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/examples1.css" />
<script src="js/jquery-2.2.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.js"></script>
</head>

 
<body class="container-fluid">
 
<nav class = " row navbar navbar-default container-fluid" role = "navigation" style="background:#2A88AD;">
   
   <div class = "navbar-header col-sm-4">
      <a class = "navbar-brand" href = "login.php" style="color:white;font-size:1.6em;margin-top:10px;">Automatic Course File Generator</a>
   </div>
   
   <div>
      <ul class = "nav navbar-nav navbar-right col-md-8">
	<!---  Some thing can be added here -->  		
      </ul>
   </div>
   
</nav>
<?php
include ("db.php");
if(isset($_POST['change_pass']))
{
	$pass=$_POST['pass']; 
	$re_pass=$_POST['re_pass']; 
	$ch_user=$_POST['ch_user'];
	$sql="update FACULTY set password='$pass' WHERE faculty_id='$ch_user'";
	if(!mysqli_query($conn,$sql))
	echo mysqli_error($conn);
	header('Location: login.php');
	exit();
}

if(isset($_POST['submit']))
{
	echo "<script>$(document).ready(function(){
	$('#chg-pwd').hide();
	});</script>";
	$user=$_POST['user']; 
	$dob=$_POST['dob']; 
	$phone=$_POST['phone']; 
	$sql="SELECT * FROM FACULTY WHERE faculty_id='$user' ";
	$result=mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) == 1) {
    		$row = mysqli_fetch_assoc($result);
         	if($row['dob']==$dob && $row['phone']==$phone){
			echo "
			<div class='form-style-10' style='margin:30px auto 0px auto; '>
			<h1> Change Password!!<span></span></h1>
			<form  method='post'>
			<input type='hidden' name='ch_user' value= '". $user ."'  hidden>
			<input type='password' placeholder='Password' name='pass' >
			<input type='password' placeholder='Re-enter Password' name='re_pass' >
			<input type='submit' value='change password' name='change_pass'>
			</form> </div>";
		}
		else
			echo "invalid Dob or phone Number";

    	}
 	else 
 		echo "Invalid User id";

}
?>


<div id="chg-pwd">
<div class="form-style-10" style="margin:30px auto 0px auto;">
<h1> Enter Credentials!!<span></span></h1>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
         <input type="text" placeholder="Username" name="user" >
         <input type="date" placeholder="date-of-birth" name="dob" >
	 <input type="tel" placeholder="phone number" name="phone" >
	 <input type="submit" value="Validate" name="submit">
</form> 
</div>
</body>
</html>

