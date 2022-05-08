<link rel="stylesheet" href="mycss/header.css" type="text/css"/>
<div class="header" dir="rtl">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

  <div class="search">
    <form action="<?php echo $PHP_SELF; ?>" method="post">
        <input type="text" name="search_query">
        <button  name="sub" class="myput"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
    </div>
    
</div>
    <div class="nev" >
    <ul class="po">
        <li><a href="#"><i class="fa fa-facebook"></i> Linke 1</a></li>
        <li><a href="#"> Linke 2</a></li>
        <li><a href="#"> Linke 3</a></li>
        <li><a href="#"> Linke 4</a></li>
        <li><a href="#"> Linke 5</a></li>
        <li><a href="#"> Linke 6</a></li>
        <li><a href="#"> Linke 7</a></li>
        </ul>
    
    </div>

<?php
if($_POST['sub']){
    
    if(preg_match("/[a-zA-Z0-9{1,10}]/",$_POST['search_query']))
        {
        $word=$_POST['search_query'];
        $conn=mysqli_connect("localhost","root","root","advphp");
        $sql="SELECT * FROM threads WHERE thread OR title LIKE '%$word%'";
        $search=mysqli_query($conn,$sql) ;
        
        if(mysqli_num_rows($search)){
          //THE while loop//  
    while($row=mysqli_fetch_array($search)){
        echo "result ".$row['thread']."<br><br>";
        };//  END  of the while loop //
        }else{
            echo "<span>soory we can not find this word in our site</span>";
        }
    
    }
    
    else{
        echo "<b>PLEASE don't enter a spchiale character ,your word_search is empty, PLEASE enter a valide word </b>";
    }
         
   
}

?>