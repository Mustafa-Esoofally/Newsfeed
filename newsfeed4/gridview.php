<?php
include("config.php");
include("sql.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css">
-->
    <link rel="stylesheet" href="assets/css/card.css">
    <link rel="stylesheet" href="assets/css/UI.css">

    <title>Newsfeed UI</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./assets/scripts/functions.js"></script>

</head>
<!-- $sql comes from sql.php -->

<body>

    <!-- <ul style="margin-left: 300px ; height:1000px"> -->
    <ul style="    margin-left: 247px;height: 1000px;margin-top:-45px">
        <?php
        // $count=0;
        // $sql = "SELECT  * from newsfeed order by Date desc limit 100";
        if ($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<span>Showing " . mysqli_num_rows($result) . " Results ";
                // echo "<br />";

                // echo "<br />";
                if (isset($_COOKIE['search'])) {
                    // echo "<br />";
                    echo "for " . $_COOKIE['search'];
                    // echo "<br />";
                } else if (isset($_COOKIE['selectedkeyword'])) {
                    echo "for " . $_COOKIE['selectedkeyword'];
                    // echo "<br />";
                } else if (isset($_COOKIE['selectedsource'])) {
                    echo "for ". $_COOKIE['selectedsource'];
                    // echo "<br />";
                }
                echo "   From " . $curdate . "  To  " . date_format($date, "Y-m-d") . "</span>";
                // echo date('M-Y', date_format($date, "Y-m-d"));
                while ($row = mysqli_fetch_array($result)) {

                    date_default_timezone_set('Asia/Kolkata');
                    $datetime = $row['Date'] . $row['Time'];
                    $seconds_ago = (time() - strtotime($datetime));
                    if ($seconds_ago >= 31536000) {
                        $datestring = "Posted " . intval($seconds_ago / 31536000) . " years ago";
                    } elseif ($seconds_ago >= 2419200) {
                        $datestring = "Posted " . intval($seconds_ago / 2419200) . " months ago";
                    } elseif ($seconds_ago >= 86400) {
                        $datestring = "Posted " . intval($seconds_ago / 86400) . " days ago";
                    } elseif ($seconds_ago >= 3600) {
                        $datestring = "Posted " . intval($seconds_ago / 3600) . " hours ago";
                    } elseif ($seconds_ago >= 60) {
                        $datestring = "Posted " . intval($seconds_ago / 60) . " minutes ago";
                    } else {
                        $datestring = "Posted less than a minute ago";
                    }

                    
        ?>

                    <div class="card">

                        <div class="card-header">
                            <ul id="category-tabs" style="margin-left: -50px;">
                                <!-- <button> -->
                                <span>

                                    <?php if (substr_count($bookmarked, $row['Id']) == 0) { ?>

                                        <i class="fa fa-star-o" onclick="reply_click(this.id)" id="<?php echo $row['Id']; ?>"> </i>
                                    <?php } else { ?>
                                        <i class="fa fa-star fa-1x" onclick="reply_click(this.id)" id="<?php echo $row['Id']; ?>" style="color: #FCD202"> </i>

                                    <?php } ?>

                                </span>
                                <!-- </button> -->
                                <span class="textbold title" onclick="clickedarticle(this.id)" id="<?php echo $row['Link']; ?>">
                                    <?php echo $row['Title'] ?>

                                </span>
                                <span class="textgray title"> <?php echo $datestring; ?></span>
                            </ul>

                        </div>

                        <div class="card-body" style="padding: 0.5rem">
                            <blockquote class="blockquote mb-0">

                                <span id="xx" class="textnormal"> <?php echo $row['Description'] . ".."; ?></span>


                                <!--footer class=""><cite title="Source Title"><?php echo $row['Date'] . " " . $row['Source'] ?></cite></footer-->
                            </blockquote>
                        </div>
                    </div>

        <?php
                    // $count++;
                }
            }
        } ?>

    </ul>


</body>

</html>