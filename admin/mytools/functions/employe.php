<h1>Rechercher un employé</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NO" type="number" name="NO"><br>
    <input placeholder="NOM" type="text" name="NOM"><br>
    <input placeholder="NOM_DEPARTEMENT" type="text" name="NOM_DEPARTEMENT"><br>
    <input placeholder="NOM_FONCTION" type="text" name="NOM_FONCTION"><br>
    <input type="submit" name="display_EMPLOYE" class="myput" value="Rechercher"/>
</form>

<?PHP

if($_POST['display_EMPLOYE']){
    $NO=htmlspecialchars($_POST['NO']);  ////////////////////////////////////
    $NOM=htmlspecialchars($_POST['NOM']);
    $NOM_DEPARTEMENT=htmlspecialchars($_POST['NOM_DEPARTEMENT']);
    $NOM_FONCTION=htmlspecialchars($_POST['NOM_FONCTION']);
    $check=true;

    if($check){
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


        echo '<h2>Liste des employés :</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td></tr> ";
        }
        echo "</table>";


    }
}
?>


<br>
<hr>
<h1>Ajouter un employé</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="NO" type="number" name="NO" required><br>
    <input placeholder="NOM" type="text" name="NOM" required><br>
    <select name="NOM_DEPARTEMENT_SELECT">
        <option value="DEFAULT">--No Departement--</option>
        <?PHP

        $fetch_departement = $bdd->query("SELECT NOM FROM DEPARTEMENT");

        while ($row = $fetch_departement->fetch()) {

            $name = $row['NOM'];
            echo "<option value=".$name. " style='background-color :red; '>" .$name."</option>";

        }
        ?>

    </select>
    <select name="NOM_FONCTION_SELECT">
        <option value="DEFAULT">--No Fonction--</option>
            <?PHP

            $fetch_fonction = $bdd->query("SELECT NOM FROM FONCTION");

            while ($row2 = $fetch_fonction->fetch()) {

                $name2 = $row2['NOM'];
                echo "<option value=".$name2. " style='background-color : #00f034 '>" .$name2."</option>";

            }
            ?>
        <input type="submit" name="add_Employe" class="myput" value="Ajouter"/>
</form>

<?php
if($_POST['add_Employe']){
    $NOM_FONCTION_SELECT=htmlspecialchars($_POST['NOM_FONCTION_SELECT']);
    $NOM_DEPARTEMENT_SELECT=htmlspecialchars($_POST['NOM_DEPARTEMENT_SELECT']);
    $NO=htmlspecialchars($_POST['NO']);
    $NOM=htmlspecialchars($_POST['NOM']);// -- Add employe -- //
    if ($bdd->query("SELECT NO FROM EMPLOYE WHERE NO = $NO")->fetch()) {
        echo "<div class=\"wan\">Attention! cette employe existe deja dans la base de donnees</div>";
    }else{
        
    if(strlen($NOM) != 0 and $NO != NULL) {
        if ($NOM_DEPARTEMENT_SELECT == 'DEFAULT') {
            if ($NOM_FONCTION_SELECT == 'DEFAULT') {
                //PAS DEPARTEMENT ET PAS FONCTION
                $bdd->query("INSERT INTO `EMPLOYE`(`NO`, `NOM`, `NOM_DEPARTEMENT`, `NOM_FONCTION`) VALUES ($NO,'$NOM',NULL,NULL)");
            } else {
                //PAS DEPARTEMENT MAIS FONCTION
                $bdd->query("INSERT INTO `EMPLOYE`(`NO`, `NOM`, `NOM_DEPARTEMENT`, `NOM_FONCTION`) VALUES ($NO,'$NOM',NULL,'$NOM_FONCTION_SELECT')");
            }
        } else {
            if ($NOM_FONCTION_SELECT == 'DEFAULT') {
                //DEPARTEMENT MAIS PAS FONCTION
                $bdd->query("INSERT INTO `EMPLOYE`(`NO`, `NOM`, `NOM_DEPARTEMENT`, `NOM_FONCTION`) VALUES ($NO,'$NOM','$NOM_DEPARTEMENT_SELECT',NULL)");
            } else {
                //DEPARTEMENT ET FONCTION
                $bdd->query("INSERT INTO `EMPLOYE`(`NO`, `NOM`, `NOM_DEPARTEMENT`, `NOM_FONCTION`) VALUES ($NO,'$NOM','$NOM_DEPARTEMENT_SELECT','$NOM_FONCTION_SELECT')");
            }
        }
    }
    }
}

