<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tags</title>

<link href="CSS/mainstyle.css" rel="stylesheet" type="text/css">
<link href="CSS/tags_style.css" rel="stylesheet" type="text/css">

<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-42921797-1', 'superreaction.com');
	  ga('send', 'pageview');

</script>
</head>
<body>


<?php
  		$DB_Username="admin";
		$DB_Password="asdfg";
		$DB_Name="Photos";
		mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
		@mysql_select_db($DB_Name) or die( "Unable to select database");
?>

<div class="main">


    
    <div class="background">
	<div class="cover">
   </div>  
	
    
	<div class="all_menu">
	<a class="menu" href="index.php">Home</a>
	<a class="menu" href="index.php?view=1&p=1">Most Views</a>
    <a class="menu" href="Tags.php">Tags</a>
	<a class="menu" href="about.html">About Us</a>
	</div>
	
	<a href='#'><div class='top'></div></a>
	
<h1>All Tags</h1>
    <table>
     <?php
	 	$alphas = range('A', 'Z');
		echo "<h2 class='jump'>";
		foreach($alphas as $alph)
			echo "<a href='#$alph' class='jump'>$alph</a>";
		echo "</h2>";
		foreach($alphas as $alph){
		$sql = "SELECT * FROM tags WHERE Tag like '$alph%' AND Tag IS NOT NULL AND Tag != '' ORDER BY Tag ASC;";
		//$sql = "SELECT * FROM Tags WHERE Tag IS NOT NULL AND Tag != '' ORDER BY Tag ASC;";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		if($num!=0)
			echo "<tr><td class='alphheader' id='$alph'><h2>$alph</h2></td></tr>";
		$i=0;
		$j=0;//you cant use the same counter of sql because there some row are duplicated
		$tags[0]="";
		while($i<$num)
		{	
			$tag=mysql_result($result,$i,"Tag");
			if(!in_array($tag,$tags))
			{
				if($j%8==0 && $j!=0)
					echo "</tr>";
				$tags[$j]=$tag;
				if($j%8==0)
					echo "<tr>";
				echo "<td><a href=\"index.php?tag=$tag\" class=\"tag\" >". $tag ."</a></td>";
				$j++;
			}
			$i++;
		}
		echo "</tr>";
		}
   ?>
    </table>
   <div class="all_down_menu">
	<a class="down_menu" href="index.php">Home</a>
	<a class="down_menu" href="index.php?view=1&p=1">Most Views</a>
    <a class="down_menu" href="Tags.php">Tags</a>
	<a class="down_menu" href="about.html">About Us</a>
  </div>
    </div>
     
</div>

</body>
</html>