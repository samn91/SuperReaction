<?php
$name=$_POST['name'];
$cont=$_POST['country'];
$sub=$_POST['subject'];
$subject = "Name: $name Country: $cont About: $sub";
$message = $_POST['message'];
$from = $_POST['mail'];
$headers = "From:" . $from;
mail("samer@superreaction.com",$subject,$message,$headers);
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>