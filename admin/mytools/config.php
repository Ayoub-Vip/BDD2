<?PHP
// $connect=mysqli_connect("localhost","root","root",$mydb);
try {
	$bdd = new PDO('mysql:host=localhost;dbname=group26;charset=utf8', 'root', '');
} catch (Exception $e) {
	echo "Connection to my db failled!";
	echo $e;
}


?>