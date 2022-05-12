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
    $NOM=htmlspecialchars($_POST['NOM']);  ////////////////////////////////////
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
            $request .= " AND DATE_DEBUT = $DATE_DEBUT";
        if(strlen($COUT) != 0)
            $request .= " AND COUT = $COUT";
        if(strlen($DATE_FIN) != 0)
            $request .= " AND DATE_FIN = $DATE_FIN";
        $req = $bdd->query($request);

        echo $request;


        echo '<h2>List of projects in database</h2>';
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
<h1>INSERT DATA</h1>

<form action="<?PHP echo $PHP_SELF; ?>" method="post">
    <input id="search" placeholder="NOM" type="text" name="NOM">
    <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT">
    <input placeholder="CHEF" type="text" name="CHEF">
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
        $req = $bdd->query("INSERT INTO  PROJET VALUES  NOM LIKE '%".$NOM."%' OR DEPARTEMENT LIKE '%".$DEPARTEMENT."%' OR 
            CHEF LIKE '%".$CHEF."%' OR BUDGET = '".$BUDGET."' OR DATE_DEBUT = '".$DATE_DEBUT."' OR COUT = '".$COUT."' OR DATE_FIN ='".$DATE_FIN."'  ");

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

