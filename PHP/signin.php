<?php
session_start();
$DB_Username="admin";
$DB_Password="asdfg";
$DB_Name="Photos";
$un=$_POST['userName'];
$pass=$_POST['password'];
$un=htmlspecialchars($un);
$pass=htmlspecialchars($pass);
mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
@mysql_select_db($DB_Name) or die( "Unable to select database");
//the follow statment should be after connecting to the database
$un = mysql_real_escape_string(stripslashes($un));
$pass = mysql_real_escape_string(stripslashes($pass));
$query = "SELECT * FROM sysadmin WHERE Name='$un' and Password='$pass';";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$num_results = mysql_num_rows($result);
if ($num_results <= 0)
{
	header('Location:../admin_signin.html');
	sleep(5);
	}
else
	{
		header('Location:../admin.php');
		$_SESSION['email']=$un;
	}
if($_SESSION['email']==null)
	header('Location:../admin_signin.html');
mysql_close();
?>
