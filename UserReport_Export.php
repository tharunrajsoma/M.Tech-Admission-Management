<?php
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
   $d='N';
   $sql;
   $cnstr='N';
   $v='0000-00-00';
   $coln = array("APPLICATION NUMBER","NAME","BIRTH CATEGORY","DISABLE STATUS", "REGISTERED EMAIL ID", "PERCENTAGE OF MARKS$1", "PERCENTAGE OF GP$1",  "GATE SCORE", "GATE AIR", "VALID UPTO", "PROGRAM TYPE$1","PRIORITY$2","PROGRAM TYPE$2","PRIORITY$3", "PROGRAM TYPE", "PRIORITY$1", "GENDER", "MARITAL STATUS","DATE OF BIRTH","PLACE OF BIRTH","FATHER NAME","DISABLE DESCRIPTION","MOBILE NUMBER","DEGREE TYPE NAME$1","DEGREE NAME$1","INSTITUTE NAME$1","UNIVERSITY$1","SPECILIZATION$1","DIVISION$1","YEAR OF PASS$1","SECURED MARKS$1","TOTAL MARKS$1","SECURED GP$1","TOTAL GP$1","EXPERIENCE TYPE NAME","ORGANIZATION NAME","DESIGNITION","NATURE OF WORK","FROM DATE","TO DATE"," DURATION");
   //  ENTRY EXAM NAME REGISTRATION NUMBER EXAM YEAR SPECILAZATION DESCRIPTION PRIORITY  PROGRAM TYPE PRIORITY1  PRIORITY2 PROGRAM TYPE$2 PRIORITY3 REFERENCE TYPE NAME AMOUNT
    if(!empty($_GET['tn']))
    {
       $tn = filter_input(INPUT_GET, 'tn', FILTER_SANITIZE_STRING);
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
    if(!empty($_GET['d']))
    {
       $d = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);

    }
    if(($_GET['v'])!=NULL)
    {
       $v = filter_input(INPUT_GET, 'v', FILTER_SANITIZE_STRING);

    }
    if($_GET['cnstr']!=NULL)
    {
       $cnstr = filter_input(INPUT_GET, 'cnstr', FILTER_SANITIZE_STRING);

    }
  if($p1=='NULL')
  {
    if($p2=='NULL')
   {
      if($p0=='NULL')
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";
    
      }
      else
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }
   }
   else
   {
      if($p0=='NULL')
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }
      else
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }

   }
 }
 else
 {
   if($p2=='NULL')
   {
      if($p0=='NULL')
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'"; 

      }
      else
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }
   }
   else
   {
      if($p0=='NULL')
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }
      else
      {
        $sql2 = "SELECT * FROM `$tn` where `GATE SCORE` > $score1 and `GATE SCORE` < $score2 and `PROGRAM TYPE$1`='$p1' and `PROGRAM TYPE$2`='$p2' and `PROGRAM TYPE`='$p0' and `DISABLE STATUS`!='$d' and `VALID UPTO`>'$v'";

      }

   }

 }


$result= mysqli_query($db,$sql2);

header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=data.csv');  
$output = fopen("php://output", "w"); 
  
//Suppose you have stored data in a table called "users", where the 5 fields are user_id, first_name, last_name, age and email.
if($cnstr=='N')
{
 fputcsv($output,array('APPLICATION NUMBER','NAME','BIRTH CATEGORY','DISABLE STATUS','PERCENTAGE OF MARKS$1','PERCENTAGE OF GP$1','VALID UPTO','GATE SCORE','GATE AIR','PROGRAM TYPE$1','PROGRAM TYPE$2'));
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
   fputcsv($output, array($row['APPLICATION NUMBER'],$row['NAME'], $row['BIRTH CATEGORY'] , $row['DISABLE STATUS'],$row['PERCENTAGE OF MARKS$1'] , $row['PERCENTAGE OF GP$1'] , $row['VALID UPTO'],$row['GATE SCORE'],$row['GATE AIR'], $row['PROGRAM TYPE$1'],$row['PROGRAM TYPE$2'])); 
    }
}
else
{
  $selcolnames = explode(",", $cnstr);
  if($selcolnames[0]=='0')
  {
    $arrayName = array();
    foreach ($coln as $id) {
      array_push($arrayName,$id);
    }
    fputcsv($output, $arrayName);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
      $arrayName = array();
      foreach ($coln as $id) {
          array_push($arrayName,$row[$id]);

       }
       fputcsv($output, $arrayName);
    }
  }
   else
   {
    $arrayName = array();
      foreach ($selcolnames as $id) 
      {
        $var=$coln[$id-1];
        echo $var."\t";
        array_push($arrayName,$var);

      }
      fputcsv($output, $arrayName);
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
        $arrayName = array();
        foreach ($selcolnames as $id) 
        {
            $var=$coln[$id-1];
            array_push($arrayName,$row[$var]);
         }
        fputcsv($output, $arrayName);
      }
   }

}
fclose($output);

?>