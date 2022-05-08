<link rel="stylesheet" href="tools-css/users.css" type="text/css">
<div class="user" dir="rtl">
	<table class="myusers" cellpadding="0" cellspacing="0">
		<?php
	$mydb="admin";include_once("config.php");
	$sql="SELECT * FROM user";
$query=mysqli_query($connect,$sql);
	echo "<tr class='tr1'> <th>ID</th> <th>name</th> <th>email</th> <th>last present</th> <th>type</th>      <th>referal</th> <th>edit</th> <th>delete</th> </tr>";
	while($row=mysqli_fetch_object($query)){
		echo "<tr>";
		echo "<td>".$row->id."</td>";
		echo "<td>".$row->name."</td>";
		echo "<td>".$row->email."</td>";
		echo "<td>".$row->last_present."</td>";
		echo "<td>".$row->type."</td>";
		echo "<td>";
		if($row->ison = "one"){echo "<img src='mytools/images/allowed.gif' width='30' height='30' title='allowed'>";}else{echo "<img src='mytools/images/lock.png' width='30' height='30' title='bloked'>";}
		echo "</td>";
		echo "<td>";
		if($row->type == "small admin"){
	?>

			<a href="mytools/functions/edit-user.php?asid=<? echo $row->id?>" class="add" title="edit this user" target="_new">edit</a>

			<?
		}else{echo "<img src='mytools/images/lock.png' width='30' height='30' title='you can not delete this admin'>";}
		echo "</td>";
		echo "<td>";		
		if($row->type == "small admin"){
		?>
<script>
		function lere(){
			var confirme('attention Do You  Want to delete This USER :');
		}
		
</script>
				<a href="mytools/functions/delete-user.php?asid=<? echo $row->id ?>" title=' delete this user ' class='delete' onclick="lere();" target="_new">delete</a>

				<?
		}else{echo "<img src='mytools/images/lock.png' width='30' height='30' title='you can not delete this admin'>";}
		
		echo "</td>";
		echo "</tr>";
		
	}

?>
	</table>
<BR>
	<a href="mytools/functions/adduser-user.php" style="margin-right: 86%;margin-top:19px" class="add" title="add a new user to help you ">add new user</a>









</div>