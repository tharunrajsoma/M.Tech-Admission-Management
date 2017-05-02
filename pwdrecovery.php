<?php

  define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'samantha');
   define('DB_DATABASE', 'testdb');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   include "/home/tnehme/public_html/smtpmail/classes/class.phpmailer.php";
   require_once('connect.php');
   if( isset($_POST['btn-submit'])) {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);

      $sql = "SELECT * FROM login WHERE username = '$myusername' ";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
if($count == 1){
    //$r = mysqli_fetch_assoc($res);
    //$password = $row['password'];
    //$to = $row['username'];
    //$subject = "Your Recovered Password";
 $mail = new PHPMailer;


 
  }else{
    echo "User name does not exist in database";
  }





   }

?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>

  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="542471378217-6r8r47rrkmmt9kq01jea3vnagigfgfv2.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  
 
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {

  background: url("IITH.jpg") 10% fixed;
  background-size: cover;
}
</style>

  
</head>

<body> 
	
      <div class="form">
        <h1>Forgot Password</h1>
         <form action="" method="post">
          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="username" required autocomplete="on"/>
          </div>
           <button class="button button-block" name ="btn-submit"/>Submit</button>

         </form>


    </div>
          
     <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>