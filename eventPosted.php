<?php
include 'connect.php';
session_start();    


$type=$_SESSION['SESS_TYPE'];
$email=$_SESSION['SESS_EMAIL'];
$pid=$_SESSION['SESS_MEMBER_ID'];
$en = $_POST['eventName'];
$ed = $_POST['eventDetails'];
$el = $_POST['eventLocation'];
$sdate = $_POST['startDate'];
$edate = $_POST['endDate'];
          
              
$insertQuery = "insert into ngoPost(ngo_pid,name,detail,fromDate,toDate,location) values('$pid','$en','$ed','$sdate','$edate','$el')";
$result = mysql_query($insertQuery);
	
	if (!$result)
	{
		die('Error: ' . mysql_error());
	}
	else
	{
		session_write_close();
		header("location: ngohome.php");
		exit();
	}
?>