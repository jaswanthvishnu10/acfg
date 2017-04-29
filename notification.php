<?php
session_start();
include('db.php');
$sql = "SELECT * FROM CALENDAR";
$result = mysqli_query($conn,$sql);
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

 

if(mysqli_num_rows($result) > 0)
{
$now = time();

	while($row = mysqli_fetch_assoc($result))
	{
		$your_date = strtotime("$row[end_date]");
		$datediff = $now - $your_date;
		$diff = floor($datediff / (60 * 60 * 24));		
		if($diff > 0 && $diff < 7)
		{
			if($row[event] == 't1_admin')
			{
				$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				The exams are over. The exam question paper has not yet been uploaded. Please upload the question paper and key sheet.</div></body></html>";
				$sql2 = "SELECT DISTINCT email FROM FACULTY JOIN DOCUMENTS WHERE doc_type <> 't1_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}		
			}	
		

			if($row[event] == 't2_admin')
			{
				$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				The exams are over. The exam question paper has not yet been uploaded. Please upload the question paper and key sheet.</div></body></html>";
				$sql2 = "SELECT DISTINCT email FROM FACULTY JOIN DOCUMENTS WHERE doc_type <> 't2_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}		
			}	
		

			if($row[event] == 'end_admin')
			{
				$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				The exam question paper has not yet been uploaded. Please upload the question paper and key sheet.</div></body></html>";
				$sql2 = "SELECT DISTINCT email FROM FACULTY JOIN DOCUMENTS WHERE doc_type <> 't3_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}		
			}
			if($row[event] == 'makeup_admin')
			{
				/*                 */
			}	
		}
		
		if($diff > -6 && $diff < 0)
		{	
			$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				The Class Committee meeting is scheduled on " . $row[end_date] . ". Please upload the question paper, Keysheet and Marksheet of your course.</div></body></html>";	
			if($row[event] == 'cc1_admin')
			{
				$sql2 = "CREATE VIEW test1q AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t1_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				$sql3 = "CREATE VIEW test1m AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t1_markssheet'";
				$result_mail = mysqli_query($conn,$sql3);
				$sql4 = "CREATE VIEW test1k AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t1_keysheet'";
				$result_mail = mysqli_query($conn,$sql4);
				$sql5 = "CREATE VIEW all_mail AS SELECT FACULTY.email FROM FACULTY JOIN FACULTY_COURSE ON FACULTY.faculty_id = FACULTY_COURSE.faculty_id"; 
				$result_mail = mysqli_query($conn,$sql5);				
				$sql6 = "CREATE VIEW req_mail AS SELECT test1q.email FROM test1m JOIN test1q ON test1m.email = test1q.email JOIN test1k ON test1q.email = test1k.email ";			
				$result_mail = mysqli_query($conn,$sql6);
				$sql7 = " SELECT all_mail.email FROM all_mail LEFT JOIN req_mail ON all_mail.email = req_mail.email WHERE req_mail.email IS NULL";
				$result_mail = mysqli_query($conn,$sql7);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}
				$sql8 = "DROP VIEW test1q";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test1m";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test1k";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW all_mail";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW req_mail";
				mysqli_query($conn,$sql8);		
			}

			else if($row[event] == 'cc2_admin')
			{
				$sql2 = "CREATE VIEW test2q AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t2_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				$sql3 = "CREATE VIEW test2m AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t2_markssheet'";
				$result_mail = mysqli_query($conn,$sql3);
				$sql4 = "CREATE VIEW test2k AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t2_keysheet'";
				$result_mail = mysqli_query($conn,$sql4);
				$sql5 = "CREATE VIEW all_mail AS SELECT FACULTY.email FROM FACULTY JOIN FACULTY_COURSE ON FACULTY.faculty_id = FACULTY_COURSE.faculty_id"; 
				$result_mail = mysqli_query($conn,$sql5);				
				$sql6 = "CREATE VIEW req_mail AS SELECT test2q.email FROM test2m JOIN test2q ON test2m.email = test2q.email JOIN test2k ON test2q.email = test2k.email ";			
				$result_mail = mysqli_query($conn,$sql6);
				$sql7 = " SELECT all_mail.email FROM all_mail LEFT JOIN req_mail ON all_mail.email = req_mail.email WHERE req_mail.email IS NULL";
				$result_mail = mysqli_query($conn,$sql7);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}
				$sql8 = "DROP VIEW test2q";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test2m";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test2k";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW all_mail";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW req_mail";
				mysqli_query($conn,$sql8);		
			}

			
			else if($row[event] == 'cc3_admin')
			{
				$sql2 = "CREATE VIEW test3q AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t3_quespaper'";
				$result_mail = mysqli_query($conn,$sql2);
				$sql3 = "CREATE VIEW test3m AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t3_markssheet'";
				$result_mail = mysqli_query($conn,$sql3);
				$sql4 = "CREATE VIEW test3k AS SELECT FACULTY.email FROM FACULTY JOIN DOCUMENTS on FACULTY.faculty_id = DOCUMENTS.faculty_id where DOCUMENTS.doc_type='t3_keysheet'";
				$result_mail = mysqli_query($conn,$sql4);
				$sql5 = "CREATE VIEW all_mail AS SELECT FACULTY.email FROM FACULTY JOIN FACULTY_COURSE ON FACULTY.faculty_id = FACULTY_COURSE.faculty_id"; 
				$result_mail = mysqli_query($conn,$sql5);				
				$sql6 = "CREATE VIEW req_mail AS SELECT test3q.email FROM test3m JOIN test3q ON test3m.email = test3q.email JOIN test3k ON test3q.email = test3k.email ";			
				$result_mail = mysqli_query($conn,$sql6);
				$sql7 = " SELECT all_mail.email FROM all_mail LEFT JOIN req_mail ON all_mail.email = req_mail.email WHERE req_mail.email IS NULL";
				$result_mail = mysqli_query($conn,$sql7);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Update pending', $msg);
					}			
				}
				$sql8 = "DROP VIEW test3q";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test3m";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW test3k";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW all_mail";
				mysqli_query($conn,$sql8);
				$sql8 = "DROP VIEW req_mail";
				mysqli_query($conn,$sql8);		
			}

			else if($row[id] == 'admin' && ($row[event] != 't1_admin' || $row[event] != 't2_admin' || $row[event] != 'end_admin' || $row[event] != 'cc1_admin' || $row[event] != 'cc2_admin' || $row[event] != 'cc3_admin' || $row[event] != 'makeup_admin' || $row[event] != 'endresult_admin'))	
			{
				$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				You have an event " . $row[event] . " on " . $row[start_date] . ". This is a reminder about the event.</div></body></html>";
				$sql2 = "SELECT DISTINCT email FROM FACULTY";
				$result_mail = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Event Reminder', $msg);
					}			
				}
			}

			else
			{
				$msg = "<html><body style='padding:30px;background:#AAA;'><div style='width:500px;margin:30px auto;background:#FFF;padding:40px;'><center><h2>Automatic Course File<br>Generator</h2></center><br><br>Hi,<br> 
				You have an event " . $row[event] . " on " . $row[start_date] . ". This is a reminder about the event.</div></body></html>";
				$sql2 = "SELECT DISTINCT FACULTY.email FROM FACULTY JOIN CALENDAR ON CALENDAR.id = FACULTY.faculty_id";
				$result_mail = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($result_mail) > 0)
				{
					while($row_mail = mysqli_fetch_assoc($result_mail))
					{
						smtpmailer($row_mail[email], 'h8137899544@gmail.com' , 'Automatic Course file generator', 'Personal Event Reminder', $msg);
					}			
				}	
			}		
		}
    }
  }	
?>
