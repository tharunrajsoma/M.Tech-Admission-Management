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
      <h2>Logged in as: <?php echo "". $_SESSION['username'] ."" ;?></h2>
      <h2> <a href = "logout.php"><b>Sign Out</b></a></h2>
       <form action="" method="post">
           
          <div class='inline'><b>GATE</b> Score from <input type="text" name="score1" value="<?php if (isset($_GET['score1'])) { echo $_GET['score1']; } else {echo "0";} ?>" style="width:50px;"> to <input type="text" name="score2" value="<?php if (isset($_GET['score2'])) { echo $_GET['score2']; } else{echo "10000";} ?>" style="width:50px;" ></div>
          <!--<div ><b>RA</b> 1st Priority<input type="checkbox" name="RA1" value="M.Tech RA">2nd Priority<input type="checkbox" name="2nd priority" value="M.Tech RA">Not-Interested<input type="checkbox" name="Not Interested" value="M.Tech RA"><br></div>
          <div ><b>TA</b> 1st Priority<input type="checkbox" name="1st priority" value="M.Tech TA">2nd Priority<input type="checkbox" name="2nd priority" value="M.Tech TA">Not-Interested<input type="checkbox" name="Not Interested" value="M.Tech TA"><br></div> -->
          1st priority <select name="p1" id="p1" onChange="javascript:document.myform.submit();">
            <option <?php if($_GET['p1']=='NULL') {echo "selected";} ?>  value="NULL">None</option>
            <option <?php if($_GET['p1']=='M.Tech RA'){echo "selected";} ?>  value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p1']=='M.Tech TA'){echo "selected";} ?>  value="M.Tech TA">M.Tech TA</option>
           
          </select>

          2nd priority <select name="p2" id="p2" onChange="javascript:document.myform.submit();">
            <option <?php if($_GET['p2']=='NULL') echo "selected"; ?> value="NULL">None</option>
            <option <?php if($_GET['p2']=='M.Tech RA') echo "selected"; ?> value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p2']=='M.Tech TA') {echo "selected";} ?> value="M.Tech TA">M.Tech TA</option>  
            
            
          </select>

          Not Interested <select name="p0" id="p0" onChange="javascript:document.myform.submit();">
            <option <?php if($_GET['p0']=='NULL') {echo "selected";}?> value="NULL">None</option>
            <option <?php if($_GET['p0']=='M.Tech RA') echo "selected"; ?> value="M.Tech RA">M.Tech RA</option>
            <option <?php if($_GET['p0']=='M.Tech TA') echo "selected"; ?> value="M.Tech TA">M.Tech TA</option>  
          </select>

          Sort by <select name="sort" id="btn-score" >
            <option <?php if($_GET['sort']=='GATE SCORE') echo "selected"; ?>  value="GATE SCORE">Gate Score</option>
            <option <?php if($_GET['sort']=='BIRTH CATEGORY') echo "selected"; ?> value="BIRTH CATEGORY">Birth Category</option>
            <option <?php if($_GET['sort']=='NAME') echo "selected"; ?> value="NAME">Name</option>
          </select>
          <div class='inline'>Disability<input type="checkbox" name="d" <?php if($_GET['d']=='No') {echo "checked";}?> value="No" ></div>
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
   define('DB_DATABASE', 'test2');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $score1=0;
   $score2=10000;
   $p1='NULL';
   $p2='NULL';
   $p0='NULL';
   $sort='GATE SCORE';
   $d='N';

   if( isset($_POST['btn-score'])) { 

      $sort = mysqli_real_escape_string($db,$_POST['sort']);       
        $p1 = mysqli_real_escape_string($db,$_POST['p1']);
        
        $p2= mysqli_real_escape_string($db,$_POST['p2']);
        $p0 = mysqli_real_escape_string($db,$_POST['p0']);
       $score1=mysqli_real_escape_string($db,$_POST['score1']);
       $score2=mysqli_real_escape_string($db,$_POST['score2']);
       $d=mysqli_real_escape_string($db,$_POST['d']);
       
       if($score1 == NULL)
       {
          $score1=0;
       }
       if($score2 == NULL)
       {
          $score2=1000;
       }
       $page=1;
       header("location: welcome.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&sort=".$sort."&d=".$d."&page=".$page."");
  }
  else
  {
   // echo $d;
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
    if(!empty($_GET['sort']))
    {
       $sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING);

    }
    if(!empty($_GET['d']))
    {
       $d = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);

    }
 }
 $start_from = ($page-1) * $results_per_page;
 if($p1=='NULL')
 {
    if($p2=='NULL')
   {
      if($p0=='NULL')
      {
       
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;

      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }
   }
   else
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE3`='$p2' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE3`='$p2' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE3`='$p2' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE3`='$p2' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }

   }
 }
 else
 {
   if($p2=='NULL')
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `DISABLE STATUS`!='$d'"; 
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }
   }
   else
   {
      if($p0=='NULL')
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE3`='$p2' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE3`='$p2' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }
      else
      {
        
        $sql1 = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE3`='$p2' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d'";
        $sql = "SELECT * FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1' and `PROGRAM TYPE3`='$p2' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d' ORDER BY `$sort` desc LIMIT  $start_from, ".$results_per_page;
      }

   }

 }
 
  $result = mysqli_query($db,$sql);

   echo "<div align='center'><table></div>";
   echo "<tr><th>Name</th><th>Birth Category</th><th>Disable Status</th><th>Percentage of Marks</th><th>Percentage of GP</th><th>Valid Upto</th><th>Gate score</th><th>First Priority</th><th>Second Priority</th></tr>";

   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo "<tr><td>";
    echo $row['NAME'];
    echo "<td>";
    echo $row['BIRTH CATEGORY'];
    echo "<td>";
    echo $row['DISABLE STATUS'];
    echo "<td>";
    echo $row['PERCENTAGE OF MARKS'];
    echo "<td>";
    echo $row['PERCENTAGE OF GP'];
    echo "<td>";
    echo $row['VALID UPTO'];
    echo "<td>";
    echo $row['GATE SCORE'];
    echo "<td>";
    echo $row['PROGRAM TYPE2'];
    echo "<td>";
    echo $row['PROGRAM TYPE3'];
    echo "<tr>";
    
   }
   echo "</table>";
  //$sql = "SELECT COUNT(`APPLICATION NUMBER`) AS total FROM `TABLE 1` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE2`='$p1'and `PROGRAM TYPE3`='$p2' and `PROGRAM TYPE1`='$p0' and `DISABLE STATUS`!='$d'";
  $result1 = mysqli_query($db,$sql1);
  $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);

  $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
    
  $num_rows=$row["total"];
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='welcome.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&sort=".$sort."&d=".$d."&page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
};  
$export='Export to Excel';
echo "<p><a href='UserReport_Export.php?score1=".$score1."&score2=".$score2."&p1=".$p1."&p2=".$p2."&p0=".$p0."&d=".$d."'>".$export."</a></p>";
?>
