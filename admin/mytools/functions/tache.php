 <h1>FETCH DATA</h1>
 <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="EMPLOYE" type="number" name="EMPLOYE"><br>
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="NOMBRE_HEURES"type="number" name="NOMBRE_HEURES"><br>
    <input type="submit" name="display_TACHE" class="myput" value="fetch"/>
 </form>

<?PHP

if($_POST['display_TACHE']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);  ////////////////////////////////////
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $NOMBRE_HEURES=htmlspecialchars($_POST['NOMBRE_HEURES']);
    $check=true;

    if($check){
        $request = "SELECT * FROM TACHE WHERE PROJET LIKE UPPER('%$PROJET%')";
        if(strlen($EMPLOYE) != 0)
            $request .= " AND EMPLOYE = $EMPLOYE";
        if(strlen($NOMBRE_HEURES) != 0)
            $request .= " AND NOMBRE_HEURES = $NOMBRE_HEURES";
        $req = $bdd->query($request);

        echo '<h2>List of TACHE in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>EMPLOYE</th><th>PROJET</th><th>NOMBRE_HEURES</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['EMPLOYE']." </td><td>".$tuple['PROJET']." </td><td>".$tuple['NOMBRE_HEURES']."</td></tr> ";
        }
        echo "</table>";


    }
}
?>

<h1>INSERT DATA</h1>
 <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="EMPLOYE" type="number" name="EMPLOYE"><br>
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="NOMBRE_HEURES"type="number" name="NOMBRE_HEURES"><br>
    <input type="submit" name="insert_TACHE" class="myput" value="insert"/>
 </form>

<?PHP

if($_POST['insert_TACHE']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);  ////////////////////////////////////
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $NOMBRE_HEURES=htmlspecialchars($_POST['NOMBRE_HEURES']);
    $check=true;

    if($check){
        echo("test");

        /*
        $result = mysql_query("SELECT EXISTS(SELECT NO FROM EMPLOYE WHERE NO = $EMPLOYE)");
        while($row = mysql_fetch_assoc($result)){
              echo $row['row'];
        }
        $request = "INSERT INTO `TACHE`(`EMPLOYE`, `PROJET`, `NOMBRE_HEURES`) VALUES (8105,'DIDACT',10)";
        $request = "INSERT INTO TACHE (`EMPLOYE`, `PROJET`, `NOMBRE_HEURES`) VALUES "($EMPLOYE,$PROJET,$NOMBRE_HEURES)";
        $req = $bdd->query($request); */

        echo '<h2>list of Taches in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>EMPLOYE</th><th>PROJET</th><th>NOMBRE_HEURES</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['EMPLOYE']." </td><td>".$tuple['PROJET']." </td><td>".$tuple['NOMBRE_HEURES']."</td></tr> ";
        }
        echo "</table>";
    }
}
?>

