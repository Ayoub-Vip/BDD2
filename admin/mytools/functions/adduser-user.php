<?php

if($_POST['insert']){
	$name=htmlspecialchars($_POST['name']);$confname=htmlspecialchars($_POST['confname']);
	$email=htmlspecialchars($_POST['email']);$confemail=htmlspecialchars($_POST['confemail']);
	$pass=htmlspecialchars($_POST['pass']);$confpass=htmlspecialchars($_POST['confpass']);
	$bio=htmlspecialchars($_POST['bio']);$type=htmlspecialchars($_POST['type']);
	$check=true;
	if($name != $confname || empty($name)){
		echo "attention ,you have enter a defirent data in the name !";
		$check=false;
	}
	if($email != $confemail || empty($email)){
		
		echo "attention ,you have enter a defirent data in the email !";
		$check=false;
	}
	if($pass != $confpass || empty($pass)){
		echo "attention ,you have enter a defirent data in the password !<br> also the password must be biggerthan 8";
		$check=false;
	}
	if($check){

include_once("../config.php");
$bdd->query($connect,"INSERT into user(name,email,password,bio,type) VALUES('$name','$email','$pass','$bio','$type') ");
		echo '<h2>you have create a new user ,<b>good job ;D</b></h2>';
		

	}
}
?>
<!--<link rel="stylesheet" href="adduser.css"/>-->
<div class="adduser">
	<div class="myblue"><h1>add new user</h1></div>
<form action="<?php echo $PHP_SELF; ?>" method="post">
	<br><br><label for="name">name : </label>
	<input  type="text" name="name" />
	
	<label style="margin-left:180px;" for="confname">confirme name : </label>
	<input  type="text" name="confname" /><br><bR>

	<label for="email">email : </label>
	<input  type="text" name="email" />cc
	
	<label style="margin-left:180px;" for="confemail">confirme email : </label>
	<input  type="text" name="confemail" />cc
	
	<br><br><label for="pass">password : </label><br>
	<input  type="password" name="pass" />
	
	<label style="margin-left:180px;" for="confpass">confirme password : </label>
	 <input type="password" name="confpass" />
	
	<br><br><label>type : </label><br>
	<input style="margin-left:65px;" type="radio" name="type" value="big"/><label for="type">big admin : </label>
	
	<br><input style="margin-left:65px;" type="radio" name="type" value="small"/><label for="type">small admin : </label>
	
	
	<br><br><label for="bio">bio :  </label><br>
	<textarea name="bio" cols="40"  >write some thing about this user ...</textarea>
<br><br><input type="submit" class="myinput" name="insert" />
</form>
</div>	
	
	
	