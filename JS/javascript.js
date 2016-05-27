function mousehover(img, path) {
	alert("hover");
   img.src=path;
}
function mouseleave(img, path) {
	alert("leave");
   img.src=path;
}
/*
google.load("jquery", "1.3.1");
//for AJAX
google.setOnLoadCallback(function()
{
	// Safely inject CSS3 and give the search results a shadow
	var cssObj = { 'box-shadow' : '#888 5px 10px 10px', // Added when CSS3 is standard
		'-webkit-box-shadow' : '#888 5px 10px 10px', // Safari
		'-moz-box-shadow' : '#888 5px 10px 10px'}; // Firefox 3.5+
	$("#suggestions").css(cssObj);
	
	// Fade out the suggestions box when not active
	 $("input").blur(function(){
	 	$('#suggestions').fadeOut();
	 });
});
*/
function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		$.post("PHP/rpc.php", {queryString: ""+inputString+""}, function(data) { // Do an AJAX call
			$('#suggestions').fadeIn(); // Show the suggestions box
			$('#suggestions').html(data); // Fill the suggestions box
		});
	}
}


function fill(val)
{
	document.getElementById('inputString').value=val;
	document.getElementById("searchform").submit();
	//$('#suggestions').fadeOut();
}
function load(){

$(document.body).fadeIn(1000);
/*
var top = $('#divfade').offset().top;
$("#divfade").css({top:top}).animate({"top":"50%"}, 2000);
$("#divfade").css({top:top}).animate({"top":"100%"}, 2000);
$('#divfade').fadeOut(10);
$('#main').*/
}