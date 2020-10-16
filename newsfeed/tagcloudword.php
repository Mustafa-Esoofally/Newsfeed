<?php
// config file
include("config.php");
// default navbar
include("navbar.php");

// cookie
$cookie_name = "word";

if (!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    $tagword = $_COOKIE[$cookie_name];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="cookiefunctions.js"></script>
    <script src="highlightword.js"></script>

    <title>TagCloud Word</title>

</head>


<body>
    <ul>
        <?php
        // $sql3 = "SELECT  * from newsfeed order by Id desc limit 100";
        $sql = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$tagword([[:space:]]|$)' ORDER BY Id desc";

        if ($result3 = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result3) > 0) {

                while ($row3 = mysqli_fetch_array($result3)) {
        ?>

                    <h4>
                        <li id="demo">
                            <span id="title"><?php echo $row3['Title'] ?></span>
                            <span id="datetime"> <?php echo $row3['Date'] ?></span>
                            <span id="datetime"> <?php echo $row3['Time'] ?></span>
                            <a id="readmore" href="<?php echo $row3['Link']; ?>" target="_blank">Read.. </a>
                        </li>
                    </h4>
        <?php
                }
            }
        } ?>
    </ul>



    <script>
        var word = <?php echo json_encode($tagword); ?>;
        // highlightWord(document.body.toLowerCase(), word);
        highlightWord(document.body, word);

        <?php $tagword = ucwords($tagword); ?>
        var word = <?php echo json_encode($tagword); ?>;
        highlightWord(document.body, word);
        document.getElementById("textboxSearch").value = word;

        <?php $tagword = lcfirst($tagword); ?>
        var word = <?php echo json_encode($search); ?>;
        console.log(word);
        highlightWord(document.body, word);

        document.getElementById("textboxSearch").value = word;
    </script>

    </script>


    <script>
        cname = "searchword";
        var x = JSON.parse(getCookie(cname));
        var y = getCookie("word");
        x.push(y);
        var z = JSON.stringify(x);
        console.log(x);
        // document.cookie = "searchword=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        setCookie(cname, z, 1);
    </script>


    <style>
        .highlighted {
            background: yellow;
        }
    </style>

</body>

</html>