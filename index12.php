 <?php
		$DB_Username="superre1_admin";
		$DB_Password="CVM]laC3&im$";
		$DB_Name="superre1_database";
		mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
		@mysql_select_db($DB_Name) or die( "Unable to select database");
		$per_page=4;
		$CUR_PAGE=1;
		$sql = "SELECT count(*) FROM data;";
		$res = mysql_query($sql);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
			
		if (isset($_GET['id'])) 
		{
			$Ide = htmlspecialchars(intval($_GET['id'])); 
			$Ide = mysql_real_escape_string(stripslashes($Ide));
			$query = "SELECT * FROM  data where Id=".$Ide.";";
			$result=mysql_query($query);
			$i=0;
			$Id=mysql_result($result,$i,"Id");
			$Name=mysql_result($result,$i,"Name");
			$Path=mysql_result($result,$i,"Path");
			$Views=mysql_result($result,$i,"Views");
			$Date=mysql_result($result,$i,"Date");
		}
		else
		{
			$uri = strtok($_SERVER['REQUEST_URI'],"?")."?";    
			$tmpget = $_GET;
			unset($tmpget['p']);
			if ($tmpget) {
			  $uri .= http_build_query($tmpget)."&";
			}    
		
			$CUR_PAGE=1;
			if (isset($_GET['p'])) 
			{
				$CUR_PAGE = htmlspecialchars(intval($_GET['p'])); 
				$CUR_PAGE = mysql_real_escape_string(stripslashes($CUR_PAGE));
			}
			$start=($CUR_PAGE-1)*$per_page;
			$query = "SELECT * FROM  data ORDER BY Date DESC LIMIT $start,$per_page;";
			if (isset($_GET['view'])&&intval($_GET['view'])==1) 
			{
				$isviews=intval(htmlspecialchars($_GET['view']));
				$isviews = mysql_real_escape_string(stripslashes($isviews));
				$query = "SELECT * FROM  data ORDER BY Views DESC LIMIT $start,$per_page";
			}
			if(isset($_GET['search']))
			{
				$search=htmlspecialchars($_GET['search']);
				$search = mysql_real_escape_string(stripslashes($search));
				$query = "SELECT * FROM  data a, tags t WHERE  a.Id=t.Id and t.Tag LIKE '%".$search."%' ORDER BY Date DESC LIMIT $start,$per_page;";
				$sql = "SELECT count(*) FROM data a, tags t WHERE  a.Id=t.Id and t.Tag LIKE '%".$search."%';";
				$res = mysql_query($sql);
				$row = mysql_fetch_row($res);
				$total_rows = $row[0];
			}
			if (isset($_GET['tag'])) {
				$tag=htmlspecialchars($_GET['tag']);
				$tag = mysql_real_escape_string(stripslashes($tag));
				$query = "SELECT * FROM  data a, tags t WHERE  a.Id=t.Id and t.Tag LIKE '%".$tag."%' ORDER BY Date DESC LIMIT $start,$per_page;";
				$sql = "SELECT count(*) FROM data a, tags t WHERE  a.Id=t.Id and t.Tag LIKE '%".$tag."%';";
				$res = mysql_query($sql);
				$row = mysql_fetch_row($res);
				$total_rows = $row[0];
			}
			
		
		}
		?>
<html>
<head>
    <title>Super Reaction</title>
	<link href="CSS/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="CSS/style.css" rel="stylesheet" type="text/css">
	<link href="CSS/overlayerstyle.css" rel="stylesheet" type="text/css">
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-42921797-1', 'superreaction.com');
	  ga('send', 'pageview');

	</script>
    <script src="JS/jquery.min.js"></script>
    <script src="JS/hover.zoom.js"></script>
    <script src="JS/javascript.js" type="text/javascript"></script>
     <script>
	 	var y=<?php echo $per_page; ?>; $(function() {
			for (var x=0;x<y;x++)
			{
				$('#layout'+x).hoverZoom({
					overlay: true, // false to turn off (default true)
					overlayColor: '#000', // overlay background color
					overlayOpacity: 0.4, // overlay opacity
					zoom: 50, // amount to zoom (px)
					speed: 300 // speed of the hover
				});
			}
        }); 
		
		function runimg(){
			
			
		}
		function stopimg(){
			
			
		}
		
    </script>
<?php
	/*
		<meta property="fb:app_id" content="xxxx"/>
		<meta property="og:description" content="xxx" />
		<meta property="og:url" content="http://www.example.com/content/xxx"/>*/
		if (isset($_GET['id'])) 
		{
			echo "<meta property=\"og:site_name\" content=\"www.SuperReaction.com\"/>";
			echo "<meta property=\"og:title\" content=\"$Name\" />";
			echo "<meta property=\"og:type\" content=\"webstie\">";
			echo "<meta property=\"og:image\" content=\"www.SuperReaction.com/$Path\"/>";
			
			echo "<meta property=\"og:description\" content=\"xxx\" />";
		}
		else
		{
		/*	echo "<meta property=\"og:site_name\" content=\"www.SuperReaction.com\"/>";
			echo "<meta property=\"og:title\" content=\"Super Reaction\" />";
			echo "<meta property=\"og:type\" content=\"webstie\">";
			echo "<meta property=\"og:image\" content=\"\"/>";
			
			echo "<meta property=\"og:description\" content=\"xxx\" />";*/
		
		}
	?>
	<meta name="description" content="Wide GIF collection to help you make your point with many cool animated photos.
	use this animated photos as to reply to anyone" />
