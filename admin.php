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

div.addgif{
	/*padding:15px;*/
	margin: 15px;
}
div.allgif{
	margin: 15px;
}
h2{
margin-left:0;	
	
}

table{
	margin:0 0 150px 0;
	
	
}
tr.header{
text-align:center;

}
td{
margin 10px;
padding:0 10px;
border:solid 1px #CCC;
}
img.thumb{
	width:60;
	height:30;
	overflow:hidden;	
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
	<div class="addgif">
		<form action="PHP/addgif.php" method="post" enctype="multipart/form-data">
		<h2>Name</h2>
		<input type="text" name="Name">
		<h2>URL</h2>
		<input type="text" name="URL">
		<input type="file" name="file" id="file" onchange="alert(this.files[0].size/1000 + 'KB')"><br>
		<h2>Tags: Saperate tags with "," </h2>
        <input type="text" name="Tags"><br>
		<input type="submit" name="submit" value="Submit" >
		</form>
	</div>
    <?php
	
		
		
		if(isset($_GET['top']))
		{			
			$top=htmlspecialchars(mysql_real_escape_string(stripslashes(intval($_GET['top']))));
			$Id=htmlspecialchars(mysql_real_escape_string(stripslashes(intval($_GET['id']))));
			if($top==1)
				$query = "UPDATE data SET Top = 0 WHERE Id = " . $Id .";";
			else
				$query = "UPDATE data SET Top = 1 WHERE Id = " . $Id .";";
			mysql_query($query);
		}
		$sql = "SELECT count(*) FROM data where top=1;";
		$res = mysql_query($sql);
		$row = mysql_fetch_row($res);
		$top_rows = $row[0];
		
		$query = "SELECT * FROM  data ORDER BY Date DESC;";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$i=0;
	
	?>
	<div class="allgif">
    <h2>All Gif: number of record "<?php echo "$num\" and Top \"$top_rows" ?>"</h2>
	<form action="PHP/delgif.php" method="post">
	<input type="submit" value="Delete" />
	<table>
    <tr class="header">
	 <td></td>
    <td><h2>Id</h2></td>
    <td><h2>Name</h2></td>
    <td><h2>Views</h2></td>
    <td><h2>Tags</h2></td>
    <td><h2>Date</h2></td>
     <td><h2>Admin</h2></td>
    <td><h2>Image</h2></td>
	<td><h2>Top</h2></td>
    </tr>
<?php
		while($num>$i){
		$Id=mysql_result($result,$i,"Id");
		$Name=mysql_result($result,$i,"Name");
		$Views=mysql_result($result,$i,"Views");
		$Date=mysql_result($result,$i,"Date");
		$Admin=mysql_result($result,$i,"Admin");
		$path=mysql_result($result,$i,"Path");
		$top=mysql_result($result,$i,"Top");
		
		
		$newpath=explode("/",$path);
		$newpath="admin/".$newpath[1];
		
		echo "<tr>";
		echo "<td><input type='checkbox' name='del[]' value='$Id!$path'/></td>";
		echo "<td>$Id</td>";
		echo "<td>$Name</td>";
		echo "<td>$Views</td>";
		
		$sql = "SELECT Tag from tags WHERE Id = $Id;";
		$res = mysql_query($sql);
		$row = mysql_fetch_row($res);
		$num1=mysql_num_rows($res);
		$j=0;
		echo "<td>";
		while($num1>$j)
		{
			$Tag=mysql_result($res,$j,"Tag");
			if($num1==$j+1)//to store the tag without the last char "coma"
			{
				echo "$Tag";
				break;
			}
			echo "$Tag, ";
			$j++;
		}
		echo "</td>";
		
		echo "<td>$Date</td>";
		echo "<td>$Admin</td>";
		echo "<td><a href=\"index.php?id=$Id\" target=\"_blank\"><img src='$newpath' class='thumb'></td></a>";
		if($top=='1')
			echo "<td><a href='admin.php?id=$Id&top=1'>Yes</a></td>";
		else
			echo "<td><a href='admin.php?id=$Id&top=0'>No</a></td>";
		echo "</tr>";
		
		
		$i++;
	}

?>
    </form>
	
	
	</table>
	</div>
</div>
</div>
</body>
</html>