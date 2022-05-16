
<!-- Formulaire pour rechercher une Fonction (question 1)-->
<h1>Rechercher une fonction</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="TAUX_HORAIRE" type="number" name="TAUX_HORAIRE"><br>
    <input type="submit" name="display_fonction" class="myput" value="Rechercher"/>
</form>

<!-- Affichage des fonctions en contraignants des paramètres (question 1) -->
<?PHP
if($_POST['display_fonction']){
    $NOM=htmlspecialchars($_POST['NOM']);
    $TAUX_HORAIRE=htmlspecialchars($_POST['TAUX_HORAIRE']);

        $request = "SELECT * FROM FONCTION WHERE UPPER(NOM) LIKE UPPER('%$NOM%')";
        if(strlen($TAUX_HORAIRE) != 0)
            $request .= " AND TAUX_HORAIRE = $TAUX_HORAIRE";
        $req = $bdd->query($request);

        echo '<h2>Liste des fonctions</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NOM</th><th>TAUX_HORAIRE</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['TAUX_HORAIRE']." </td></tr> ";
        }
        echo "</table>";

}
?>


<!-- Formulaire pour ajouter des fonctions (question 3) -->
<br>
<hr>
<h1>Ajouter une fonction</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM" required><br>
    <input placeholder="TAUX_HORAIRE" type="number" name="TAUX_HORAIRE" required><br>
    <input type="submit" name="add_Fonction" class="myput" value="Ajouter"/>
<form>

<!-- Ajout de la fonctions dans la base de données -->
<?PHP
    if($_POST['add_Fonction']){
        $NOM=htmlspecialchars($_POST['NOM']);
        $TAUX_HORAIRE=htmlspecialchars($_POST['TAUX_HORAIRE']);

        $query = $bdd->query("SELECT NOM FROM FONCTION WHERE NOM = '$NOM'");
        $Name = $query->fetch();
        if(!$Name["NOM"]){
             if(strlen($NOM) != 0){
                if($TAUX_HORAIRE != NULL){
                    $bdd->query("INSERT INTO `FONCTION`(`NOM`, `TAUX_HORAIRE`) VALUES ('$NOM',$TAUX_HORAIRE)");
                }
            }
        }else{
            echo("Cette fonction existe déjà");
        }
    }
?>

