<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
    <title>WELCOME TO YOU</title>
    <link rel="stylesheet" type="text/css" href="tools-css/login.css">
    </head>
<body>
<!--	hello    -->
<?php 
if(isset($_SESSION['username']) && isset($_SESSION['password']) ){
	echo "<div class='done'> you realy login ;)</div>";
	echo "<meta http-equiv='refresh' content='2;admin_page.php' />";
}
if(isset($_SESSION['falses'])){
  if($_SESSION['falses'] <= 0){
    header('location:timout.php');
  } 
}
?>
    <div class="logform">
        <div class="blue"><h1>WELCOME  IN ADMIN PAGE</h1></div>
        <br>
    <form action="checklog.php" method="post">
        <label for="user" class="bel">username  </label><br>
    <input type="text" name="user" class="txt" /><br>
        <label for="pass" class="bel">password  </label><br>
    <input type="password" name="pass" class="txt" /><br>
    <input type="submit" name="sub_log" class="myput" value="login now"/>
    </form>
        
    </div>
</body>
</html>