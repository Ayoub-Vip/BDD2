<?PHP

try {
	$bdd = new PDO('mysql:host=localhost;dbname=group26;charset=utf8', 'group26', 'YecEAVIQ6v');

} catch (Exception $e) {
	echo "Connection to my db failled!";
	echo $e;
}


?>