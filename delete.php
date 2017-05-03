<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
} else {
    echo "<script language=\"JavaScript\">\n";
        echo "alert('Please log in first to see this page');\n";
        echo "window.location='index.php'";
        echo "</script>";
}

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'samantha');
    define('DB_DATABASE', 'mtech_list');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if(!empty($_GET['dt']))
    {
       $dt = filter_input(INPUT_GET, 'dt', FILTER_SANITIZE_STRING);
       $dropIfExists = "DROP TABLE IF EXISTS `{$dt}`";
       mysqli_query($db,$dropIfExists);
    }
    header("location:home.php");

?>

