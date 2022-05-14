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
        $request = "SELECT * FROM EMPLOYE WHERE NOM LIKE UPPER('%$NOM%')";

        if(strlen($NOM_DEPARTEMENT) > 0){
            $request .= "AND NOM_DEPARTEMENT LIKE UPPER('%$NOM_DEPARTEMENT%')";
        }
        if(strlen($NOM_FONCTION) > 0){
            $request .= "AND NOM_FONCTION LIKE UPPER('%$NOM_FONCTION%')";
        }
        if(strlen($NO) != 0)
            $request .= " AND NO = $NO";
        echo("Here = ".$request);
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

<h1>Tableau de bord</h1>
    <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <select name="COLUMN">
        <option value="NO">NO</option>
        <option value="NOM_DEPARTEMENT">NOM_DEPARTEMENT</option>
        <option value="NOM_FONCTION">NOM_FONCTION</option>
        <option value="SUM">SUM</option>
        <option value="AVG">AVG</option>
        <option value="MIN">MIN</option>
        <option value="MAX">MAX</option>
        <option value="NUMBER_OF_PROJECT">NUMBER_OF_PROJECT</option>
    <input type="submit" name="Display" class="myput" value="fetch"/>
</form>

<?PHP
    if($_POST['Display']){
        $COLUMN=htmlspecialchars($_POST['COLUMN']);  ////////////////////////////////////
        $check=true;
        if($check){

            $request = "SELECT * FROM `EMPLOYE` ORDER BY `EMPLOYE`.`$COLUMN` ASC";
            $req = $bdd->query($request);
            echo '<h2>List of EMPLOYE in database</h2>';
            echo "<table class=\"datatable\">
            <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th><th>SUM</th><th>AVG</th><th>MIN</th><th>MAX</th><th>NUMBER_OF_PROJECT</th></tr>";
            while ($tuple = $req->fetch()) {
                echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td><td> ".$tuple['SUM']." </td><td> ".$tuple['AVG']." </td><td> ".$tuple['MIN']." </td><td> ".$tuple['MAX']." </td><td> ".$tuple['NUMBER_OF_PROJECT']." </td></tr> ";
            }
        }

    }
    else{
            $request = "ALTER TABLE EMPLOYE ADD COLUMN SUM INT AFTER NOM_FONCTION";
            $bdd->query($request);
            $request = "ALTER TABLE EMPLOYE ADD COLUMN AVG INT AFTER SUM";
            $bdd->query($request);
            $request = "ALTER TABLE EMPLOYE ADD COLUMN MIN INT AFTER AVG";
            $bdd->query($request);
            $request = "ALTER TABLE EMPLOYE ADD COLUMN MAX INT AFTER MIN";
            $bdd->query($request);

            $request = "ALTER TABLE EMPLOYE ADD COLUMN NUMBER_OF_PROJECT INT AFTER MAX";
            $bdd->query($request);

            $fetch_NO = $bdd->query("SELECT NO FROM EMPLOYE");
            while ($row = $fetch_NO->fetch()) {
               $NUM = $row['NO'];
               $request = "UPDATE EMPLOYE SET SUM = (SELECT SUM(NOMBRE_HEURES) FROM TACHE where EMPLOYE = $NUM) where NO = '$NUM'";
               $bdd->query($request);

               $request = "UPDATE EMPLOYE SET AVG = (SELECT AVG(NOMBRE_HEURES) FROM TACHE where EMPLOYE = $NUM) where NO = '$NUM'";
               $bdd->query($request);

               $request = "UPDATE EMPLOYE SET MIN = (SELECT MIN(NOMBRE_HEURES) FROM TACHE where EMPLOYE = $NUM) where NO = '$NUM'";
               $bdd->query($request);

               $request = "UPDATE EMPLOYE SET MAX = (SELECT MAX(NOMBRE_HEURES) FROM TACHE where EMPLOYE = $NUM) where NO = '$NUM'";
               $bdd->query($request);

               $request = "UPDATE EMPLOYE SET NUMBER_OF_PROJECT = (SELECT COUNT(DISTINCT(PROJET)) FROM TACHE where EMPLOYE = '$NUM') where NO = '$NUM'";
               $bdd->query($request);
            }

            $request = "SELECT * FROM EMPLOYE";
            $req = $bdd->query($request);
            echo '<h2>List of EMPLOYE in database</h2>';
            echo "<table class=\"datatable\">
            <tr><th>NO</th><th>NOM</th><th>NOM_DEPARTEMENT</th><th>NOM_FONCTION</th><th>SUM</th><th>AVG</th><th>MIN</th><th>MAX</th><th>NUMBER_OF_PROJECT</th></tr>";
            while ($tuple = $req->fetch()) {
                echo "<tr> <td>".$tuple['NO']." </td><td>".$tuple['NOM']." </td><td>".$tuple['NOM_DEPARTEMENT']."</td><td> ".$tuple['NOM_FONCTION']." </td><td> ".$tuple['SUM']." </td><td> ".$tuple['AVG']." </td><td> ".$tuple['MIN']." </td><td> ".$tuple['MAX']." </td><td> ".$tuple['NUMBER_OF_PROJECT']." </td></tr> ";
            }
            echo "</table>";
    }
?>