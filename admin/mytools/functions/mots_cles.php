<h1>FETCH DATA</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="RAPPORT" type="text" name="RAPPORT"><br>
    <input placeholder="MOTS_CLES" type="text" name="MOTS_CLES"><br>
    <input type="submit" name="display_mots_cles" class="myput" value="fetch"/>
</form>

<?PHP

if($_POST['display_mots_cles']){
    $RAPPORT=htmlspecialchars($_POST['RAPPORT']);  ////////////////////////////////////
    $MOTS_CLES=htmlspecialchars($_POST['MOTS_CLES']);
    $check=true;

    if($check){
        $request = "SELECT * FROM MOTS_CLES WHERE RAPPORT LIKE UPPER('%$RAPPORT%') AND MOTS_CLES LIKE UPPER('%$MOTS_CLES%')";
        $req = $bdd->query($request);

        echo '<h2>List of MOTS_CLES in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>RAPPORT</th><th>MOTS_CLES</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['RAPPORT']." </td><td>".$tuple['MOTS_CLES']." </td></tr> ";
        }
        echo "</table>";


    }
}
?>
