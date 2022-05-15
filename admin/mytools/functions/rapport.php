 <!--  Formulaire pour rechercher un rapport (question 1)-->
 <h1>Rechercher un rapport</h1>
 <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="EMPLOYE" type="number" name="EMPLOYE"><br>
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="TITRE" type="TEXT" name="TITRE" title="DATE_DEBUT">
    <input type="submit" name="display_rapport" class="myput" value="Rechercher"/>
 </form>


<!-- Affichage des rapports en contraignant des paramètres (question 1)-->
<?PHP

if($_POST['display_rapport']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $TITRE=htmlspecialchars($_POST['TITRE']);

        $request = "SELECT * FROM RAPPORT WHERE UPPER(PROJET) LIKE UPPER('%$PROJET%') AND UPPER(TITRE) LIKE UPPER('%$TITRE%')";
        if(strlen($EMPLOYE) != 0)
            $request .= " AND EMPLOYE = $EMPLOYE";
        $req = $bdd->query($request);

        echo '<h2>Liste des rapports</h2>';
        echo "<table class=\"datatable\">
        <tr id=\"headtable\"><th>EMPLOYE</th><th>PROJET</th><th>TITRE</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr><td>".$tuple['EMPLOYE']." </td><td>".$tuple['PROJET']." </td><td>".$tuple['TITRE']." </td>/tr> ";
        }
        echo "</table>";
}
?>