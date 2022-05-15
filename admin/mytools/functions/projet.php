
<!--  Formulaire pour rechercher un projet-->
<h1>Rechercher un projet</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input id="search" placeholder="NOM" type="text" name="NOM">
    <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT">
    <input placeholder="CHEF" type="text" name="CHEF">
    <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT">
    <input placeholder="BUDGET"type="number" name="BUDGET">
    <input placeholder="COUT" type="number" name="COUT">
    <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
    <input type="submit" name="display_PROJET" class="myput" value="Rechercher"/>
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

        echo '<h2>Liste des projets</h2>';
        echo "<table class=\"datatable\">
        <tr id=\"headtable\"><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th></tr>";
        while ($tuple = $req->fetch()) {

            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td>".$tuple['BUDGET']."</td><td> ".$tuple['COUT']." </td><td>".$tuple['DATE_FIN']."</td></tr> ";
        }
        echo "</table>";
}
?>


<!-- ADD PROJET  .?? ?-->
<br>
<hr>
<h1>Ajouter un projet</h1>

<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input id="search" placeholder="NOM" type="text" name="NOM" required>
    <select name="DEPARTEMENT" required>
        <option value="DEFAULT">--Choisissez un département--</option>
        <?PHP

        $fetch_departement = $bdd->query("SELECT NOM FROM DEPARTEMENT");

        while ($row = $fetch_departement->fetch()) {

            $name = $row['NOM'];
            echo "<option value=".$name. " style='background-color : #00f034 '>" .$name."</option>";

        }
        ?>
    </select>
    <select name="NO" required>
        <option value="DEFAULT">--Choisissez un chef de projet--</option>
        <?PHP

        $fetch_chef= $bdd->query("SELECT NO FROM EMPLOYE WHERE nom_departement is not null and nom_fonction is not null");

        while ($row = $fetch_chef->fetch()) {
            $NO = $row['NO'];
            echo "<option value=".$NO. " style='background-color : #00f034 '>" .$NO."</option>";
        }
        ?>
    </select>
    <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT" required>
    <input placeholder="BUDGET"type="number" name="BUDGET" required>
    <input placeholder="COUT" type="number" name="COUT">
    <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
    <input type="submit" name="INSERT_PROJET" class="myput" value="Ajouter"/>

</form>

<!-- RECUPERER LE CHEF DANS LA LISTE DEROULANTE -->


<?PHP

if($_POST['INSERT_PROJET']){
    $NO=htmlspecialchars($_POST['NO']);
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);


    if($NO != "DEFAULT" and $NOM != NULL and  $DEPARTEMENT != "DEFAULT" and  $BUDGET != NULL and $DATE_DEBUT != NULL) {
        if($DATE_FIN != NULL){
            if($COUT != NULL){
                echo 1;
                $request = "INSERT INTO `PROJET`(`NOM`, `DEPARTEMENT`, `DATE_DEBUT`, `CHEF`, `BUDGET`, `COUT`, `DATE_FIN`) VALUES ('$NOM','$DEPARTEMENT', '$DATE_DEBUT' ,'$NO', $BUDGET, $COUT, '$DATE_FIN')";
                $bdd->query($request);
                            }
                            else {
                                echo 2;
                                $request = "INSERT INTO `PROJET`(`NOM`, `DEPARTEMENT`, `DATE_DEBUT`, `CHEF`, `BUDGET`, `COUT`, `DATE_FIN`) VALUES ('$NOM','$DEPARTEMENT', '$DATE_DEBUT' ,'$NO', $BUDGET, NULL, '$DATE_FIN')";
                                $bdd->query($request);
                            }
                        }
                        else {
                            if ($COUT == NULL) {
                                echo 3;
                                $request = "INSERT INTO `PROJET`(`NOM`, `DEPARTEMENT`, `DATE_DEBUT`, `CHEF`, `BUDGET`, `COUT`, `DATE_FIN`) VALUES ('$NOM','$DEPARTEMENT', '$DATE_DEBUT' ,'$NO', $BUDGET, NULL, NULL)";
                                $bdd->query($request);
                            }
                            else{
                                echo("Erreur : Seul un projet fini peut avoir un coût.");
                            }
                        }
                    }
                    else{
                        echo("Erreur : Nom, Département, Date Début, Chef et Budget requis.");
                    }
                } ?>




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
    <input type="submit" name="DISPLAY_TASK" class="myput" value="Afficher"/>

</form>

<?PHP

if($_POST['DISPLAY_TASK']){
    $NOM=htmlspecialchars($_POST['NOM']);
    $DEPARTEMENT=htmlspecialchars($_POST['COUT_TACHE']);

        $req = $bdd->query("SELECT EMPLOYE.NOM, (NOMBRE_HEURES * TAUX_HORAIRE) AS COUT_TACHE
                            FROM TACHE, FONCTION, EMPLOYE
                            WHERE TACHE.PROJET LIKE UPPER('$NOM') AND EMPLOYE.NO = TACHE.EMPLOYE AND EMPLOYE.NOM_FONCTION = FONCTION.NOM ");

        echo "<table class=\"datatable\"><tr><th>NOM</th><th>COUT_TACHE</th>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['COUT_TACHE']." </td></tr>";
        }
        echo "</table>";
}

?>


<h1>Tableau de bord</h1>

<?PHP

$display_projet = "SELECT * FROM PROJET ORDER BY DATE_DEBUT,NOM ASC";
$reqprojet = $bdd->query($display_projet);

while ($tuple = $reqprojet->fetch()) {
    $STATUT = "";
    $HEURES_PASSES;
    $COUT_ACTUEL;

    $sommeHeures = "SELECT SUM(NOMBRE_HEURES) FROM TACHE WHERE TACHE.PROJET = ".$tuple['NOM']." ";

    $HEURES_PASSES = $bdd->query($sommeHeures);

    if($tuple['COUT']){
        $COUT_ACTUEL = $tuple['COUT'];
    }else{
        $NOM = $tuple['NOM'];
        // $requet_cout = "SELECT sum(NOMBRE_HEURES * TAUX_HORAIRE) AS COUT_TACHE
        //                             FROM TACHE, FONCTION, EMPLOYE
        //                             WHERE TACHE.PROJET = '$NOM'
        //                             AND EMPLOYE.NO = TACHE.EMPLOYE AND EMPLOYE.NOM_FONCTION = FONCTION.NOM";
        // $COUT_ACTUEL = $bdd->query($requet_cout);
    }

    if(is_null($BUDGET)){

        $STATUT = '<i style=\"color=red\">en attente</i>';
    }else{

        if(is_null($DATE_FIN)){                
            $STATUT = '<i style=\"color=orange\">en cours de route</i>';
        }
        else{
            $STATUT = 'terminé<i style=\"color=green\">terminé</i>';
        }
    };



    echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td> ".$tuple['BUDGET']." </td><td> ".$COUT_ACTUEL." </td><td> ".$tuple['DATE_FIN']." </td><td> ".$STATUT." </td><td> ".$HEURES_PASSES]." </td></tr> ":
}
echo "</table>";
?>


