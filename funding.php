
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
include("navbar.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="mockup.css"> -->
  <!-- <title>Document</title> -->
  <!-- <title>Newsfeed</title>
-->
<title>Funding Alert</title>

</head>

<body>

  <ul>
    <?php
  $funding = array('funding', 'Funding', 'fund', 'raise', 'raises', 'invest', 'invested', 'capital');


// include("navbar.php");   

for($i=0;$i<count($funding);$i++)
{
$hello = $funding[$i];
  $sql = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$hello([[:space:]]|$)'  limit 6";
  if ($result = mysqli_query($db, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      
      
      while ($row = mysqli_fetch_array($result)) {
        ?>
                <h4>
                  <li id="demo">
                    
                    <span id="title"><?php echo $row['Title'] ?></span>
                    
                    <span id="datetime"> <?php echo $row['DateTime'] ?></span>
                    <a id="readmore" href="<?php echo $row['Link']; ?>">Read.. </a>
                  </li>
                </h4>
                
                <?php 
    }
  }
}
}?>

</ul>     
</body>