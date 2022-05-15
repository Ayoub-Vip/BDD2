<h1>Rechercher les mots-clés</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="RAPPORT" type="text" name="RAPPORT"><br>
    <input placeholder="MOTS_CLE" type="text" name="MOTS_CLE"><br>
    <input type="submit" name="display_mots_cle" class="myput" value="Rechercher"/>
</form>

<?PHP

if($_POST['display_mots_cle']){
    $RAPPORT=htmlspecialchars($_POST['RAPPORT']);
    $MOT_CLE=htmlspecialchars($_POST['MOTS_CLE']);

        $request ="SELECT * FROM MOTS_CLES WHERE UPPER(RAPPORT) LIKE UPPER('%$RAPPORT%') AND UPPER(MOT_CLE) LIKE UPPER('%$MOT_CLE%')";
        $req = $bdd->query($request);

        echo '<h2>Liste des mots-clés</h2>';
        echo "<table class=\"datatable\">
        <tr><th>RAPPORT</th><th>MOTS_CLES</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['RAPPORT']." </td><td>".$tuple['MOT_CLE']." </td></tr> ";
        }
        echo "</table>";
}
?>
