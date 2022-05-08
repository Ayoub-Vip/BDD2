
<?php // session_start(); ?>
<? 
/*if(!$_SESSION['checklog']){header("location:../login.php");}
  //elseif(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
    //header("location:../login.php");
  }*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Manager</title>
	<link rel="stylesheet" href="adminpage.css" type="text/css">
	    <link rel="stylesheet" href="adminpage1.css" type="text/css">
    <meta charset="utf-8"/>

</head>
<script type="text/javascript" src="tools-css/jQuery.js"></script>
  <script>
    .$('temp').on('click',Function(){
                $(this).toggleClass('temp clicked');
//    $(getElemetbyClassname("gall")).toggleClass('gall active');
                };)
  </script>

  <script>
  	$(document).ready(function{
  		$("#search").keyup(function() {
  	  		// body...
  	  		$.ajax({
  	  			url:"functions/projet.php",
  	  			type: 'post',
  	  			data: {search: $(this).val()},
  	  			success:function(result){
  	  				$("#result").html(result);
  	  			}
  	  		});
  	  	});
  });
  </script>
<body>
	<div class="all">
<div class="welcome">
<h4>Welcome to the control panel of admin ,you can fix all statting of your   WEB SITE</h4>
	</div>
<table class="nevpanel">
<tr>
	<td><a href="admin_page.php?foc=main" target="includes">main</a></td>
	<td><a href="admin_page.php?foc=users" >users</a></td>
	<td><a href="admin_page.php?foc=ads" >ADS</a></td>
	<td><a href="admin_page.php?foc=stattings" >General statting</a></td>
	<td><a href="admin_page.php?foc=repair" >repair your tibles</a></td>
	<td><a href="admin_page.php?foc=add" >addons</a></td>
	<td><a href="admin_page.php?foc=themes" >themes</a></td>
	<td><a href="admin_page.php?foc=messages" >messages</a></td>
	<td><a href="admin_page.php?foc=support" >support blog</a></td>
	<td><a href="admin_page.php?foc=logout" >logout</a></td>
	</tr>	
</table>
	
	<div name="includes" class="includes" >
	
	<?php
	include_once("mytools/config.php");
	if(isset($_GET['foc'])){
		
		switch ($_GET['foc']) {
	case "main":
		include_once("mytools/main.php");
		break;
	case 'add':
		include_once("mytools/addons.php");
		break;
	case 'message';
		include_once('mytools/messages.php');
		break;
   case 'repair':
		include_once("mytools/repair.php");
		break;
	case 'stattings':
		include_once("mytools/stattings.php");
		break;
	case 'support':
		include_once("mytools/support.php");
		break;
	case 'themes':
		include_once("mytools/themes.php");
		break;
	case 'users':
		include_once("mytools/users.php");
		break;
			default:
				include_once("mytools/main.php");
				
}
	}
	
	?>
	
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>