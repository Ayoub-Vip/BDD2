<h1>FETCH DATA</h1>

<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input id="search" placeholder="NOM" type="text" name="NOM">
    <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT">
    <input placeholder="CHEF" type="text" name="CHEF">
    <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT">
    <input placeholder="BUDGET"type="number" name="BUDGET">
    <input placeholder="COUT" type="number" name="COUT">
    <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
    <input type="submit" name="display_PROJET" class="myput" value="fetch"/>

</form>

<?PHP

if($_POST['display_PROJET']){
    $NOM=htmlspecialchars($_POST['NOM']);
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $CHEF=htmlspecialchars($_POST['CHEF']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);
    $check=true;

    if($check){
        $request = "SELECT * FROM PROJET WHERE NOM LIKE UPPER('%$NOM%') AND DEPARTEMENT LIKE UPPER('%$DEPARTEMENT%')";
        if(strlen($CHEF) != 0)
            $request .= " AND CHEF = $CHEF";
        if(strlen($BUDGET) != 0)
            $request .= " AND BUDGET = $BUDGET";
        if(strlen($DATE_DEBUT) != 0)
            $request .= " AND DATE_DEBUT = '$DATE_DEBUT'";
        if(strlen($COUT) != 0)
            $request .= " AND COUT = $COUT";
        if(strlen($DATE_FIN) != 0)
            $request .= " AND DATE_FIN = '$DATE_FIN'";

        $req = $bdd->query($request);

        echo $request;


        echo '<h2>List of projects in database</h2>';
        echo "<table class=\"datatable\">
        <tr id=\"headtable\"><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th></tr>";
        while ($tuple = $req->fetch()) {

            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td>".$tuple['BUDGET']."</td><td> ".$tuple['COUT']." </td><td>".$tuple['DATE_FIN']."</td></tr> ";
        }
        echo "</table>";
        

    }
}
?>

<br>
<hr>
<h1>INSERT DATA</h1>

<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input id="search" placeholder="NOM" type="text" name="NOM">
    <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT">
    <input placeholder="CHEF" type="text" name="CHEF">
    <select>
        <option value="">--Please choose an exiting CHEF--</option>
        <?PHP 
        
        $fetch_chef = $bdd->query("SELECT * FROM EMPLOYE WHERE NOM_DEPARTEMENT IS NOT NULL AND NOM_FONCTION IS NOT NULL");
        while ($row = $fetch_chef->fetch()) {
            echo "<option value=\"".$row['NO']."\">".$row['NOM']."</option>";
        }

         ?>
    </select>
    <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT">
    <input placeholder="BUDGET"type="number" name="BUDGET">
    <input placeholder="COUT" type="number" name="COUT">
    <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
    <input type="submit" name="INSERT_PROJET" class="myput" value="insert"/>

</form>

<?PHP

if($_POST['INSERT_PROJET']){
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $CHEF=htmlspecialchars($_POST['CHEF']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);
    $check=true;
    

    if($check){
        $req = $bdd->query("INSERT INTO  PROJET( NOM DEPARTEMENT CHEF BUDGET DATE_DEBUT COUT DATE_FIN) VALUES  ('".$NOM."' ,'".$DEPARTEMENT."' ,'".$CHEF."' ,'".$BUDGET."' ,'".$DATE_DEBUT."' ,'".$COUT."' ,'".$DATE_FIN."') ");

        echo '<h2>list of projects in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td>".$tuple['BUDGET']."</td><td> ".$tuple['COUT']." </td><td>".$tuple['DATE_FIN']."</td></tr> ";
        }
        echo "</table>";
        

    }
}
?>

<br>
<hr>
<h1>Affichage des tâches sur un projet</h1>

<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <select name="NOM">
        <option value="">-- Afficher les tâches liées à un projet --</option>
        <?PHP

        $fetch_chef = $bdd->query("SELECT NOM FROM PROJET ");
        while ($row = $fetch_chef->fetch()) {
            echo "<option value=\"".$row['NOM']."\">".$row['NOM']."</option>";
        }

       ?>
    <input type="submit" name="DISPLAY_TASK" class="myput" value="display"/>

</form>

<?PHP