?>







<!-- QUESTION 3: COMPLETE NOT COMPLETED EMPLOYE-->
<br>
<hr>
<h1>Compléter les informations d'un employé</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <select name="EMPLOYE" required>
        <option value="">--Employé à compléter--</option>
        <?PHP
        $NOM_DEPARTEMENT=htmlspecialchars($_POST['NOM_DEPARTEMENT']);
        $NOM_FONCTION=htmlspecialchars($_POST['NOM_FONCTION']);

        $fetch_employe = $bdd->query("SELECT NOM FROM EMPLOYE WHERE NOM_DEPARTEMENT is null or NOM_FONCTION is null");

        while ($row = $fetch_employe->fetch()) {

            $name = $row['NOM'];

            echo "<option value=".$name." style='background-color : #f00000 '>".$name."</option>";

        }
        ?>
        <input type="submit" name="insert_Employe" class="myput" value="Choisir"/>
</form>

<?PHP


if($_POST['insert_Employe']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);

    $nom_dep=$bdd->query("SELECT NOM_DEPARTEMENT FROM EMPLOYE WHERE NOM ='$EMPLOYE'");
    $col = $nom_dep->fetch();
    $nom_dep_fetch = $col['NOM_DEPARTEMENT'];

    $nom_fonct=$bdd->query("SELECT NOM_FONCTION FROM EMPLOYE WHERE NOM ='$EMPLOYE'");
    $col = $nom_fonct->fetch();
    $nom_fonct_fetch = $col['NOM_FONCTION'];


    ?>
    <br>
    <hr>
    <h1>Information à compléter</h1>
    <form action="<?PHP echo $PHP_SELF; ?>" method="post">
        <?PHP
        if($nom_dep_fetch == NULL){
        ?>

            <select name="NOM_DEPARTEMENT">
                <option value="DEFAULT">--Choisir un département--</option>

                <?PHP
                $fetch_departement2 = $bdd->query("SELECT NOM FROM DEPARTEMENT");

                while ($row = $fetch_departement2->fetch()) {

                    $name = $row['NOM'];
                    echo "<option value=".$name. " style='background-color : #00f034 '>" .$name."</option>";
                }
                echo "<input type = 'hidden' name = 'EMPLOYE' value = '$EMPLOYE'/>";

        }

        if($nom_fonct_fetch == NULL){
                ?>

                <select name="NOM_FONCTION">
                    <option value="DEFAULT">--Choisir une fonction--</option>

                    <?PHP
                    $fetch_fonction2 = $bdd->query("SELECT NOM FROM FONCTION");

                    while ($row = $fetch_fonction2->fetch()) {

                        $name = $row['NOM'];
                        echo "<option value=".$name. " style='background-color : #00f034 '>" .$name."</option>";
                    }
                    echo "<input type = 'hidden' name = 'EMPLOYE' value = '$EMPLOYE'/>";

                    }

                ?>
                <input type="submit" name="modify_Employe" class="myput" value="Compléter"/>
        </form>
    <?PHP


}

