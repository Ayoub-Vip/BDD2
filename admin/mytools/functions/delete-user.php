<?php session_start(); ?>
<h2>are you sure ,do you want to delete this user </h2>
<form action="<?php echo $PHP_SELF.'?asid='.$_SESSION['iddel'].''; ?>" method="post">
	<input type="submit" class="myinput" name="del" value="delete">
</form>
<?php
$id=$_GET['asid'];
$_SESSION['iddel']=$id;
if($_POST['del']){
	$delusr=filter_var(FILTER_SANITAZE_INT,$id);
	$mydb="admin";
	$connect=mysqli_connect("localhost",'root',"root","admin") ;
	mysqli_query($connect,"DELETE FROM user WHERE id='".$_SESSION['iddel'] ."'");
	echo "You Have DELETE This user SECCESSFUL";
}

?>