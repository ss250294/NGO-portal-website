<?php
include 'connect.php';
session_start();    
//this file contains the code which helps in sending email to a given email address

//various details about Ngo, Donor and the Event are fetched
$type=$_SESSION['SESS_TYPE'];
$pid=$_SESSION['SESS_MEMBER_ID'];
$ngopid = $_POST['ngoPid'];
$details = $_POST['details'];
$subject = $_POST['sub'];
$donorpid = $_POST['donorPid'];
$attachment = $_FILES['attachments']['name'];

	$randomName = substr(sha1(rand()), 0, 10);
	$filePath = "img/files/_".$randomName."_".$_FILES["attachments"]["name"];
	if(!move_uploaded_file($_FILES["attachments"]["tmp_name"],$filePath))
	{
		echo "not moved";
		
	}
	
	
	$query = "SELECT * FROM Ngo WHERE pid='$ngopid'";
	$result = mysql_query($query);
	
	if($result) {
        if(mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {	
				$ngoName = $row['name'];
				$ngoEmail = $row['email'];
				
			}
		}
	}
	
	//details of donor are fetched
	$donorquery = "SELECT * FROM Donor WHERE pid='$donorpid'";
	$donorresult = mysql_query($donorquery);
	
	if($donorresult) {
        if(mysql_num_rows($donorresult) > 0) {
			while ($member = mysql_fetch_assoc($donorresult)) {	
				$donorName = $member['name'];
				$donorEmail = $member['email'];
			}
		}
	}
	
	require_once("class.phpmailer.php");
	require_once("class.smtp.php");
	global $error;
	$current_email=$donorEmail;  //email address to which event acknowledgement has to be sent
	
	$username = "sampark.ngo2014@gmail.com";   //developers email address
	$password = "sampark123!";    //developers email's password
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->host = 'http://119.9.73.226/'; 
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = $username;
	$mail->Password = $password;
	$mail->Priority = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = '8bit';
	$mail->IsHTML(true);
	$mail->ContentType = 'text/html; charset=utf-8\r\n';
	$mail->SetFrom('np@demo.net', ' NGOportalwebsite.com ');
	$mail->Subject = 'Event Acknowledged ';
	$mail->Body = '<br/>Your event has been acknowledged by the NGO to whom you had contacted through our website.';
	$mail->Body .= '<br/>The following are the details of NGO and Event';
	$mail->Body .= '<br/>NGO Name : '.$ngoName ; 
	$mail->Body .= '<br/>NGO Email : '.$ngoEmail ;
	$mail->Body .= '<br/>Subject : '.$subject ;
	$mail->Body .= '<br/>Details : '.$details ;
	$mail->Body .= '<br/>Now you can rate this NGO on our website.';	
	$mail->AddAddress($current_email);
	$mail->IsHTML(true);
	$mail->WordWrap    = 900; 
	if (!$mail->Send()) {
		$sent = false;
	} 
	else 
	{
		$sent = true;
		$mail->SmtpClose();
		echo $error;
	}

	//acknowledgement details are stored in database
	$insertQuery = "INSERT INTO Acknowledge(donor_pid,ngo_pid,subject,details,attachment,estatus) values('$donorpid','$ngopid','$subject','$details','$filePath','$sent')";
	$result = mysql_query($insertQuery);
	
	//updates the event as acknowledged
	$updateQuery = "UPDATE Event SET acknowledged='1' WHERE donor_pid='$donorpid' AND ngo_pid='$ngopid' ";
	echo $updateQuery;
	$resultQuery = mysql_query($updateQuery);
	/header("refresh:0.001;url=".$_SESSION['LINK_NGOHOME']."?id=".$ngopid);


	return sent;
?>