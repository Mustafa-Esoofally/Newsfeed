<?php include("config.php"); ?>
<?php
//BOOKMARKING
$sql = "SELECT Bookmarked FROM `user_personalisation`";

if ($result = mysqli_query($db, $sql)) {

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);
        // echo "<br />";
        $bookmarked = $row[0];
        // echo "<br />";
        // $arraybookmarked = explode(",", $bookmarked);
        // print_r($arraybookmarked);
    }
}

if (isset($_COOKIE['Days'])) {
    $days =  $_COOKIE['Days'];
    $curdate = date("Y/m/d");
    $date = date_create($curdate);
    echo "<br />";
    date_sub($date, date_interval_create_from_date_string("$days days"));
    $olddate = date_format($date, "Y-m-d");
    echo '<br />';
    if ($days != 0) {

        $sql = "select * from newsfeed where Date between '$olddate'  and '$curdate' ORDER BY `Date` DESC , `Time` DESC";
    } else {

        $sql = "select * from newsfeed where Date between '$olddate'  and '$curdate' ORDER BY `Date` DESC , `Time` DESC  ";
    }
    // setcookie("Days", "", time() - 3600);
} else {
    // else {
    $days = "1";
    $curdate = date("Y/m/d");
    $date = date_create($curdate);
    // echo "<br />";
    date_sub($date, date_interval_create_from_date_string("$days days"));
    $olddate = date_format($date, "Y-m-d");

    //   }
}

//KEYWORD 
if (isset($_COOKIE['selectedkeyword'])) {

    $selectedkeyword = $_COOKIE['selectedkeyword'];
    echo $selectedkeyword;
    $sql = "select * from newsfeed where (Title regexp '(^|[[:space:]])$selectedkeyword([[:space:]]|$)') and (Date between '$olddate'  and '$curdate') ORDER BY `Date` DESC , `Time` DESC ";
    setcookie("selectedkeyword", "", time() - 3600);
}
//SOURCE
else if (isset($_COOKIE['selectedsource'])) {

    // echo $selectedsource;
    $selectedsource = $_COOKIE['selectedsource'];
    echo $selectedsource;
    $sql = "select * from newsfeed where (Source regexp '(^|[[:space:]])$selectedsource([[:space:]]|$)' ) and (Date between '$olddate'  and '$curdate') ORDER BY `Date` DESC , `Time` DESC ";
    setcookie("selectedsource", "", time() - 3600);
}
//DAYS

// SEARCH
else if (isset($_COOKIE['search'])) {
    $search = $_COOKIE['search'];
    // echo "<p>".$search."</p>";
    $sql = "select * from newsfeed where Title regexp '(^|[[:space:]])$search([[:space:]]|$)' ORDER BY `Date` DESC , `Time` DESC ";
    setcookie("search", "", time() - 3600);
}

// STARRED
else if (isset($_COOKIE['starred'])) {
    //BOOKMARKING
    $sql = "SELECT Bookmarked FROM `user_personalisation`";

    if ($result = mysqli_query($db, $sql)) {

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);
            // echo "<br />";
            $bookmarked = $row[0];
            // echo "<br />";
            // $arraybookmarked = explode(",", $bookmarked);
            // print_r($arraybookmarked);
        }
    }
    $sql = "select * from newsfeed where Id IN ($bookmarked)";
    setcookie("starred", "", time() - 3600);
} else {
    $sql = "select * from newsfeed ORDER BY `Date` DESC , `Time` DESC ";
    // setcookie("Days", "", time() - 3600);

}

?>