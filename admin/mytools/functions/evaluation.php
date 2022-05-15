<!--  Formulaire pour rechercher une évalutaion (question 1)-->
<h1>Rechercher évaluation</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="EXPERT" type="number" name="EXPERT"><br>
    <input placeholder="COMMENTAIRES" type="text" name="COMMENTAIRES"><br>
    <input placeholder="AVIS" type="text" name="AVIS">
    <input type="submit" name="display_evaluation" class="myput" value="Rechercher"/>
</form>

<!-- Affichage des évaluations en contraignant des paramètres (question 1)-->
<?PHP
if($_POST['display_evaluation']){
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $EXPERT=htmlspecialchars($_POST['EXPERT']);
    $COMMENTAIRES=htmlspecialchars($_POST['COMMENTAIRES']);
    $AVIS=htmlspecialchars($_POST['AVIS']);

        $request = "SELECT * FROM EVALUATION WHERE UPPER(PROJET) LIKE UPPER('%$PROJET%') AND UPPER(COMMENTAIRES) LIKE UPPER('%$COMMENTAIRES%')
        AND AVIS LIKE UPPER('%$AVIS%')";
        if(strlen($EXPERT) != 0)
            $request .= " AND EXPERT = $EXPERT";
        $req = $bdd->query($request);


        echo '<h2>Liste des évaluations</h2>';
        echo "<table class=\"datatable\">
        <tr><th>PROJET</th><th>EXPERT</th><th>COMMENTAIRES</th><th>AVIS</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['PROJET']." </td><td>".$tuple['EXPERT']." </td><td>".$tuple['COMMENTAIRES']."</td><td> ".$tuple['AVIS']." </td></tr> ";
        }
        echo "</table>";
}
?>
