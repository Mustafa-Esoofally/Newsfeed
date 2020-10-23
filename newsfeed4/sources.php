<?php
include("config.php");
// include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsfeed UI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/card.css">
</head>

<?php
if (isset($_COOKIE['Days'])) {
  $days =  $_COOKIE['Days'];
  $curdate = date("Y/m/d");
  $date = date_create($curdate);
  // echo "<br />";
  date_sub($date, date_interval_create_from_date_string("$days days"));
  $olddate = date_format($date, "Y-m-d");
  // echo '<br />';
} else {
  $days = "1";
  $curdate = date("Y/m/d");
  $date = date_create($curdate);
  // echo "<br />";
  date_sub($date, date_interval_create_from_date_string("$days days"));
  $olddate = date_format($date, "Y-m-d");
 
}


?>

<body>

  <ul style="height:200px ;width:200px ;padding-inline-start:1px">
    <?php

    $sql = "SELECT DISTINCT Source , count(*) as Count from newsfeed  where Date between '$olddate'  and '$curdate' GROUP by Source";

    if ($result = mysqli_query($db, $sql)) {
      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
          $string = $row['Source'] . "<span style = 'color:blue;margin-left:7px' span> (" . $row['Count'] . ")</span>";
    ?>

          <li id="keywordx">
            <span class="textbold">

              <span onclick="view_more_source(this.id)" id="<?php echo  $row['Source']; ?>">
                <!--i class="fa fa-folder-open" aria-hidden="true" style="color: #FCD202"></i-->
                <?php echo $string; ?></span>
              <!-- <i class="fa fa-share" aria-hidden="true" style="font-size:18px;margin-left:12px"></i> -->


            </span>
          </li>

    <?php
        }
      }
    } ?>
  </ul>


</body>



</html>

<script type="text/javascript" src="./assets/scripts/functions.js"></script>