<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyWord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="./assets/css/index.css" rel="stylesheet">
</head>

<?php
if (isset($_COOKIE['Days'])) {
  $days =  $_COOKIE['Days'];
  $curdate = date("Y/m/d");
  $date = date_create($curdate);
//   echo "<br />";
  date_sub($date, date_interval_create_from_date_string("$days days"));
  $olddate = date_format($date, "Y-m-d");
  // echo '<br />';
  if ($days != 0) {
    // $sql = "SELECT DISTINCT Source , count(*) as Count from newsfeed  where Date between '$olddate'  and '$curdate' GROUP by Source";
    // $sql = "select * from newsfeed where Date between '$olddate'  and '$curdate' ORDER BY `Date` DESC , `Time` DESC";
  }
  // setcookie("Days", "", time() - 3600);
} else {
  $days = "1";
  $curdate = date("Y/m/d");
  $date = date_create($curdate);
  // echo "<br />";
  date_sub($date, date_interval_create_from_date_string("$days days"));
  $olddate = date_format($date, "Y-m-d");
//   $sql = "SELECT DISTINCT Source , count(*) as Count from newsfeed  GROUP by Source";
  // $sql = "select * from newsfeed where Date between '$olddate'  and '$curdate' ORDER BY `Date` DESC , `Time` DESC  ";
}

?>
<!-- UI -->

<body>
    <!-- Iframe -->
    <ul style="height:300px ;width:200px ;padding-inline-start:2px">
        <!-- <p id="demo"></p> -->

        <?php
        // Fetching all Keywords of the user
        $sql = "select Keywords from user_personalisation where Id=1";

        if ($result = mysqli_query($db, $sql)) {

            if (mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_array($result);

                $tagwords = $row[0];
                // array_reverse($tagwords);
                $tagwords = explode(",", $tagwords);
                // echo "<br />";
            }
        }
        for ($i = 0; $i < count($tagwords); $i++) {

            // $sql = "select * from newsfeed where Title regexp '(^|[[:space:]])$tagwords[$i]([[:space:]]|$)' order by Date Desc";
            $sql = "select * from newsfeed where (Title regexp '(^|[[:space:]])$tagwords[$i]([[:space:]]|$)' ) and (Date between '$olddate'  and '$curdate') order by Date Desc";
            // $sql = "select * from newsfeed where Title like '%%' order by Date Desc";

            if ($result = mysqli_query($db, $sql)) {

                if (mysqli_num_rows($result) > 0) {

                    $TagWordListItem = $tagwords[$i] . " <span style = 'color:blue;margin-left:10px' span>(" . mysqli_num_rows($result) . ")</span>" ;
        ?>
                    <!-- <h4> -->
                    <li id="keyword">
                        <span class="textnormal" style="color: maroon;">

                            <span onclick="view_more(this.id)" id="<?php echo  $tagwords[$i]; ?>">
                                <?php echo $TagWordListItem; ?>

                            </span>


                            <!-- <i class="fa fa-remove" style="font-size:18px;color:red;margin-left:12px" onclick="remove_keyword(this.id)" id="<?php echo  $tagwords[$i]; ?>"></i> -->
                            <!-- <i class="fa fa-share" aria-hidden="true" style="font-size:18px;margin-left:12px"></i> -->


                        </span>
                    </li>



                    <!-- </ul> -->
                    <!-- </h4> -->
        <?php

                }
            }
        } ?>
    </ul>


    <!-- <script> -->

    <!-- // </script> -->
</body>


</html>

<script type="text/javascript" src="./assets/scripts/functions.js"></script>