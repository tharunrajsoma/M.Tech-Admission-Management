<?php
  session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
    echo "<script language=\"JavaScript\">\n";
        echo "alert('Please log in first to see this page');\n";
        echo "window.location='index.php'";
        echo "</script>";
}
  
?>

<html>
   <head>
      <title>Welcome </title>
  
      <style type ="text/css">
      .inline { 

      display: inline-block;
      }
      body {
        text-align:center;
      background: url("Nature-008.jpg") 10% fixed;
      background-size: cover;
    }
      table{
        border: 2px solid red;
        background-color:#ffffb3;
        text-align:center;
      }
      th{
        border-bottom: 5px solid #000;

      }
      td{
        border-bottom: 2px solid #666;
      }
      h1 {
        color: #ffffb3;

        font-family: verdana;
        font-size: 250%;

    }
    form {
      color: #ffffb3;
        font-family: verdana; 

    }
    h2 {
      color: #ffffb3;
        font-size: 120%;
        text-align:right;
    }
    a:link    {color:#ffffb3; background-color:transparent; text-decoration:none}
    a:visited {color:#ffffb3; background-color:transparent; text-decoration:none}
    a:hover   {color:red; background-color:transparent; text-decoration:none}
    a:active  {color:yellow; background-color:transparent; text-decoration:none}

      </style>
   </head>
   
   <body>

      <h1><a href="welcome.php">Welcome <?php echo $login_session; ?></a></h1> 
     
      <h2 align="right">Logged in as: <?php echo "". $_SESSION['username'] ."" ;?></h2>
      <h2> <a href = "logout.php"><b>Sign Out</b></a></h2>
       <form action="" method="post">
           
          <div class='inline'><b>GATE</b> Score from <input type="text" name="score1" value="<?php if (isset($_GET['score1'])) { echo $_GET['score1']; } else {echo "0";} ?>" style="width:50px;"> to <input type="text" name="score2" value="<?php if (isset($_GET['score2'])) { echo $_GET['score2']; } else{echo "10000";} ?>" style="width:50px;" ></div>
          <!--<div ><b>RA</b> 1st Priority<input type="checkbox" name="RA1" value="M.Tech RA">2nd Priority<input type="checkbox" name="2nd priority" value="M.Tech RA">Not-Interested<input type="checkbox" name="Not Interested" value="M.Tech RA"><br></div>
          <div ><b>TA</b> 1st Priority<input type="checkbox" name="1st priority" value="M.Tech TA">2nd Priority<input type="checkbox" name="2nd priority" value="M.Tech TA">Not-Interested<input type="checkbox" name="Not Interested" value="M.Tech TA"><br></div> -->
          1st priority <select name="p1" id="p1" >
            <option <?php if($_GET['p1']=='NULL') {echo "selected";} ?>  value="NULL">None</option>
            <option <?php if($_GET['p1']=='M.Tech RA'){echo "selected";} ?>  value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p1']=='M.Tech TA'){echo "selected";} ?>  value="M.Tech TA">M.Tech TA</option>
           
          </select>

          2nd priority <select name="p2" id="p2" >
            <option <?php if($_GET['p2']=='NULL') echo "selected"; ?> value="NULL">None</option>
            <option <?php if($_GET['p2']=='M.Tech RA') echo "selected"; ?> value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p2']=='M.Tech TA') {echo "selected";} ?> value="M.Tech TA">M.Tech TA</option>  
            
            
          </select>

          Not Interested <select name="p0" id="p0" >
            <option <?php if($_GET['p0']=='NULL') {echo "selected";}?> value="NULL">None</option>
            <option <?php if($_GET['p0']=='M.Tech RA') echo "selected"; ?> value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p0']=='M.Tech TA') echo "selected"; ?> value="M.Tech TA">M.Tech TA</option>  
          </select>

          sort by <select name="st" id="btn-score" >
            <option <?php if($_GET['st']=='GATE SCORE') echo "selected"; ?>  value="GATE SCORE">Gate Score</option>
            <option <?php if($_GET['st']=='BIRTH CATEGORY') echo "selected"; ?> value="BIRTH CATEGORY">Birth Category</option>
            <option <?php if($_GET['st']=='APPLICATION NUMBER') echo "selected"; ?> value="APPLICATION NUMBER">Application no</option>
            <option <?php if($_GET['st']=='NAME') echo "selected"; ?> value="NAME">Name</option>
          </select>
          <div class='inline'>Disability<input type="checkbox" name="d" <?php if($_GET['d']=='No') {echo "checked";}?> value="No" ></div>
         <div class='inline'>Validity<input type="checkbox" name="v" <?php if($_GET['v']=='2017-05-03') {echo "checked";}?> value= "2017-05-03" ></div>
           <select id="btn-score" name="select[]" size="3" multiple="multiple" >
              <option value="0">Show all</option><option value="1">Application no</option><option value="2">Name</option><option value="3">Birth category</option><option value="4">Disability</option><option value="5">Email Id</option><option value="6">% of marks</option><option value="7">% of GP</option><option value="8">Gate Score</option><option value="9">Gate AIR</option><option value="10">valid upto</option><option value="11,12">First priority</option><option value="13,14">Second priority</option><option value="15,16">Not interested</option>
          </select>
          <button class="button button-block" name="btn-score">Search</button>

       </form>

    <script src="js/index.js"></script>
   </body>


</html>

<?php

   $results_per_page=15;
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'samantha');
   define('DB_DATABASE', 'mtech_list');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $score1=0;
   $score2=10000;
   $p1='NULL';
   $p2='NULL';
   $p0='NULL';
   $st='GATE SCORE';
   $d='N';
   $v='0000-00-00';
   $cnstr='N';
   $coln = array("APPLICATION NUMBER","NAME","BIRTH CATEGORY","DISABLE STATUS", "REGISTERED EMAIL ID", "PERCENTAGE OF MARKS$1", "PERCENTAGE OF GP$1",  "GATE SCORE", "GATE AIR", "VALID UPTO", "PROGRAM TYPE$1","PRIORITY$2","PROGRAM TYPE$2","PRIORITY$3", "PROGRAM TYPE", "PRIORITY$1", "GENDER", "MARITAL STATUS","DATE OF BIRTH","PLACE OF BIRTH","FATHER NAME","DISABLE DESCRIPTION","MOBILE NUMBER","DEGREE TYPE NAME$1","DEGREE NAME$1","INSTITUTE NAME$1","UNIVERSITY$1","SPECILIZATION$1","DIVISION$1","YEAR OF PASS$1","SECURED MARKS$1","TOTAL MARKS$1","SECURED GP$1","TOTAL GP$1","EXPERIENCE TYPE NAME","ORGANIZATION NAME","DESIGNITION","NATURE OF WORK","FROM DATE","TO DATE"," DURATION");
   //  ENTRY EXAM NAME REGISTRATION NUMBER EXAM YEAR SPECILAZATION DESCRIPTION PRIORITY  PROGRAM TYPE PRIORITY$1 PRIORITY$2 PROGRAM TYPE$2 PRIORITY$3 REFERENCE TYPE NAME AMOUNT


   if( isset($_POST['btn-score'])) { 

      $st = mysqli_real_escape_string($db,$_POST['st']);       
      $p1 = mysqli_real_escape_string($db,$_POST['p1']);  
      $p2= mysqli_real_escape_string($db,$_POST['p2']);
      $p0 = mysqli_real_escape_string($db,$_POST['p0']);
      $score1=mysqli_real_escape_string($db,$_POST['score1']);
      $score2=mysqli_real_escape_string($db,$_POST['score2']);
      $d=mysqli_real_escape_string($db,$_POST['d']);
      $v=mysqli_real_escape_string($db,$_POST['v']);
      $select=$_POST['select'];
      $flip=0;
      if ($select)
      {
        $cnstr='';
         foreach ($select as $cn)
         {
            if($flip==0)
              $cnstr=$cn;
            else
              $cnstr=$cnstr.','.$cn;
            $flip=1;
        }
      }
      else
      {
        $cnstr='N';
      }
       if($score1 == NULL)
       {
          $score1=0;
       }
       if($score2 == NULL)
       {
          $score2=1000;
       }
       if($d==NULL)
       {
         $d='N';
       }
       if($v==NULL)
       {
         $v='0000-00-00';
       }
       $page=1;

header("location:welcome.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&st=".$st."&d=".$d."&v=".$v."&cnstr=".$cnstr."&page=".$page."");

  }
  else
  {
    if (!empty($_GET['page'])) 
    { 
      $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    } 
    else
    { 
      $page=1; 
    }
    if(!empty($_GET['score1']))
    {
       $score1 = filter_input(INPUT_GET, 'score1', FILTER_VALIDATE_INT);

    }
    if(!empty($_GET['score2']))
    {
       $score2 = filter_input(INPUT_GET, 'score2', FILTER_VALIDATE_INT);

    }
    if(!empty($_GET['p1']))
    {
       $p1 = filter_input(INPUT_GET, 'p1', FILTER_SANITIZE_STRING);
    }
    if(!empty($_GET['p2']))
    {
       $p2 = filter_input(INPUT_GET, 'p2', FILTER_SANITIZE_STRING);

    }
    if(!empty($_GET['p0']))
    {
       $p0 = filter_input(INPUT_GET, 'p0', FILTER_SANITIZE_STRING);

    }
    if(!empty($_GET['st']))
    {
       $st = filter_input(INPUT_GET, 'st', FILTER_SANITIZE_STRING);

    }
    if(!empty($_GET['d']))
    {
       $d = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);

    }
    if(($_GET['v'])!=NULL)
    {
       $v = filter_input(INPUT_GET, 'v', FILTER_SANITIZE_STRING);

    }
    if (($_GET['cnstr'])!=NULL) 
    { 
      $cnstr = filter_input(INPUT_GET, 'cnstr', FILTER_SANITIZE_STRING);
    } 
 }
 $start_from = ($page-1) * $results_per_page;
 if($p1=='NULL')
 {
    if($p2=='NULL')
   {
      if($p0=='NULL')
      {
       
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;

      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }
   }
   else
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }

   }
 }
 else
 {
   if($p2=='NULL')
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'"; 
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }
   }
   else
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
        $sql = "SELECT * FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v' ORDER BY `$st` desc LIMIT  $start_from, ".$results_per_page;
      }

   }

 }
 
  $result = mysqli_query($db,$sql);
  echo "<div align='center'><table></div>";
