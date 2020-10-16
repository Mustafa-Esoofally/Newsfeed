<?php
include("config.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsfeed UI</title>
</head>

<body>

  <ul>
    <?php

    $sql = "SELECT  * from newsfeed order by Id desc limit 100";
    if ($result = mysqli_query($db, $sql)) {
      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
    ?>

          <h4>
            <li id="demo">
              <span id="title"><?php echo $row['Title'] ?></span>
              <span id="datetime"> <?php echo $row['Date'] ?></span>
              <span id="datetime"> <?php echo $row['Time'] ?></span>
              <a id="readmore" href="<?php echo $row['Link']; ?>" target="_blank">Read.. </a>
            </li>
          </h4>
    <?php
        }
      }
    } ?>
  </ul>


</body>



</html>

