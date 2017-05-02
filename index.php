<?php
require_once '/var/www/html/google-api-php-client-2.1.1/vendor/autoload.php';
// Get $id_token via HTTPS POST.
if( isset($_POST['tokensignin'])) {
$client = new Google_Client(['client_id' => $CLIENT_ID]);
$payload = $client->verifyIdToken($id_token);
if ($payload) {
  $userid = $payload['sub'];
  echo $userid;
  // If request specified a G Suite domain:
  //$domain = $payload['hd'];
} else {
  // Invalid ID token
}
}
/*
$servername = "localhost";
$username = "root";
$password = "";

//$username =$post['username'];

// Create connection
mysql_connect("$servername", "$username", "$password");
mysql_select_db("testdb");
*/
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'samantha');
   define('DB_DATABASE', 'testdb');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    session_start();
   /*
   $tbl_name="login"; 
   $conn=mysqli_connect("localhost","root","samantha","");
   mysql_select_db("testdb")or die ("cannot select DB");

   $username =$_POST['username'];
   $password =$_POST['password'];
   $username = stripcslashes($username);
   $password = stripcslashes($password); 
   $username = mysql_real_escape_string($username);
   $password = mysql_real_escape_string($password); 
   
   
*/
   if( isset($_POST['btn-login'])) {
      /*
      $sql ="SELECT * FROM $tbl_name WHERE username = '$username' AND password = '$password'";
      $result=mysql_query($sql,$conn);
      $count=mysql_num_rows($result);
      if($count>0)
      {
        echo "Login Success!!";
      }
      else
      {
        echo "Authentication Failure!!";
      }
      */
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      $sql = "SELECT * FROM login WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
       session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $myusername;
         header("location: welcome.php");
         exit();
      }else {
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Username or Password was incorrect!');\n";
        echo "window.location='index.php'";
        echo "</script>";
         
      }
  }
/*SIGN-UP*/
  if( isset($_POST['btn-signup'])) {

      $myfirstname = mysqli_real_escape_string($db,$_POST['firstname']);
      $mylastname = mysqli_real_escape_string($db,$_POST['lastname']); 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM login WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count !=0) {
          $error = true;
          $emailError = "Provided Email is already in use.";
          echo "<script language=\"JavaScript\">\n";
          echo "alert('Provided Email is already in use. Press OK to login');\n";
           echo "window.location='index.php'";
          echo "</script>";
          exit();

      }
      if( !$error ) {

           $sql = "INSERT INTO login VALUES ('$myfirstname ','$mylastname ','$myusername','$mypassword')";
           $result = mysqli_query($db,$sql);
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];
            
            $count = mysqli_num_rows($result);
            
           if ($result==1) {
              $errTyp = "success";
              $errMSG = "Successfully registered, you may login now";
              header("location: register.php");
              unset($name);
              unset($email);
              unset($pass);
           } else {
              $errTyp = "danger";
              $errMSG = "Something went wrong, try again later..."; 
           } 
        
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
      
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="login">  
	
          <h1>Mtech Admission System</h1>
          
          <form action="" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="username" required autocomplete="on"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>

          </div>
          
          <p class="forgot"><a href="/pwdrecovery.php">Forgot Password?</a></p>
          
          <button class="button button-block" name ="btn-login"/>Log In</button>
         
          	  <h2></h2>
          	  <h1>or Log In using</h1>
                    <div class="g-signin2" data-onsuccess="onSignIn" align="center"></div>
         <script>
          function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());

            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
            console.log("ID Token: " + id_token);
                  var xhr = new XMLHttpRequest();
            xhr.open('POST', 'tokensignin');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
              console.log('Signed in as: ' + xhr.responseText);
            };
            xhr.send('idtoken=' + id_token);
            };
         </script>           
	   
          </form>

        </div>
        
        <div id="signup">   
          <h1>Create Account</h1>
          
          <form action="" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="firstname" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="lastname" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="username" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="password"  required autocomplete="off"/>
          </div>
          
          <button type="submit" name="btn-signup" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
