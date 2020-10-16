<script src="cookiefunctions.js"></script>
<script src="highlightword.js"></script>

<?php

include("config.php");
include("navbar.php");

?>

<body>
    <ul>
        <?php

        // echo strlen($_COOKIE['Searchword']); 
        $Searchword =  strlen($_COOKIE['Searchword']);
        // echo "<br />";
        $searchword =  strlen($_COOKIE['searchword']);

        if ($Searchword > $searchword) {
            // $search = $Searchword;
            $search = (end(json_decode($_COOKIE['Searchword'])));
        } else {

            $search = (end(json_decode($_COOKIE['searchword'])));
        }

        echo "<br />";

        $sql = "select * from newsfeed where Title like '%$search%' ";

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
        }
        ?>
    </ul>

    <script>
        // Using both uppercase and lower case
        var word = <?php echo json_encode($search); ?>;
        console.log(word);
        highlightWord(document.body, word);

        <?php $search = ucwords($search); ?>
        var word = <?php echo json_encode($search); ?>;
        console.log(word);
        highlightWord(document.body, word);

        <?php $search = lcfirst($search); ?>
        var word = <?php echo json_encode($search); ?>;
        console.log(word);
        highlightWord(document.body, word);


        
            document.getElementById("textboxSearch").value = word;
        
    </script>
</body>

<style>
    .highlighted {
        background: yellow
    }
</style>