if($_POST['DISPLAY_TASK']){
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $DEPARTEMENT=htmlspecialchars($_POST['COUT_TACHE']);
    $check=true;

    if($check){
        $req = $bdd->query("SELECT EMPLOYE.NOM, (NOMBRE_HEURES * TAUX_HORAIRE) AS COUT_TACHE
                            FROM TACHE, FONCTION, EMPLOYE
                            WHERE TACHE.PROJET LIKE UPPER('$NOM') AND EMPLOYE.NO = TACHE.EMPLOYE AND EMPLOYE.NOM_FONCTION = FONCTION.NOM ");

        echo "<table class=\"datatable\"><tr><th>NOM</th><th>COUT_TACHE</th>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['COUT_TACHE']." </td></tr>";
        }
        echo "</table>";
    }
}

?>


<h1>Tableau de bord</h1>

<?PHP

            $request = "ALTER TABLE PROJET ADD COLUMN STATUT VARCHAR(30) AFTER DATE_FIN";
            $bdd->query($request);
            $request = "ALTER TABLE PROJET ADD COLUMN HEURES_PASSES INT AFTER STATUT";
            $bdd->query($request);

            $fetch_NOM = $bdd->query("SELECT NOM FROM PROJET");
            while ($row = $fetch_NOM->fetch()) {
               $NUM = $row['NOM'];

               $request = "SELECT BUDGET FROM PROJET WHERE NOM = '$NUM'";
               $result = $bdd->query($request);
               $bud = $result->fetch();
               $BUDGET = $bud['BUDGET'];

               $request = "SELECT DATE_FIN FROM PROJET WHERE NOM = '$NUM'";
               $result = $bdd->query($request);
               $dat = $result->fetch();
               $DATE_FIN = $dat['DATE_FIN'];
               if(is_null($BUDGET)){
                    $STATUT = 'en attente';
               }else{
                    if(is_null($DATE_FIN)){
                        /*
                        $fetch_employe = $bdd->query("SELECT EMPLOYE FROM TACHE WHERE PROJET ='$NUM'");
                             while ($raw = $fetch_employe->fetch()) {

                                $EMPLOYE = $raw['EMPLOYE'];

                                $request = "SELECT SUM(NOMBRE_HEURES) FROM TACHE WHERE EMPLOYE = $EMPLOYE AND PROJET = '$NUM'";

                                $result = $bdd->query($request);
                                $res = $result->fetch();

                                $NOMBRE_HEURES = $res['NOMBRE_HEURES'];
                                echo("bibi = ".$NOMBRE_HEURES);

                                $request = "SELECT NOM_FONCTION FROM EMPLOYE WHERE EMPLOYE = $EMPLOYE";
                                $result = $bdd->query($request);
                                $res = $result->fetch();
                                $NOM_FONCTION = $res['NOM_FONCTION'];

                                $SUM = $SUM + $NOMBRE_HEURES*$NOM_FONCTION;
                             }
                        "SELECT SUM(NOMBRE_HEURES) FROM TACHE WHERE EMPLOYE = $EMPLOYE AND PROJET = '$NUM' * SELECT TAUX_HORAIRE FROM FONCTION WhERE NOM = (SELECT NOM_FONCTION FROM EMPLOYE WHERE NO = 8221)";
                        $request = "UPDATE PROJET SET COUT = $SUM where NOM = '$NUM'";
                        $bdd->query($request);*/
                     $STATUT = 'en cours de route';
                     }
                     else{
                        $STATUT = 'terminé';
                     }
               };

               $request = "UPDATE PROJET SET STATUT = '$STATUT ' where NOM = '$NUM'";
               $bdd->query($request);

               $request = "UPDATE PROJET SET HEURES_PASSES = (SELECT SUM(NOMBRE_HEURES) FROM TACHE WHERE PROJET = '$NUM') where NOM = '$NUM'";
               $bdd->query($request);


            }


$request = "SELECT * FROM PROJET ORDER BY DATE_DEBUT,NOM ASC";
$req = $bdd->query($request);
echo '<h2>List of PROJET in database</h2>';
echo "<table class=\"datatable\">
<tr><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th><th>STATUT</th><th>HEURES_PASSES</th></tr>";
while ($tuple = $req->fetch()) {
          echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td> ".$tuple['BUDGET']." </td><td> ".$tuple['COUT']." </td><td> ".$tuple['DATE_FIN']." </td><td> ".$tuple['STATUT']." </td><td> ".$tuple['HEURES_PASSES']." </td></tr> ";
}
echo "</table>";
?>


