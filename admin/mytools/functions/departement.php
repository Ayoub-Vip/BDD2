<h1>FETCH DATA</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="BUDGET"type="number" name="BUDGET"><br>
    <input type="submit" name="display_departement" class="myput" value="fetch"/>
</form>

<?PHP

if($_POST['display_departement']){
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $check=true;

    if($check){
        $request = "SELECT * FROM DEPARTEMENT WHERE NOM LIKE UPPER('%$NOM%')";
        if(strlen($BUDGET) != 0)
            $request .= " AND BUDGET = $BUDGET";
        $req = $bdd->query($request);

        echo '<h2>List of DEPARTEMENT in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NOM</th><th>BUDGET</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['BUDGET']." </td></tr> ";
        }
        echo "</table>";


    }
}
?>