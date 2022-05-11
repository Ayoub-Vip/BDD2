<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="checklog.css" type="text/css">
    </head>
    <div class="wan">
        <img src="../images/us-feature-hack-icon-new.jpg" width="160" height="150" style="float:right">
<h2>you have do lot bof false in last </h2>
<h3>please wite 20 minutes</h3>
        <h6>For security , we have get your ip and some information about you </h6>
    </div>
	
</html>
<?php 
$ip=$_SERVER['REMOTE_ADDR'];
$user_argent=$_SERVER['HTTP_USER_AGENT '];
$language=$_SERVER['HTTP_ACCEPT_LANGUAGE '];
$date=gmdate("h:i:s d-m-Y");
/*
$conn=('localhost','root','root','admin');
$sql=("INSERT into         anounymous(ip,user_argent,language,date)values('$ip','$user_argent','$language','$date') ");

*/

?>