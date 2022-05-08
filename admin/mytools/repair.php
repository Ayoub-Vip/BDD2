<?php
if($_POST['sub']){
$db=new MySQLi("localhost","root","root","advphp");
if ($db->connect_errno > 0) {
	# code...
	echo "sorry we can not connect with data base";
}else{
	
	$listtables=$db->query("SHOW TABLES");
	while($rows=$listtables->fetch_array()){
		echo $rows."<br>";
	}
	if ($listtables == true) {
		# code...
		while ($reporte=$listtables->fetch_array()) {
			# code...
			$db->query("repair table $reporte[0] ");
			$db->query("optimize table $reporte[0] ");
		}
	echo "you have repair the  tables of database";
	}

exit;
}
}
?>
<h1>repair all tables in data base </h1>
<table>
<form>
	
<option>fdg</option>	
</form>

</table>