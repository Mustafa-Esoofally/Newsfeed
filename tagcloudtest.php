<?php
//XAMPP
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false
    )
);

session_start();        //database connection
$db = mysqli_connect('localhost', 'root', '', 'newsfeed');
?>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-tag-cloud.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.11.0/underscore-min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/underscore@1.11.0/underscore-min.js"></script> -->

<body>
    <div id="container" style="width: 1200px; height: 600px;"></div>
</body>

<script>
    var data = [];
    // var data1 = [];

    <?php
    $query = "SELECT Id ,SUBSTRING_INDEX(SUBSTRING_INDEX(newsfeed.title, ' ', numbers.n), ' ', -1) Title FROM (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers INNER JOIN newsfeed ON CHAR_LENGTH(newsfeed.Description) -CHAR_LENGTH(REPLACE(newsfeed.Description, ' ', ''))>=numbers.n-1 order by Id desc limit 500 ";

    $result = mysqli_query($db, $query);
    $words1 = mysqli_fetch_all($result); //words is  array to be inserted 
    $remove = array("no", "and", "startups", "a", "the", "for", "only", "start-up", "to", "this", "reasons", "away", "in", "startup", "you", "new", "your", "why ", "cuts", "can", "what", "out", "on", "and", "at", "in", "they", "its", "is", "an", "from", "will", "uses", "with", "by", "who", "on", "By", "news", "how", "of", "ok", "in",  "that", "are", "Its", "tech","2020","us", "company", "alert", "more" ,"up" , "as", "you" ,"[funding" ,"from");
    ?>

    <?php for ($l = 0; $l < count($words1); $l++) : ?>
        <?php
        $hello10 = $words1[$l][1];
        
        strip_tags($hello10);
        
        $hello1 = strtolower($hello10);


        for ($j = 0; $j < count($remove); $j++) {
            $hello7 =  strtolower($remove[$j]);

            if ($hello1 == $hello7) {
                // echo "duplicate";
                array_splice($words1, $l, 1);
                

            }
        }

        $words2 = array_values($words1); //remove array words removed 

        $hello12 = $words2[$l][1];
        strip_tags($hello12);
        $string = preg_replace('/[^a-zA-Z0-9_.]/', '', $hello12);
        // $hello = strtolower($words2[$l][1]); //hello is the tagcloud word
        //hello is the tagcloud word
        $hello = strtolower($string); //remove special characters 

        $sql1 = "SELECT count(*) AS total FROM newsfeed WHERE Title regexp '(^|[[:space:]])$hello([[:space:]]|$)' ";
        $result1 = mysqli_query($db, $sql1);
        if ($result1) {

            $data1 = mysqli_fetch_assoc($result1);
        }

        ?>
        var passedArray = <?php echo json_encode($hello); ?>

        <?php if ($data1['total'] < 20) : ?>
            var obj = {
                x: <?php echo "passedArray"; ?>,
                value: <?php echo $data1['total']; ?>
            };
        <?php endif; ?>
       
        data.push(obj);

       
    <?php endfor; ?>

    // _.uniq(data, false, function (item) { return data.x; })
    jsonObject = data.map(JSON.stringify); 
      
            // console.log(jsonObject); 
      
            uniqueSet = new Set(jsonObject); 
            uniqueArray = Array.from(uniqueSet).map(JSON.parse); 
      
            console.log(uniqueArray); 
            data = uniqueArray;

    var keyCount  = Object.keys(data).length;
            console.log(keyCount); 

    // data = this.data.filter((obj, pos, arr) => {
    //         return arr.map(mapObj =>
    //             mapObj.name).indexOf(obj.name) == pos;
    //         });
    //         console.log(data);
            
    chart = anychart.tagCloud(data);
    chart.container("container");;
    chart.angles([0]);
    chart.listen("chartDraw", function() {
        chart.title("Tagcloud");
    });
    chart.mode("spiral");
// set text spacing
chart.textSpacing(5);

    chart.draw();
    chart.listen("pointClick", function(e) {
        var fired_button = e.point.get("x");
        console.log(fired_button);
        var url1 = "tp.php";
        window.open(url1);
        // return fired_button;
        document.cookie = "word=" + fired_button;
        "path=tp.php";

    });
</script>