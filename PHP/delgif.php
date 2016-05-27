<?php
session_start();
if($_SESSION['email']==null)
header('Location:../admin_signin.html');
?>
<?php
$DB_Username="admin";
$DB_Password="asdfg";
$DB_Name="Photos";
mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
@mysql_select_db($DB_Name) or die( "Unable to select database");

$del = $_POST['del']; 
foreach($del as $idpath)
	{

		$idpath=htmlspecialchars(mysql_real_escape_string(stripslashes($idpath)));
		$idpath=explode("!", $idpath);
		$id=$idpath[0];
		$path=$idpath[1];
		mysql_query("DELETE FROM data WHERE Id = '$id';");
		mysql_query("DELETE FROM tags WHERE Id = '$id';");
		unlink("../".$path);
		$path=explode("/", $path);
		$path="../admin/".$path[1];
		unlink($path);
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