if($cnstr=='N')
{

   
   echo "<tr><th>APPLICATION NUMBER</th><th>NAME</th><th>BIRTH CATEGORY</th><th>DISABLE STATUS</th><th>PERCENTAGE OF MARKS$1</th><th>PERCENTAGE OF GP$1</th><th>VALID UPTO</th><th>GATE SCORE</th><th>GATE AIR</th><th>FIRST PRIORITY</th><th>SECOND PRIORITY</th></tr>";

   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo "<tr><td>";
    echo $row['APPLICATION NUMBER'];
    echo "<td>";
    echo $row['NAME'];
    echo "<td>";
    echo $row['BIRTH CATEGORY'];
    echo "<td>";
    echo $row['DISABLE STATUS'];
    echo "<td>";
    echo $row['PERCENTAGE OF MARKS$1'];
    echo "<td>";
    echo $row['PERCENTAGE OF GP$1'];
    echo "<td>";
    echo $row['VALID UPTO'];
    echo "<td>";
    echo $row['GATE SCORE'];
    echo "<td>";
    echo $row['GATE AIR'];
    echo "<td>";
    echo $row['PROGRAM TYPE$1'];
    echo "<td>";
    echo $row['PROGRAM TYPE$2'];
    echo "<tr>";
    
   }
   
}
else
{
  $selcolnames = explode(",", $cnstr);
  
  if($selcolnames[0]=='0')
  {
    echo "<tr>";
    foreach ($coln as $id) {
      echo "<th>".$id."</th>";
    }
    echo "</tr>";
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
      echo "<tr>";
      foreach ($coln as $id) {
          echo "<td>".$row[$id];
       }
      echo "</tr>";
    }
  }
  else
  {
    echo "<tr>";
    foreach ($selcolnames as $id) {
      $var=$coln[$id-1];
      echo "<th>".$var."</th>";
    }
    echo "</tr>";
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
      echo "<tr>";
      foreach ($selcolnames as $id) {
          $var=$coln[$id-1];
          echo "<td>".$row[$var];
       }
      echo "</tr>";

    }

  }
}
echo "</table>";
  //$sql = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `mtechapplist` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1'and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d'";
  $result1 = mysqli_query($db,$sql1);
  $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);

  $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
    
  $num_rows=$row["total"];
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
  echo "<a href='welcome.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&st=".$st."&d=".$d."&v=".$v."&cnstr=".$cnstr."&page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
};  
$export='Export to Excel';
$import='Import csv';
echo "<p><a href='UserReport_Export.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&d=".$d."&v=".$v."&cnstr=".$cnstr."'>".$export."</a></p><p><a href='importcsv.html'>".$import."</a></p>";

?>
