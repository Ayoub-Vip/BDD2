
<?php session_start(); ?>
<? 
if(!$_SESSION['checklog']){header("location:login.php");}
  elseif(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Manager</title>
	<link rel="stylesheet" href="tools-css/adminpage.css" type="text/css">

    <meta charset="utf-8"/>

</head>
<script type="text/javascript" src="tools-css/jQuery.js"></script>

<body>
	<div class="all">
<div class="welcome">
<h4>Welcome to the control panel ,a scpace where you manage your business.</h4>
	</div>
<table class="nevpanel">
<tr>
	<td><a href="admin_page.php?table=projet">projet</a></td>
	<td><a href="admin_page.php?table=employe" >employe</a></td>
	<td><a href="admin_page.php?table=tache" >tache</a></td>
	<td><a href="admin_page.php?table=fonction" >fonction</a></td>
	<td><a href="admin_page.php?table=rapport" >rapport</a></td>
	<td><a href="admin_page.php?table=mots_cles" >mots cles</a></td>
	<td><a href="admin_page.php?table=evaluation" >evaluation</a></td>
	<td><a href="admin_page.php?table=departement" >departement</a></td>
	<td><a href="admin_page.php?table=logout" >logout</a></td>
	</tr>	
</table>
	
	<div name="includes" class="includes" >
	
	<?php
	include_once("mytools/config.php");
	if(isset($_GET['table'])){
		
		switch ($_GET['table']) {
	case "projet":
		include_once("mytools/functions/projet.php");
		break;
	case 'employe':
		include_once("mytools/functions/employe.php");
		break;
	case 'tache';
		include_once('mytools/functions/tache.php');
		break;
   case 'fonction':
		include_once("mytools/functions/fonction.php");
		break;
	case 'rapport':
		include_once("mytools/functions/rapport.php");
		break;
	case 'mots_cles':
		include_once("mytools/functions/mots_cles.php");
		break;
	case 'evaluation':
		include_once("mytools/functions/evaluation.php");
		break;
	case 'departement':
		include_once("mytools/functions/departement.php");
		break;
	case 'logout':
		include_once("mytools/logout.php");
		break;
			default:
				include_once("mytools/functions/projet.php");
				
}
	}
	
	?>
	
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>