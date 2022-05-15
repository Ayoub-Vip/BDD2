 <!--  Formulaire pour rechercher une tache (question 1)-->
 <h1>Rechercher des tâches</h1>
 <form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input placeholder="EMPLOYE" type="number" name="EMPLOYE"><br>
    <input placeholder="PROJET" type="text" name="PROJET"><br>
    <input placeholder="NOMBRE_HEURES"type="number" name="NOMBRE_HEURES"><br>
    <input type="submit" name="display_TACHE" class="myput" value="Rechercher"/>
 </form>

<!-- Affichage des taches en contraignant des paramètres (question 1)-->
<?PHP

if($_POST['display_TACHE']){
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $NOMBRE_HEURES=htmlspecialchars($_POST['NOMBRE_HEURES']);

        $request = "SELECT * FROM TACHE WHERE UPPER(PROJET) LIKE UPPER('%$PROJET%')";
        if(strlen($EMPLOYE) != 0)
            $request .= " AND EMPLOYE = $EMPLOYE";
        if(strlen($NOMBRE_HEURES) != 0)
            $request .= " AND NOMBRE_HEURES = $NOMBRE_HEURES";
        $req = $bdd->query($request);

        echo '<h2>List of TACHE in database</h2>';
        echo "<table class=\"datatable\">
        <tr><th>EMPLOYE</th><th>PROJET</th><th>NOMBRE_HEURES</th></tr>";
        while ($tuple = $req->fetch()) {
            echo "<tr> <td>".$tuple['EMPLOYE']." </td><td>".$tuple['PROJET']." </td><td>".$tuple['NOMBRE_HEURES']."</td></tr> ";
        }
        echo "</table>";

}
?>

 <!--  Ajout et affichage des taches pour un employé (question 4)-->
