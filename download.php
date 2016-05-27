<?php
	session_start();
		if($_SESSION['email']==null)
			header('Location:admin_signin.html');
?>

<html>
<head>
<title>Hello <?php echo  $_SESSION['email'] ?></title>
<link href="CSS/mainstyle.css" rel="stylesheet" type="text/css">
<style>
form{
margin:50px;

}
p{
margin:50px;

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
	
<form action="download.php" method="post" enctype="multipart/form-data">
		<h2>Name</h2>
		<input type="text" name="Name" value="">
		<h2>URL</h2>
		<input type="text" name="URL">
		<input type="submit" name="submit" value="Submit" >
</form>
<p>
<?php			
	if(isset($_POST['URL']))
	{
		$url=htmlspecialchars(stripslashes($_POST['URL']));
		$exten=explode("/",$url);
		$name=end($exten);
		if($_POST['Name']!="")
			$name=htmlspecialchars(stripslashes($_POST['Name']));
		$path="download/" . $name;

		$exten = explode(".",$name);
		$uploaded_ext=end($exten);
		
		if($uploaded_ext=="php"||$uploaded_ext=="PHP")
			echo "Cant upload php<br>";
		
		else
		{
			copy($url, $path);
			echo "Name: " . $name . "<br>";
			echo "Url: " . $url . "<br>";
			echo "Size: " . (filesize($path) / 1024) . " kB<br>";
			echo "Stored in: " . $path . "<br>";
		}
	}
?>
</p>
</div>
</div>
</body>
</html>