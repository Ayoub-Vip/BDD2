<h1>FETCH DATA</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NO" type="number" name="NO"><br>
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="NOM_DEPARTEMENT" type="text" name="NOM_DEPARTEMENT"><br>
    <input placeholder="NOM_FONCTION" type="text" name="NOM_FONCTION"><br>
    <input type="submit" name="display_EMPLOYE" class="myput" value="fetch"/>
</form>

<?PHP

if($_POST['display_EMPLOYE']){
    $NO=htmlspecialchars($_POST['NO']);  ////////////////////////////////////
    $NOM=htmlspecialchars($_POST['NOM']);
    $NOM_DEPARTEMENT=htmlspecialchars($_POST['NOM_DEPARTEMENT']);
    $NOM_FONCTION=htmlspecialchars($_POST['NOM_FONCTION']);
    $check=true;

    if($check){
        echo(strlen($NOM_DEPARTEMENT));
        $request = "SELECT * FROM EMPLOYE WHERE NOM LIKE UPPER('%$NOM%')";
        if(strlen($NOM_DEPARTEMENT) > 0){
            $request .= "AND NOM_DEPARTEMENT LIKE UPPER('%$NOM_DEPARTEMENT%')";
        }
        if(strlen($NOM_FONCTION) > 0){
            $request .= "AND NOM_FONCTION LIKE UPPER('%$NOM_FONCTION%')";
        }
        if(strlen($NO) != 0)
            $request .= " AND NO = $NO";
        $req = $bdd->query($request);


        echo '<h2>List of EMPLOYE in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td></tr> ";
        }
        echo "</table>";


    }
}
?>