<?PHP
if($_POST['insert_Projet'] or $_GET['projet']) {
    $PROJET=htmlspecialchars($_POST['PROJET']);
    if ($_GET['projet']) {
        $PROJET=htmlspecialchars($_GET['projet']);
    }


    $request = "SELECT DATE_FIN FROM PROJET where NOM = '$PROJET'";
    $fetch_PROJET = $bdd->query($request);
    $col = $fetch_PROJET->fetch();
    $date_fin = $col['DATE_FIN'];

    if(strlen($date_fin)==0){ ?>
        <br>
        <hr>
        <h1>Projet Selectionne: <?PHP echo $PROJET; ?></h1>
        <h1>Rajouter des tâches à un employé déjà présent sur le projet</h1>
        <form action="<?PHP echo $PHP_SELF; ?>" method="post">
            <select name="EMPLOYE" required>
                <option value="">--Choissisez un employé-</option>
            <?PHP
                $request = "SELECT EMPLOYE FROM TACHE where PROJET = '$PROJET'";
                $fetch_EMPLOYE = $bdd->query($request);
                echo($request);
                while($row = $fetch_EMPLOYE->fetch()) {
                    $name = $row['EMPLOYE'];
                    echo "<option value=".$name.">".$name."</option>";
                }
                echo "<input type = 'hidden' name = 'PROJET' value = '$PROJET'/>";
            ?>
            <input placeholder="NOMBRE_HEURES"type="number" name="NOMBRE_HEURES" required><br>
            <input type="submit" name="insert_EMPLOYEE" class="myput" value="Choisir employé et nombre d'heure"/>
        </form>

        <br>
        <hr>
        <h1>Ajouter des tâches sur le projet à un nouvel employé</h1>
        <form action="<?PHP echo $PHP_SELF; ?>" method="post">
            <select name="EMPLOYE" required>
                <option value="">--Choissisez un employé--</option>
            <?PHP

                $request = "SELECT NO FROM EMPLOYE where NO NOT IN (SELECT EMPLOYE FROM TACHE where PROJET = '$PROJET')";
                $fetch_EMPLOYE = $bdd->query($request);
                echo($request);
                while($row = $fetch_EMPLOYE->fetch()) {
                    $name = $row['NO'];
                    echo "<option value=".$name.">".$name."</option>";
                }
                echo "<input type = 'hidden' name = 'PROJET' value = '$PROJET'/>";
            ?>
            <input placeholder="NOMBRE_HEURES"type="number" name="NOMBRE_HEURES" required><br>
            <input type="submit" name="insert_NEW_EMPLOYEE" class="myput" value="Choisir employé et nombre d'heure"/>
        </form>


        <br>
        <hr>
        <h1>Cloturer un projet</h1>
        <form action="<?PHP echo $PHP_SELF; ?>" method="post">
            <input placeholder="DATE_FIN"type="date" name="DATE_FIN" required><br>
            <?PHP
            echo "<input type = 'hidden' name = 'PROJET' value = '$PROJET'/>";
            ?>
             <select name="EVALUATION">
                <option value="">--Choissisez une évaluation--</option>
            <?PHP
                $request = "SELECT DISTINCT(AVIS) FROM EVALUATION";
                $fetch_NUMBER = $bdd->query($request);
                echo($request);
                while($row = $fetch_NUMBER->fetch()) {
                    $name = $row['AVIS'];
                    echo "<option value=".$name.">".$name."</option>";
                }
            ?>
            <input placeholder="COMMENTAIRES"type="text" name="COMMENTAIRES"><br>
            <select name="EXPERT">
                <option value="">--Choissisez un expert--</option>
                <?PHP
                    $request = "SELECT NO FROM EMPLOYE";
                    $fetch_NUMBER = $bdd->query($request);
                    echo($request);
                    while($row = $fetch_NUMBER->fetch()) {
                        $name = $row['NO'];
                        echo "<option value=".$name.">".$name."</option>";
                    }
                ?>

            <input type="submit" name="End_Project" class="myput" value="Finnaliser"/>
        </form>
        <?PHP
    }else{
        $request = "SELECT * FROM PROJET WHERE NOM LIKE UPPER('%$PROJET%')";
        $req = $bdd->query($request);

        echo '<h2>Liste des projets</h2>';
        echo "<table class=\"datatable\" >
        <tr><th>NOM</th><th>DEPARTEMENT</th><th>DATE_DEBUT</th><th>CHEF</th><th>BUDGET</th><th>COUT</th><th>DATE_FIN</th></tr>";
        while ($tuple = $req->fetch()) {
            // code...
            $COUT = $tuple['COUT'];
            $BUDGET = $tuple['BUDGET'];
            $color = "";
            if(strlen($date_fin)> 0){
                if($COUT <= $BUDGET){
                    $color = "#008000";
                }
                else{
                    if($COUT > 1.1 * $BUDGET){
                        $color = "#f00020";
                    }
                    else{
                        $color = "#ff7f00 ";
                        }
                }
            }
            echo "<tr style='background:".$color.";'> <td>".$tuple['NOM']." </td><td>".$tuple['DEPARTEMENT']." </td><td>".$tuple['DATE_DEBUT']."</td><td>".$tuple['CHEF']."</td><td>".$BUDGET."</td><td>".$COUT."</td><td>".$tuple['DATE_FIN']."</td></tr> ";
        }
        echo "</table>";
    }
}
else{
?>


 <!--  Formulaire pour ajouter des taches sur un projet(question 4)-->
<br>
<hr>
<h1>Cloturer ou Ajouter des tâches sur un projet</h1>
<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <select name="PROJET" required>
        <option value="">--Choisissez un projet--</option>
            <?PHP
                $fetch_projet = $bdd->query("SELECT * FROM PROJET");

                while ($row = $fetch_projet->fetch()) {

                    $name = $row['NOM'];

                    $request = "SELECT DATE_FIN FROM PROJET where NOM = '$name'";
                    $fetch_date_fin = $bdd->query($request);
                    $col = $fetch_date_fin->fetch();
                    $date_fin = $col['DATE_FIN'];

                    $request = "SELECT BUDGET FROM PROJET where NOM = '$name'";
                    $fetch_budget = $bdd->query($request);
                    $col = $fetch_budget->fetch();
                    $budget = $col['BUDGET'];

                    $request = "SELECT COUT FROM PROJET where NOM = '$name'";
                    $fetch_COUT = $bdd->query($request);
                    $col = $fetch_COUT->fetch();
                    $COUT = $col['COUT'];
                    echo($COUT);
                    if(strlen($date_fin)> 0){
                        if($COUT <= $budget){
                            echo "<option value=".$name." style='background-color : #008000'>".$name."</option>";
                        }
                        else{
                            if($COUT > 1.1 * $BUDGET){
                                echo "<option value=".$name." style='background-color : #ff7f00 '>".$name."</option>";
                            }
                            else{
                                echo "<option value=".$name." style='background-color : #f00020'>".$name."</option>";
                            }
                        }
                    }else{
                        echo "<option value=".$name.">".$name."</option>";
                    }
                }
            ?>
    <input type="submit" name="insert_Projet" class="myput" value="Choisir"/>
</form>



<?php

}
?>
 <!--  Mise à jour des taches et cloture du projet(question 4)-->
