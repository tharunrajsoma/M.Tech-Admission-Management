<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      // $myusername = $_SESSION['username'];
      // echo $myusername;
  } else {
      echo "<script language=\"JavaScript\">\n";
          echo "alert('Please log in first to see this page');\n";
          echo "window.location='index.php'";
          echo "</script>";
  }
    
  ?>

<html>
   <head>
      <title>Home </title>
  
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
        /*width:95%;*/
        border: 2px solid red;
        background-color:#ffffb3;
        font-size: 120%;
        text-align:center;
        /*margin-left: 10%;
        margin-right: 10%;*/
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
        text-align:center;

    }
    h2 {
      color: #ffffb3;
        font-size: 120%;
        text-align:right;
    }
    h3 {
      color: #ffffb3;
      font-size: 120%;
        /*text-align:center;*/
    }
    a:link    {color:#ffffb3; background-color:transparent; text-decoration:none}
    a:visited {color:#ffffb3; background-color:transparent; text-decoration:none}
    a:hover   {color:red; background-color:transparent; text-decoration:none}
    a:active  {color:yellow; background-color:transparent; text-decoration:none}

      </style>
   </head>
   
   <body>
      
      <h1><img src="iith.png" style="width:35px;height:35px;"><a href="home.php" >&#9; Home<?php echo $login_session; ?></a></h1> 
      <h2>Logged in as: <?php echo "". $_SESSION['username'] ."" ;?></h2>
      <h2> <a href = "https://docs.google.com/document/d/1ucNKVWTWzM9KLVIH98MHSRL7zxOpMbW_h35ehNuS-4s/edit?ts=5908e678#" target="_blank">Quick Guide</a></h2>
      <h2> <a href = "logout.php"><b>Sign Out</b></a></h2>

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

  $myUsername = explode('@', $_SESSION['username']);
  $q = "SHOW TABLES LIKE '{$myUsername[0]}\$%'";
  // $q = "SHOW TABLES LIKE 'AFJAS'";
  //echo $q;
  $result = mysqli_query($db,$q);
  $flag = 0;
  while(1) 
  {
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
      foreach ($row as $key => $value)
      {
        $valueT = explode('$', $value);
        // echo $row, " ", $value;
        if($flag == 0)
        { 
          echo "<h3>TABLES FOUND:</h3>";
          echo "<div align='center'><table></div>";
          echo "<tr><th>Tables In Mysql</th><th>Delete</th></tr>";
        }

        echo "<tr><td>";
        // echo "<a href='welcome2.php?value='.$value.'>'.$value.'</a>";
        echo "<a style='color:red' href='welcome.php?tn=".$value."'>".$valueT[1]."</a>";
        echo "<td>";
        echo "<a style='color:red' href='delete.php?dt=".$value."'>Delete</a>";
        echo "<td><tr>";

      // echo "<h3><a href='welcome2.php?value=".$value."'>".$value."</a></h3>";

        $flag = 1;
      }
    }
    else 
    {
      if($flag == 0)
      {
        // echo "<div align='center'> <p><h2>NO TABLES FOUND.</h2></p>  </div>";
        echo "<h3>NO TABLES FOUND!</h3>";
        
      }
      else {
        # code...
        echo "</table>";

      }
      break;
    }
    
  }

  
?>

<h1></h1>

<form enctype="multipart/form-data" method="post" action="importcsv.php" >
    <table border="1" align="center">
      <tr >
        <td colspan="2" ><strong>Import CSV file</strong></td>
      </tr>
      <tr>
        <td align="center">CSV File:</td><td><input type="file" name="file" id="file"></td>
      </tr>
      <tr >
        <td colspan="2"><input type="submit" name="submit" value="submit"></td>
      </tr>
    </table>
</form>

<h2>Created by Tharun Raj, Rahul Kumar and Bhanu</h2>