if($_POST['modify_Employe']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);
    $NOM_DEPARTEMENT=htmlspecialchars($_POST['NOM_DEPARTEMENT']);
    $NOM_FONCTION=htmlspecialchars($_POST['NOM_FONCTION']);
    if($NOM_DEPARTEMENT != 'DEFAULT' ) {
        $request = "UPDATE `EMPLOYE` SET `NOM_DEPARTEMENT` = '$NOM_DEPARTEMENT' WHERE `NOM` = '$EMPLOYE'";
        $bdd->query($request);
    }
    if($NOM_FONCTION != 'DEFAULT' ) {
        $request = "UPDATE `EMPLOYE` SET `NOM_FONCTION` = '$NOM_FONCTION' WHERE `NOM` = '$EMPLOYE'";
        $bdd->query($request);
    }
}




?>


<h1>Tableau de bord</h1>
    <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <select name="COLUMN">
        <option value="NO">NO</option>
        <option value="NOM">NOM</option>
        <option value="NOM_DEPARTEMENT">NOM_DEPARTEMENT</option>
        <option value="NOM_FONCTION">NOM_FONCTION</option>
        <option value="SUM">SUM</option>
        <option value="AVG">AVG</option>
        <option value="MIN">MIN</option>
        <option value="MAX">MAX</option>
        <option value="NUMBER_OF_PROJECT">NUMBER_OF_PROJECT</option>
    </select>
    <select name="TRI">
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    <input type="submit" name="Display" class="myput" value="Trier"/>
</form>

<?PHP

    if($_POST['Display']){
        $COLUMN=htmlspecialchars($_POST['COLUMN']);
        $TRI=htmlspecialchars($_POST['TRI']);

        $request = "SELECT EMPLOYE.NO, EMPLOYE.NOM,EMPLOYE.NOM_DEPARTEMENT,EMPLOYE.NOM_FONCTION, SUM(TACHE.NOMBRE_HEURES) as SUM, MAX(TACHE.NOMBRE_HEURES) as MAX, MIN(TACHE.NOMBRE_HEURES) as MIN, AVG(TACHE.NOMBRE_HEURES) as AVG, COUNT(DISTINCT(PROJET)) as NUMBER_OF_PROJECT
                FROM EMPLOYE LEFT JOIN TACHE ON EMPLOYE.NO = TACHE.EMPLOYE
                GROUP BY EMPLOYE.NO ORDER BY `$COLUMN` $TRI";
        $req = $bdd->query($request);
        echo '<h2>Liste des employés</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th><th>SUM</th><th>AVG</th><th>MIN</th><th>MAX</th><th>NUMBER_OF_PROJECT</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td><td> ".$tuple['SUM']." </td><td> ".$tuple['AVG']." </td><td> ".$tuple['MIN']." </td><td> ".$tuple['MAX']." </td><td> ".$tuple['NUMBER_OF_PROJECT']." </td></tr> ";
        }
    }else{
        $COLUMN=htmlspecialchars($_POST['COLUMN']);
        $TRI=htmlspecialchars($_POST['TRI']);

        $request = "SELECT EMPLOYE.NO, EMPLOYE.NOM,EMPLOYE.NOM_DEPARTEMENT,EMPLOYE.NOM_FONCTION, SUM(TACHE.NOMBRE_HEURES) as SUM, MAX(TACHE.NOMBRE_HEURES) as MAX, MIN(TACHE.NOMBRE_HEURES) as MIN, AVG(TACHE.NOMBRE_HEURES) as AVG, COUNT(DISTINCT(PROJET)) as NUMBER_OF_PROJECT
                FROM EMPLOYE LEFT JOIN TACHE ON EMPLOYE.NO = TACHE.EMPLOYE
                GROUP BY EMPLOYE.NO ORDER BY `NO` ASC";
        $req = $bdd->query($request);
        echo '<h2>Liste des employés</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th><th>SUM</th><th>AVG</th><th>MIN</th><th>MAX</th><th>NUMBER_OF_PROJECT</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td><td> ".$tuple['SUM']." </td><td> ".$tuple['AVG']." </td><td> ".$tuple['MIN']." </td><td> ".$tuple['MAX']." </td><td> ".$tuple['NUMBER_OF_PROJECT']." </td></tr> ";
        }
    }
?>