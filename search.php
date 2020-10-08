<?php
include("navbar.php");

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
// include("tp1.php");

$search = $_POST['search'];
?>

<ul>
  <?php
  $sql = "select * from newsfeed where Title like '%$search%'";

  if ($result = mysqli_query($db, $sql)) {

    if (mysqli_num_rows($result) > 0) {
      while ($row3 = mysqli_fetch_array($result)) {
  ?>

        <h4>
          <li id="demo">
            <span id="title"><?php echo $row3['Title'] ?></span>
            <span id="datetime"> <?php echo $row3['DateTime'] ?></span>
            <a id="readmore" href="<?php echo $row3['Link']; ?>">Read.. </a>
          </li>
        </h4>
  <?php
      }
    }
  }
  ?>
</ul>