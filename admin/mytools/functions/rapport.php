 <h1>FETCH DATA</h1>
 <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="EMPLOYE" type="number" name="EMPLOYE"><br>
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="TITRE" type="TEXT" name="TITRE" title="DATE_DEBUT">
    <input type="submit" name="display_rapport" class="myput" value="fetch"/>
 </form>


<?PHP

if($_POST['display_rapport']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);  ////////////////////////////////////
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $TITRE=htmlspecialchars($_POST['TITRE']);
    $check=true;

    if($check){
        $request = "SELECT * FROM RAPPORT WHERE PROJET LIKE UPPER('%$PROJET%') AND TITRE LIKE UPPER('%$TITRE%')";
        if(strlen($EMPLOYE) != 0)
            $request .= " AND EMPLOYE = $EMPLOYE";
        $req = $bdd->query($request);

        echo '<h2>List of RAPPORT in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>EMPLOYE</th><th>PROJET</th><th>TITRE</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['EMPLOYE']." </td><td>".$tuple['PROJET']." </td><td>TITRE</td>/tr> ";
        }
        echo "</table>";


    }
}
?>