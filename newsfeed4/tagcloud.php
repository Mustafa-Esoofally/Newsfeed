<?php
// config file
include("config.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN  -->
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-tag-cloud.min.js"></script>
    <script src="cookiefunctions.js"></script>

    <title>TagCloud</title>

</head>


<body>
    <!-- <ul style="margin-left: 300px ; height:1000px"> -->
    <div id="container" style="width: 1070px; height: 550px; margin-left: 270px"></div>
    <!-- </ul> -->
</body>
<script>
    // empty array for forming the tag cloue
    var Data = [];

    <?php
    // query to get all words 
    $Query = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(newsfeed.title, ' ', numbers.n), ' ', -1) Title FROM (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers INNER JOIN newsfeed ON CHAR_LENGTH(newsfeed.Description) -CHAR_LENGTH(REPLACE(newsfeed.Description, ' ', ''))>=numbers.n-1 order by Id desc limit 100 ";
    $Fullwordarray = array();

    if ($Result = mysqli_query($db, $Query)) {

        if (mysqli_num_rows($Result) > 0) {
            while ($Row = mysqli_fetch_array($Result)) {

                array_push($Fullwordarray, strtolower($Row[0]));
            }
        }
    }

    $StopWordList = file("stopwords.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    $Filteredwordarray = array_diff($Fullwordarray, $StopWordList);

    ?>

    <?php for ($l = 0; $l < count($Filteredwordarray); $l++) : ?>

        <?php

        $Singleword = $Filteredwordarray[$l];
        // strip html tags
        strip_tags($Singleword);

        $Word = strtolower($RemoveSpecialChars); //remove special characters 

        $RemoveSpecialChars = preg_replace('/[^a-zA-Z0-9_.]/', '', $Singleword);

        //wordcount is count of the tagcloud word


        $Sql = "SELECT count(*) AS total FROM newsfeed WHERE Title regexp '(^|[[:space:]])$Word([[:space:]]|$)' ";
        $ResultSet = mysqli_query($db, $Sql);
        if ($Result) {

            $DataJSON = mysqli_fetch_assoc($ResultSet);
        }

        ?>
        var TagCloudWord = <?php echo json_encode($Word); ?>

        <?php if ($DataJSON['total'] < 20) : ?>
            var obj = {
                x: <?php echo " TagCloudWord"; ?>,
                value: <?php echo $DataJSON['total']; ?>
            };
        <?php endif; ?>

        Data.push(obj);


    <?php endfor; ?>

    jsonObject = Data.map(JSON.stringify);

    console.log(jsonObject);

    uniqueSet = new Set(jsonObject);
    uniqueArray = Array.from(uniqueSet).map(JSON.parse);

    console.log(uniqueArray);
    data = uniqueArray;


    chart = anychart.tagCloud(data);
    chart.container("container");

    chart.angles([0]);

    chart.listen("chartDraw", function() {
        chart.title("Tagcloud");
    });
    chart.mode("spiral");
    // set text spacing
    chart.textSpacing(5);

    chart.listen("pointClick", function(e) {

        tag_searches = [];
        var fired_button = e.point.get("x");
        console.log(fired_button);

        // open clicked word
        // var url1 = ".php";
        // window.open(url1);
        window.top.location.reload();
        // set cookie
        document.cookie = "search=" + fired_button;
        "path=/";
    });

    chart.draw();
</script>

</html>