<?PHP
if($_POST['insert_EMPLOYEE']){
    $NOMBRE_HEURES=htmlspecialchars($_POST['NOMBRE_HEURES']);
    $EMPLOYE=htmlspecialchars($_POST['EXPERT']);
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $check=true;

    if($check){
        echo($NOMBRE_HEURES);
        echo($PROJET);
        $request = "UPDATE TACHE SET NOMBRE_HEURES = NOMBRE_HEURES + $NOMBRE_HEURES where PROJET = '$PROJET' AND EMPLOYE = '$EMPLOYE'";
        echo($request);
        $bdd->query($request);
    }
}

if($_POST['insert_NEW_EMPLOYEE']){
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $NOMBRE_HEURES=htmlspecialchars($_POST['NOMBRE_HEURES']);
    $EMPLOYE=htmlspecialchars($_POST['EMPLOYE']);
    $check=true;
    if($check){
        $request = "INSERT INTO TACHE(EMPLOYE, NOMBRE_HEURES, PROJET) VALUES ($EMPLOYE, $NOMBRE_HEURES,'$PROJET')";
        $req = $bdd->query($request);
    }
}

if($_POST['End_Project']){
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);
    $PROJET=htmlspecialchars($_POST['PROJET']);
    $EMPLOYE=htmlspecialchars($_POST['EXPERT']);
    $EVALUATION=htmlspecialchars($_POST['EVALUATION']);
    $COMMENTAIRES=htmlspecialchars($_POST['COMMENTAIRES']);
    $check=true;

    if($DATE_FIN < $bdd->query("SELECT DATE_DEBUT FROM PROJET WHERE NOM = '$PROJET'")->fetch()[0]){
        echo "Attention! la DATE_FIN < DATE_DEBUT";
        exit(1);

    }

    if($check){
        if(strlen($EVALUATION) == 0 and $EMPLOYE == 0 and strlen($COMMENTAIRES) == 0){
            $request = "UPDATE PROJET  SET DATE_FIN = '$DATE_FIN' where NOM = '$PROJET'";
            $bdd->query($request);
        }elseif(strlen($EVALUATION) > 0 and $EMPLOYE > 0 and strlen($COMMENTAIRES) > 0){
            $request = "UPDATE PROJET  SET DATE_FIN = '$DATE_FIN' where NOM = '$PROJET'";
            $bdd->query($request);
            $request = "INSERT INTO EVALUATION(PROJET, EXPERT, COMMENTAIRES, AVIS) VALUES ('$PROJET',$EMPLOYE,'$COMMENTAIRES','$EVALUATION')";
            $bdd->query($request);
        }else{
            echo("N'oubliez pas de renseigner tous les champs");
        }
    }
}
?>