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

// cookie
$cookie_name = "word";


if (!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    $x = $_COOKIE[$cookie_name];
    // echo "Cookie '" . $cookie_name . "' is set!<br>";
    // echo $x;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="mockup.css"> -->
    <!-- <title>Document</title> -->
    <title>TagCloud Word</title>

</head>

<body>

    <ul>
        <?php
        // $sql3 = "SELECT  * from newsfeed order by Id desc limit 100";
        $sql = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$x([[:space:]]|$)' ORDER BY Id desc";

        if ($result3 = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result3) > 0) {

                while ($row3 = mysqli_fetch_array($result3)) {
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
        } ?>
    </ul>


</body>



</html>