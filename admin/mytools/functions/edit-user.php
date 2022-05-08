<?php session_start();

$mydb="admin";
$editusr=$_GET['asid'];
include_once('../config.php');
$query=mysqli_query($connect,"SELECT * FROM user WHERE id='$editusr';");
if(!empty($editusr)){$_SESSION['id']=$editusr;}
while($row=mysqli_fetch_object($query)) {
?>
<div class="edituser">
	<div class="myblue"><h1>edit user </h1></div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?asid=".$_SESSION['id'] ; ?>">
	<br><br><label for="name">name : </label>
	<input  type="text" name="name" value="<?php echo $row->name; ?>"/>
	            <br><br>  
	
	<label for="email">email : </label>
	<input  type="text" name="email" value="<?php echo $row->email; ?>"/>
	
		<br><br><label for="pass">password : </label>
	<input  type="password" name="pass" value="<?php echo $row->password; ?>"/>
	
	<br><br><label for="confpass">confirme password : </label>
	<input  type="password" name="confpass" />
	
	<br><br><label>type : </label><br>
	<input style="margin-left:65px;" type="radio" name="type" <?php if($row->type == "big admin"){echo "checked";}?> value="big admin"/><label for="type" >big admin : </label>
	
	<br><input <?php if($row->type == "small admin"){echo "checked";}?> style="margin-left:65px;" type="radio" name="type" value="small admin"/><label for="type">small admin : </label>
	
	
	<br><br><label for="bio">bio :  </label><br>
	<textarea name="bio" cols="40"><?php echo $row->bio; ?></textarea>
<br><br><input type="submit" class="myinput" name="editusr" /> <a href="../users.php">back</a>
</form>
</div>	
<? }

if($_POST['editusr']){
	$upname=$_POST['name'];
	$upemail=$_POST['email'];
	$uppass=$_POST['pass'];
	$upconfpass=$_POST['confpass'];
	$uptype=$_POST['type'];
	$upbio=$_POST['bio'];
	$checkinfo=true;
	
	if(!empty($upconfpass)){
	if($upconfpass != $uppass){
		echo "you enter a diferent data in the password";
		$checkinfo=false;
	}
}
	
	if(empty($upname) || empty($upemail) || empty($uppass) ||  empty($upbio) ){
		echo "please don't let any input empty";
		$checkinfo=false;
	}
	if($checkinfo){
		$connect=mysqli_connect("localhost","root","root","admin");
		mysqli_query($connect,"UPDATE admin.user SET name='$upname', email='$upemail' , password='$uppass' , bio='$upbio' ,type='$uptype', ison='one' WHERE user.id=3");
		echo "DONE , You Have UPDATE The Data seccess !<br> we will referesh data ;)";
		echo "<meta http-equiv='refresh' content='2;url=".$PHP_SELF."?asid=".$_SESSION['id']."' />";
	}
}
?>




















