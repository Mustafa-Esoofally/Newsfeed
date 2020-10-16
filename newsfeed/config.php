<?php

//XAMPP
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


$contextOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false
  )
); // 

session_start();        //database connection
$db = mysqli_connect('localhost', 'root', '', 'newsfeed');


if ($db === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
// include("navbar.php");

?>