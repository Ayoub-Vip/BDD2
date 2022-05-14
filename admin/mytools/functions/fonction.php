<h1>FETCH DATA</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="TAUX_HORAIRE" type="number" name="TAUX_HORAIRE"><br>
    <input type="submit" name="display_fonction" class="myput" value="fetch"/>
</form>

<?PHP

if($_POST['display_fonction']){
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $TAUX_HORAIRE=htmlspecialchars($_POST['TAUX_HORAIRE']);
    $check=true;

    if($check){
        $request = "SELECT * FROM FONCTION WHERE NOM LIKE UPPER('%$NOM%')";
        if(strlen($TAUX_HORAIRE) != 0)
            $request .= " AND TAUX_HORAIRE = $TAUX_HORAIRE";
        $req = $bdd->query($request);

        echo '<h2>List of FONCTION in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NOM</th><th>TAUX_HORAIRE</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['TAUX_HORAIRE']." </td></tr> ";
        }
        echo "</table>";


    }
}
?>

<!-- QUESTION 3 : AJOUT FONCTION -->
<br>
<hr>
<h1>ADD NEW FONCTION</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="TAUX_HORAIRE" type="number" name="TAUX_HORAIRE"><br>
    <input type="submit" name="add_Fonction" class="myput" value="Add Fonction"/>
<form>

<?PHP
    if($_POST['add_Fonction']){                  //FONCTION
        $NOM=htmlspecialchars($_POST['NOM']);
        $TAUX_HORAIRE=htmlspecialchars($_POST['TAUX_HORAIRE']);
        $check=true;
        if($check){
            if(strlen($NOM) != 0){   // -- Add fonction -- //
                if($TAUX_HORAIRE != NULL){
                    $bdd->query("INSERT INTO `FONCTION`(`NOM`, `TAUX_HORAIRE`) VALUES ('$NOM',$TAUX_HORAIRE)");
                }
            }

        }
    }
?>

