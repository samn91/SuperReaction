<?php
	session_start();
	if($_SESSION['email']==null)
		header('Location:../admin_signin.html');

	if(isset($_POST['URL'])||is_uploaded_file($_FILES["file"]["tmp_name"]))
	{
		if(!file_exists('../Naming.txt')){
			$file = fopen("../Naming.txt", "w") or exit("Unable to open file!");
			fwrite($file,'0');	
			fclose($file);
		}
		$file = fopen("../Naming.txt", "r+") or exit("Unable to open file!");
		$naming= fgets($file);
		$naming++;
		fclose($file);
		$file = fopen("../Naming.txt", "w+") or exit("Unable to open file!");
		fwrite($file,$naming);
		fclose($file);
		
		$DB_Username="admin";
		$DB_Password="asdfg";
		$DB_Name="Photos";
		mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
		@mysql_select_db($DB_Name) or die( "Unable to select database");
	
	
		echo '<a href="../admin.php"><-- Index</a>'  . "<br>";
		if(is_uploaded_file($_FILES["file"]["tmp_name"]))
		{
			
			
			if ($_FILES["file"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				$temp = explode(".", $_FILES["file"]["name"]);
				$name=$naming . "." . $temp[1];
				$path="upload/" . $name;
				
				 $exten = explode(".",$name);
				 $uploaded_ext=end($exten);
				 if ($uploaded_ext == "jpg" || $uploaded_ext == "JPG" || $uploaded_ext == "jpeg" || $uploaded_ext == "JPEG" || $uploaded_ext == "gif" || $uploaded_ext == "GIF") 
				 {
					echo "Name: " . $name . "<br>";
					echo "Upload: " . $_FILES["file"]["name"] . "<br>";
					echo "Type: " . $_FILES["file"]["type"] . "<br>";
					echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					echo "Stored in: " . $path . "<br>";
					move_uploaded_file($_FILES["file"]["tmp_name"], "../".$path);				
				}
				else{
						echo "Invalid type '$uploaded_ext'<br>";
						exit();
					}
			}
		}
		else
		{
			$url=htmlspecialchars(mysql_real_escape_string(stripslashes($_POST['URL'])));
			$exten=explode(".",$url);
			$path="upload/".$naming.".".end($exten);
			
			 $uploaded_ext = end($exten);
			 if ($uploaded_ext == "jpg" || $uploaded_ext == "JPG" || $uploaded_ext == "jpeg" || $uploaded_ext == "JPEG" || $uploaded_ext == "gif" || $uploaded_ext == "GIF") 
			 {
				copy($url, "../".$path);
				
				echo "Name: " . $naming.".".end($exten) . "<br>";
				echo "Url: " . $url . "<br>";
				echo "Size: " . (filesize($path) / 1024) . " kB<br>";
				echo "Stored in: " . $path . "<br>";
			}
			else{
					echo "Invalid type '$uploaded_ext'<br>";
					exit();
				}	
		}
		
		$name=htmlspecialchars(mysql_real_escape_string(stripslashes($_POST['Name'])));
		$tag=htmlspecialchars(mysql_real_escape_string(stripslashes($_POST['Tags'])));
		$admin=$_SESSION['email'];
		
		$query ="INSERT INTO data (Id, Name, Path, Views, Date, Admin) VALUES (NULL, '".$name."', '".$path."', '0', CURRENT_TIMESTAMP, '".$admin."');";
		mysql_query($query);
		
		$sql = "SELECT max(Id) FROM data;";
		$res = mysql_query($sql);
		$row = mysql_fetch_row($res);
		$id = $row[0];
		$tags = explode(",", $tag);
		foreach($tags as $tag){
			$query ="INSERT INTO tags (Id, Tag) VALUES ('$id','$tag');";
			mysql_query($query);
		}
		mysql_close();
		$newpath=explode("/",$path);
		$newpath="../admin/".$newpath[1];
		$img = @imagecreatefromgif("../".$path);
		imagegif($img,$newpath);
		imagedestroy($img);
		echo "Url: http://www.SuperReaction.com/index.php?id=" . $id . "<br/>";
	}
?>