</head>
<body style="display:none;" onLoad="load()">
<div class="main">
    
    <div class="background">
	<div class="cover">
	<!--<img src="cover.gif" class="cover"/>!-->
	<h1 class="cover">Super Reaction</h1>
   </div>  
	
    
	<div class="all_menu">
		<a class="menu" href="index.php">Home</a>
		<a class="menu" href="index.php?view=1&p=1">Most Views</a>
		<a class="menu" href="Tags.php">Tags</a>
		<a class="menu" href="about.html">About Us</a>
		<div class="searchbox">
			<form action="index.php" id="searchform"> 
			<input type="submit" class="search" name="Go" value="Search"/> 
			<input type="text" name="search"  id="inputString" onkeyup="lookup(this.value);" AUTOCOMPLETE="off" />
			<div id="suggestions"></div>
			</form>
		</div>
	</div>

    
    <table align="center">
    <tr>
	<td class="left">
	<!--<br/>
	<br/>
	<br/>
	<br/>!-->
    <div class="lsidebar">
    
    <h2>Exclusive</h2>
	<?php
		$sql = "SELECT * FROM data WHERE Top = '1' ORDER BY RAND() LIMIT 0,2;";
		$res1 = mysql_query($sql);
		$num1=mysql_num_rows($res1);
		$i=0;
		while($num1>$i){
		
			$Id=mysql_result($res1,$i,"Id");
			$Name=mysql_result($res1,$i,"Name");
			$Path=mysql_result($res1,$i,"Path");
			
			echo "<div class='best'>";
				echo "<a href='index.php?id=$Id'>";
				echo "<img src='$Path' class='best'>";
				echo "</a>";
			
			$sql2 = "SELECT Tag from tags WHERE Id = ".$Id.";";
			$res2 = mysql_query($sql2);
			$num2=mysql_num_rows($res2);
			$j=0;
			while($num2>$j)
			{
				$Tag=mysql_result($res2,$j,"Tag");
				if($num2==$j+1)// when it's eqaul to last one
				{
					echo "<a href='?tag=$Tag' class='tag'>$Tag</a>";
					break;
				}
				echo "<a href='?tag=$Tag' class='tag'>$Tag</a>, ";
				$j++;
			}
			echo "</div>";
			$i++;
			}
	?>
    </div>
  	</td>
    
   <td class="center" align="center">
   
   <div class="centralbox">
	<?php	
		if($total_rows==0)
					echo "<h1>No Result</h1>";
		$result=mysql_query($query);
		$num=mysql_num_rows($result);
		$i=0;
		while($num>$i){
			$Id=mysql_result($result,$i,"Id");
			$Name=mysql_result($result,$i,"Name");
			$Path=mysql_result($result,$i,"Path");
			$Views=mysql_result($result,$i,"Views");
			$Date=mysql_result($result,$i,"Date");
			
			$Views++;
			$query = "UPDATE data SET Views = ". $Views ." WHERE Id = " . $Id .";";
			mysql_query($query);
			
			$sql = "SELECT Tag from tags WHERE Id = ". $Id .";";
			$res = mysql_query($sql);
			$row = mysql_fetch_row($res);
			$num1=mysql_num_rows($res);
			
			$Tags[0]="";
			$SpTags="";
			$j=0;
			while($num1>$j){
				$Tag=mysql_result($res,$j,"Tag");
				$Tags[$j]=$Tag;//this for list all the downbar images related bar
				if($num1==$j+1)//to store the tag without the last char "coma"
				{
					$SpTags="$SpTags<a href='?tag=$Tag' class='tag'>$Tag</a>";
					break;
				}
				$SpTags="$SpTags<a href='?tag=$Tag' class='tag'>$Tag</a>, ";
				$j++;
			}
			
			$Date=date("F, d Y", strtotime($Date));
			$asdf=explode('/',$Path);
			$adminpath="admin/".$asdf[1];
			
			echo "<div class='line'>";
				echo "<div class='box'>";
					echo '<a href="index.php?id='.$Id.'" id="layout'.$i.'" class="zoom">';
					if (!isset($_GET['id'])) 
						echo '<img src="'.$adminpath.'" class="imgbox" alt="0"/>';
					else
					{
						echo '<img src="'.$Path.'" class="imgbox" alt="1"/>';
						echo '<a class="previous" href="/v/754"></a>';
						echo '<a class="next" href="/v/754"></a>';
					}
					echo "</a>";	
					echo "<div class='info'>";
						echo $Views . "\tViews\tPosted on\t" . $Date. "<br>";
						echo "Tags: $SpTags <br>";
						echo 'Share: <input size="40" type="text" value="http://www.SuperReaction.com/index.php?id='.$Id.'" onclick="this.focus(); this.select();">';
					echo "</div>";
				echo "</div>";
			echo "</div>";
			$i++;
		}
	?>
	 
	<?php 
    if (!isset($_GET['id'])) 
	{
		echo "<div class=\"all_number\">";
//now we're getting total pages number and fill an array of links
		if($total_rows!=0){
		$k=$CUR_PAGE-2;
		if($k<=1)//number 3 or less
			$k=1;
		else{
			echo "<a class=\"page_number\" href=\"index.php\" ><<</a>";
			echo "....";
		}
			$j=0;
			$num_pages=ceil($total_rows/$per_page);
			for($i=$k;$i<=$num_pages;$i++)
			{
				if($j++==5)
				{
					echo "....";
					break;
				}
				$link=$uri.'p='.$i;
				if($CUR_PAGE==$i)
					{
						echo "<a class=\"page_number\" style=\"color: #00a000; font-size:30px; font-weight:bold;\"  href=\"$link\" >". $i ."</a>";
						continue;
					}				
				echo "<a class=\"page_number\" href=\"$link\" >". $i ."</a>";
			}
			echo "<a class=\"page_number\" href=\"index.php?p=$num_pages\" > >> </a>";
		}
		echo "</div>";
	}
	else
	{
	
		echo "<div class=\"downbar\">";	
		$sql = "select max(Id) from data where Id < ".($Ide).";";	
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);	
		$row = mysql_fetch_row($result);
		$Id = $row[0];		
		if($Id==""){
			$sql = "select max(Id) from data;";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);	
			$row = mysql_fetch_row($result);
			$Id = $row[0];
		}
		//echo "<a href='index.php?id=$Id'><input type='button'  value='Previous'/></a>";	
		echo "<a href='index.php?id=$Id'> <img src='Icon/perv.jpg'  class=\"downbar\"/></a>";
		
		$sql = "SELECT * FROM data d, tags t WHERE t.Id=d.Id AND d.Id!=$Ide AND ("; 
		$kf=0;
		foreach($Tags as $Tag){
			if($kf++==0)
				$sql .=" t.Tag like '%$Tag%'" ;
			else
				$sql .=" or t.Tag like '%$Tag%'" ;
		}
		$sql .=") GROUP BY t.Id ORDER BY RAND() LIMIT 0,4;";
		$res1 = mysql_query($sql);
		$num1 = mysql_num_rows($res1);
		$i=0;
		while($num1>$i){
			$Id=mysql_result($res1,$i,"Id");
			$Path=mysql_result($res1,$i,"Path");
			$Path=explode('/',$Path);
			$adminpath="admin/".$Path[1];
			
			echo '<a href="index.php?id='.$Id.'" >';
				echo '<img src="'.$adminpath.'" class="downbar" />';
			echo "</a>";	
			$i++;
		}
		
       // echo "<td><center><iframe src='//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fphoto.php%3Ffbid%3D3036357285348%26set%3Da.2004216802481.54934.1755474906%26type%3D1%26theater&amp;width=450&amp;height=80&amp;colorscheme=light&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;send=true' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:450px; height:80px;' allowTransparency='true'></iframe></center></td>";

	   $sql = "select min(Id) from data where Id > ".($Ide).";";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);	
		$row = mysql_fetch_row($result);
		$Id = $row[0];		
		if($Id==""){
			$sql = "select min(Id) from data;";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);	
			$row = mysql_fetch_row($result);
			$Id = $row[0];
		}
		//echo "<a href='index.php?id=$Id'><input type='button'  value='Next'/></a>";	
		echo "<a href='index.php?id=$Id'><img src='Icon/next.jpg'  class='downbar'/></a>";
		
		echo "</div>";	
	}
?>
    
    
    </div>
   </td>
  
   <td class="right"> 
   <!--<br/>
   <br/>
   <br/>
   <br/>!-->
   <div class="rsidebar">   
   <div class="tags">
   <h1>Tags</h1>
	<?php
		$sql = "SELECT Tag FROM tags WHERE Tag IS NOT NULL AND Tag != '' ORDER BY RAND() LIMIT 0,50;";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		$i=0;
		$alltags[0]="";
		while($i<$num){
			$tag=mysql_result($result,$i,"Tag");
			if(!in_array($tag,$alltags)){
					$alltags[$i]=$tag;
					echo "<a href=\"?tag=$tag\" class=\"tag\" >". $tag ."</a>,\t";
					}
			$i++;
		}
   ?>
  
   </div>
   </div>
   </td>
   </tr>
   
   
	
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