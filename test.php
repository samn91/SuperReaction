<script src="jquery.min.js">
</script>
<script type="text/javascript">
$(window).scroll(function() {
  var cHeight = $("#h").outerHeight(true);

	var d=document.getElementById('x');
	var dh=document.getElementById('h');
	//$('html,body').animate({scrollTop: $("#h").offset().top},'slow');
	//d.innerHTML ="asdawd";
	//d.innerHTML ="window.scrollTop:"+ $(window).scrollTop;
	
	//alert(""+$(window).scrollTop);
	 var markerPos = $('#h').offset().top;
  var winScroll = $(document).scrollTop();
  var winH      = $(window).height();

  if( winH-winScroll < markerPos){
    alert(winScroll-winH);
  } 
  
  d.innerHTML =$(window).height()+"*"+markerPos+"*"+cHeight+"*"+$(window).scrollTop();
  dh.innerHTML =$(window).height()+"*"+markerPos+"*"+cHeight+"*"+$(window).scrollTop();
   if($(window).scrollTop()+$(document).height() == $(document).height()) {
     // d.innerHTML ="window.scrollTop:"+ ($(window).scrollTop() + $(window).height());
   }
   
});
function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		//d.innerHTML ="window.scrollTop:"+ $(window).scrollTop();
   }
});
</script>
<script>
	 $(function() {
            
            $('#overlayout').hoverZoom({
                overlay: true, // false to turn off (default true)
                overlayColor: '#000', // overlay background color
                overlayOpacity: 0.7, // overlay opacity
                zoom: 50, // amount to zoom (px)
                speed: 300 // speed of the hover
            });
            
        }); 
	</script>
	<script src="jquery.min.js"></script>
	<script type="text/javascript" src="javascript.js"></script>
	<script src="hover.zoom.js"></script>
	 
	<link rel="stylesheet" href="overlayerstyle.css">
<style>
div.changeimage{
	background-image:url('banner3.gif');

}
div.changeimage:hover{
	background-image:url('banner2.gif');
	z-index:20;
	}
</style>
<script>
	 $(function() {
            
            $('#overlayout').hoverZoom({
                overlay: true, // false to turn off (default true)
                overlayColor: '#000', // overlay background color
                overlayOpacity: 0.7, // overlay opacity
                zoom: 50, // amount to zoom (px)
                speed: 300 // speed of the hover
            });
            
        }); 
</script>
<!--<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />!-->
<html>
<body onload="load()">



<a href="#" id="overlayout" class="zoom"><img src="admin/3.gif" id="imgbox" /></a>

<div class="background">
<!--<img src="cover.gif" onmouseover="mousehover(this , 'cover1.gif')" onmouseout="this.src='cover.gif'" />!-->


<div class="changeimage">
samereerrrrrrrrrrrrrr
  <li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Fou@#</li>
</div>


        <li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Fou@#</li>
        <li>Five</li>
        <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>
		 <li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Four</li>
        <li>Five</li>
        <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
	
        <li>Nine</li>
		 <li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Four</li>
        <li>Five</li>
		<h3 id="x">A</h3>
        <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>
		<li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Four</li>
        <li>Five</li>
        <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>
		  <li>One</li>
        <li>Two</li>
        <li>Three</li>
        <li>Four</li>
        <li>Five</li>
		<h3 id="h">
header
</h3>
        <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>
		 <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>
        <li>Nine</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li> <li>Six</li>
        <li>Seven</li>
        <li>Eight</li>
        <li>Nine</li>

<?php


	
	
	  $DB_Username="admin";
		$DB_Password="asdfg";
		$DB_Name="Photos";
		mysql_connect('127.0.0.1',$DB_Username,$DB_Password);
		@mysql_select_db($DB_Name) or die( "Unable to select database");
		
		
		/*
		$sql = "SELECT Id , Tags FROM data WHERE Tags IS NOT NULL AND Tags != '' ORDER BY Tags ASC;";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		$i=0;
		$tags[0]="";
		while($i<$num){
			$id=mysql_result($result,$i,"Id");
			$tag=mysql_result($result,$i,"Tags");
			$tags[$i]=$tag;
			$splittag=explode(" ", $tag);
			foreach ($splittag as $tagpart){
				$sql = "INSERT INTO Tags (Id , Tag) values ('$id' , '$tagpart');";
			mysql_query($sql);	
					
				
				}
				
			$i++;	
		}*/
		
?>



</div>
</body>
</html>