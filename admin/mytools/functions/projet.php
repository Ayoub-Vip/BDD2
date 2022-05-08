<?PHP
                        if($_POST['display_PROJET']){
    $name=htmlspecialchars($_POST['search']);  ////////////////////////////////////
    $DEPARTEMENT=htmlspecialchars($_POST['DEPARTEMENT']);
    $CHEF=htmlspecialchars($_POST['CHEF']);
    $BUDGET=htmlspecialchars($_POST['BUDGET']);
    $DATE_DEBUT=htmlspecialchars($_POST['DATE_DEBUT']);
    $COUT=htmlspecialchars($_POST['COUT']);
    $DATE_FIN=htmlspecialchars($_POST['DATE_FIN']);
    $check=true;

    echo $name;
    // if($name != $confname || empty($name)){
    //     echo "attention ,you have enter a defirent data in the name !";
    //     $check=false;
    // }
    // if($email != $confemail || empty($email)){
        
    //     echo "attention ,you have enter a defirent data in the email !";
    //     $check=false;
    // }
    // if($pass != $confpass || empty($pass)){
    //     echo "attention ,you have enter a defirent data in the password !<br> also the password must be biggerthan 8";
    //     $check=false;
    // }
    if($check){
        include_once("../config.php");
        $req = $bdd->query('SELECT * FROM PROJET WHERE 1 ');
        echo '<h2>you have create a new user ,<b>good job ;D</b></h2>';
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