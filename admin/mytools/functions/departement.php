 <!--  Formulaire pour rechercher un département (question 1)-->
<h1>Rechercher un département</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="BUDGET"type="number" name="BUDGET"><br>
    <input type="submit" name="display_departement" class="myput" value="Rechercher"/>
</form>

<!-- Affichage des départements en contraignant des paramètres (question 1)-->
<?PHP
if($_POST['display_departement']){
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $BUDGET=htmlspecialchars($_POST['BUDGET']);

        $request = "SELECT * FROM DEPARTEMENT WHERE UPPER(NOM) LIKE UPPER('%$NOM%')";
        if(strlen($BUDGET) != 0)
            $request .= " AND BUDGET = $BUDGET";
        $req = $bdd->query($request);

        echo '<h2>Liste des départements</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NOM</th><th>BUDGET</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['BUDGET']." </td></tr> ";
        }
        echo "</table>";
}
?>