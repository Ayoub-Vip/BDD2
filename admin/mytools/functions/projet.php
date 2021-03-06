
<!--  Formulaire pour rechercher un projet (question 1)-->
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


<!-- Affichage des Projets en contraignant des paramètres (question 1)-->
<?PHP
if($_POST['display_PROJET']){
    $NOM=htmlspecialchars($_POST['NOM']);
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $CHEF=htmlspecialchars($_POST['CHEF']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);

    $request = "SELECT * FROM PROJET WHERE UPPER(NOM) LIKE UPPER('%$NOM%') AND UPPER(DEPARTEMENT) LIKE UPPER('%$DEPARTEMENT%')";
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

    echo '<h2>Liste des projets</h2>';
    echo "<table class=\"datatable\">
    <tr id=\"headtable\"><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th></tr>";
    while ($tuple = $req->fetch()) {
        echo "<tr> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td>".$tuple['BUDGET']."</td><td> ".$tuple['COUT']." </td><td>".$tuple['DATE_FIN']."</td></tr> ";
    }
    echo "</table>";
}
?>


<!--Formulaire pour ajouter un projet (question 3)-->
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
    <input placeholder="BUDGET"type="number" name="BUDGET" >
    <input placeholder="COUT" type="number" name="COUT">
    <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
    <input type="submit" name="INSERT_PROJET" class="myput" value="Ajouter"/>

</form>


<!-- Insertion du nouveau projet dans la base de données (Question 3)-->
<?PHP

if($_POST['INSERT_PROJET']){
    $NO=htmlspecialchars($_POST['NO']);
    $NOM=htmlspecialchars($_POST['NOM']);
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);
    if(strlen($BUDGET) == 0)
        $BUDGET = 'NULL';
    if(strlen($COUT) == 0)
        $COUT = 'NULL';
    if(strlen($bdd->query("SELECT NOM FROM PROJET WHERE NOM = '$PROJET'")->fetch()[0]) != 0){
        echo "Attention! ce projet existe deja dans la base de donnes";
        exit(1);

    }
    if($NO != "DEFAULT" and $NOM != NULL and  $DEPARTEMENT != "DEFAULT" and $DATE_DEBUT != NULL) {
         if(strlen($DATE_FIN) == 0)
            $request = "INSERT INTO `PROJET`(`NOM`, `DEPARTEMENT`, `DATE_DEBUT`, `CHEF`, `BUDGET`, `COUT`, `DATE_FIN`) VALUES ('$NOM','$DEPARTEMENT', '$DATE_DEBUT' ,'$NO', $BUDGET, $COUT, null)";
         else
            $request = "INSERT INTO `PROJET`(`NOM`, `DEPARTEMENT`, `DATE_DEBUT`, `CHEF`, `BUDGET`, `COUT`, `DATE_FIN`) VALUES ('$NOM','$DEPARTEMENT', '$DATE_DEBUT' ,'$NO', $BUDGET, $COUT, '$DATE_FIN')";
         $bdd->query($request);
         echo("req =".$request);
    }
    else{
         echo("Erreur : Nom, Département, Date Début et Chef requis.");
    }
} ?>



<!-- Formulaire pour choisir les taches à afficher pour un projet(Question 2)-->
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


<!-- Affichage des taches (Question 2)-->
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

<!-- Tableau de bord (Question 6)-->
<h1>Tableau de bord</h1>
<?PHP

echo "<table class=\"datatable\">
<tr><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th><th>STATUT</th><th>HEURES_PASSES</th><th>+tache</th><th>cloturer</th></tr>";

$request = "SELECT PROJET.NOM,
                    PROJET.DEPARTEMENT,
                    PROJET.DATE_DEBUT,
                    PROJET.CHEF,
                    PROJET.BUDGET,
                    (SELECT sum(NOMBRE_HEURES * TAUX_HORAIRE) AS COUT_TACHE
                                     FROM TACHE, FONCTION, EMPLOYE
                                    WHERE TACHE.PROJET = PROJET.NOM
                                    AND EMPLOYE.NO = TACHE.EMPLOYE AND EMPLOYE.NOM_FONCTION = FONCTION.NOM) AS COUT,
                    PROJET.DATE_FIN,
                    (SELECT SUM(NOMBRE_HEURES) FROM TACHE WHERE TACHE.PROJET = PROJET.NOM ) as HEURES_PASSES
            FROM PROJET LEFT JOIN TACHE ON PROJET.NOM = TACHE.PROJET
            WHERE 1
            GROUP BY PROJET.NOM ORDER BY PROJET.DATE_DEBUT ASC,PROJET.NOM ASC";

    $reqprojet = $bdd->query($request);

    while ($tuple = $reqprojet->fetch()) {
        if(is_null($tuple['BUDGET'])){
            $STATUT = '<i style=\"color=red\">en attente</i>';
        }else{
            if(is_null($tuple['DATE_FIN'])){
                $STATUT = '<i style=\"color=orange\">en cours de route</i>';
            }
            else{
                $STATUT = '<i style=\"color=orange\">terminé</i>';
            }
        }
        $NOM = $tuple['NOM'];
         echo "<tr><td>".$NOM." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td> ".$tuple['CHEF']." </td><td> ".$tuple['BUDGET']." </td><td> ".$tuple['COUT']." </td><td> ".$tuple['DATE_FIN']." </td><td> ".$STATUT." </td><td>".$tuple['HEURES_PASSES']." </td>
         <td>";
         if ($STATUT != '<i style=\"color=orange\">terminé</i>') {
             echo "<a class=\"botton-controle\" style='wrap:no-wrap' href=\"admin_page.php?table=tache&projet=".$NOM." \">Ajouter</a>";
         }
         echo "</td><td>";
         if ($STATUT != '<i style=\"color=orange\">terminé</i>') {
             echo "<a class=\"botton-controle\" href=\"admin_page.php?table=tache&projet=".$NOM." \">Cloturer</a>";
         }
    }

   echo "</td></tr>";
echo "</table>";

?>