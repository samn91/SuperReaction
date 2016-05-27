<?php
session_start();
if($_SESSION['email']==null)
	header('Location:admin_signin.html');
	
$DB_Username="admin";
$DB_Password="asdfg";
$DB_Name="Photos";
mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
@mysql_select_db($DB_Name) or die( "Unable to select database");
?>
<html>
<head>
<title>Hello <?php echo  $_SESSION['email'] ?></title>
<link href="CSS/mainstyle.css" rel="stylesheet" type="text/css">
<style>
.contant{
margin:25px;


}
</style>

</head>
<body>

<div class="main">
<div class="background">
	<div class="cover">
	</div> 
	<div class="all_menu">
		<a class="menu" href="admin.php">Admin</a>
		<a class="menu" href="download.php">Download</a>
		<a class="menu" href="showsearch.php">Show Search</a>
		<a class="menu" href="index.php">Reaction Site</a>
	</div>
	
	<div class="contant">
	<p>
	<?php
		$query = "SELECT * FROM  Search;";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$i=0;
		while($num>$i++){
			$row=mysql_result($result,$i,"Name");
			echo $row ."<br/>";
		}
	
	?>
	</p>
	</div>
	</div>
	</div>

</body>
</html>