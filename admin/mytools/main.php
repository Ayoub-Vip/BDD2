
<?php // session_start(); ?>
<? 
/*if(!$_SESSION['checklog']){header("location:../login.php");}
  //elseif(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
    //header("location:../login.php");
  }*/
?>
<div class="main">
<!--EVALUATION site //  site about PROJET-->
<!--EMPLOYE day - FONCTION's days - TACHE's gifts -  RAPPORT - EVALUATION anniversary - smart gifts -->
<section class="pricpal-product">
                        <input id="search" placeholder="NOM" type="text" name="NOM"><br>
    
    <div class="container-pro">
        <div class="titles-pro">
            <i>LISTE OF TABLES</i>
            <ul>
                <li  href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;PROJET&#39;)"  id="defaultOpen">PROJET</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;EMPLOYE&#39;)">EMPLOYE</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;TACHE&#39;)">TACHE</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;FONCTION&#39;)">FONCTION</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;RAPPORT&#39;)">RAPPORT</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;EVALUATION&#39;)">EVALUATION</li>
                <li href="javascript:void(0)" class="temp" onmouseover="openCity(event, &#39;DEPARTEMENT&#39;)">DEPARTEMENT</li>
                
            </ul>
        </div>
        <div class="gallery-pro">
            <div class="gall " id="PROJET" style="display: block">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input id="search" placeholder="NOM" type="text" name="NOM"><br>
                        <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT"><br>
                        <input placeholder="CHEF" type="text" name="CHEF"><br>
                        <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT"><br>
                        <input placeholder="BUDGET"type="number" name="BUDGET"><br>
                        <input placeholder="COUT" type="number" name="COUT"><br>
                        <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">
                        <input type="submit" name="display_PROJET">

                    </form>
                    <div id="result">
                        

                    </div>
                    <style>
table {
  width:100%;
}
table, th, td {
  border:  0px 0px 1px 1px  solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: center;
}
table.datatable tr:nth-child(even) {
  background-color: #eee;
}
table.datatable tr:nth-child(odd) {
  background-color:#fff;
}
table.datatable th {
  background-color: black;
  color: white
}
</style>

                </div>
                <div class="img-gall2"><a href="">add project</a></div>
                <div class="img-gall3"><a href="">browser</a></div>
                <!-- <div class="img-gall3"><img src="../vars/pexels-photo-753554.jpeg" alt=""></div> -->
               </div>
            </div>

            <div class="gall " id="EMPLOYE" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="NO" type="text" name="NO"><br>
                        <input placeholder="NOM" type="text" name="NOM"><br>
                        <input placeholder="NOM_DEPARTEMENT" type="text" name="NOM_DEPARTEMENT"><br>
                        <input placeholder="NOM_FONCTION" type="text" name="NOM_FONCTION"><br>
                        

                    </form>
                </div>
                <div class="img-gall2"><a href="">add employe</a></div>
                <div class="img-gall3"><a href="">search employe</a></div>
                </div>
            </div>
            <div class="gall " id="TACHE" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="EMPLOYE" type="text" name="EMPLOYE"><br>
                        <input placeholder="PROJET" type="text" name="PROJET"><br>
                        <input placeholder="TITRE"type="text" name="TITRE"><br>

                    </form>
</div>
                <div class="img-gall2"><a href="">search</a></div>
                <div class="img-gall3"><a href="">ADD</a></div>
                </div>
            </div>
            <div class="gall " id="FONCTION" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="NOM" type="text" name="NOM"><br>
                        <input placeholder="TAUX_HORAIRE" type="number" name="TAUX_HORAIRE"><br>
                       

                    </form>
</div>
                <div class="img-gall2"><a href="">search</a></div>
                <div class="img-gall3"><a href="">VIEW MORE</a></div>
                </div>
            </div>
            <div class="gall " id="RAPPORT" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="EMPLOYE" type="text" name="EMPLOYE"><br>
                        <input placeholder="PROJET" type="text" name="PROJET"><br>
                        <input placeholder="TITRE" type="TEXT" name="TITRE" title="DATE_DEBUT">

                    </form>
</div>
                <div class="img-gall2"><a href="">search</a></div>
                <div class="img-gall3"><a href="">VIEW MORE</a></div>
                </div>
            </div>
            <div class="gall " id="EVALUATION" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="PROJET" type="text" name="PROJET"><br>
                        <input placeholder="EXPERT" type="text" name="EXPERT"><br>
                        <input placeholder="COMMENTAIRE" type="text" name="COMMENTAIRE"><br>
                        <input placeholder="AVIS" type="text" name="AVIS">


                    </form>
</div>
                <div class="img-gall2"><a href="">search</a></div>
                <div class="img-gall3"><a href="">VIEW MORE</a></div>
                </div>
            </div>
            <div class="gall " id="DEPARTEMENT" style="display:none">
               <div class="in-gall">
                <div class="img-gall1">
                    <form action="" method="post">
                        <input placeholder="NOM" type="text" name="NOM"><br>
                        <input placeholder="DEPARTEMENT" type="text" name="DEPARTEMENT"><br>
                        <input placeholder="DATE_DEBUT" type="date" name="DATE_DEBUT" title="DATE_DEBUT"><br>
                        <input placeholder="BUDGET"type="number" name="BUDGET"><br>
                        <input placeholder="COUT" type="number" name="COUT"><br>
                        <input placeholder="DATE_FIN" type="date" name="DATE_FIN" title="DATE_FIN">

                    </form>
</div>
                <div class="img-gall2"><a href="">VIEW MORE</a></div>
                <div class="img-gall3"><a href="">VIEW MORE</a></div>
                </div>
            </div>
        </div>
        
    </div>
</section>
        <script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("gall");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
//        tabcontent[i].style= "";
    }
    tablinks = document.getElementsByClassName("temp");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" actived", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " actived";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

/*    const temp=document.querySelector('.temp');
    const gall=document.querySelector('.gall');
    temp.addEventListener('mousehover',()=> {
        gall.classList.add('gall-active')
    })
    temp.addEventListener('mouseleave',()=> {
        gall.classList.add('gall-active')
    })*/
    </script>


</div>
        <script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("gall");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
//        tabcontent[i].style= "";
    }
    tablinks = document.getElementsByClassName("temp");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" actived", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " actived";
}
