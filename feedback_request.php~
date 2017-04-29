
<?php
session_start();
$user = $_SESSION[user];
$course_id = $_SESSION[course_id];
include('db.php');

function randomNumber($length) {
        $min = str_repeat(0, $length-1) . 1;
        $max = str_repeat(9, $length);
        return mt_rand($min, $max);   
}


require "PHPMailer/class.phpmailer.php";

define('GUSER', 'h8137899544@gmail.com'); // GMail username
define('GPWD', 'harsha559.'); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) {
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Priority = 1;
	$mail->IsHTML(true);
//	$Mail->CharSet = 'UTF-8';
 //  	$Mail->Encoding = '8bit';
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
$sql = "SELECT STUDENT.email,STUDENT.student_id FROM STUDENT JOIN STUDENT_COURSE ON STUDENT.student_id = STUDENT_COURSE.student_id WHERE STUDENT_COURSE.course_id = '$course_id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
	
	while($row = mysqli_fetch_assoc($result))
	{
		$pass = randomNumber(6);
		$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
		You are requested provide your valuable feedback on the course ($course_id). Please follow the link below to provide your feedback.
		<br>User id: " . $row[student_id] . "<br>Password: " . $pass . "</div></body></html>";
		$sql1 = "INSERT INTO STU_FEEDBACK VALUES ('$row[student_id]','$course_id','$pass')";
		mysqli_query($conn,$sql1);
		//smtpmailer($row[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Provide Feeback', $msg);
	}
}
header('Location:feedback.php');
?>

 

