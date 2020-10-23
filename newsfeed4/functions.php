<?php include("config.php"); ?>

<?php
// bookmark function
// if (isset($_COOKIE['bookmarked'])) {
//     $bookmarked = $_COOKIE['bookmarked'];
//     echo $bookmarked;
// }
// removed keyword
// if (isset($_COOKIE['Removedkeyword'])) {
//     $Removedkeyword = $_COOKIE['Removedkeyword'];
//     echo $Removedkeyword;
// }

if (isset($_COOKIE['bookmarked'])) {
    $sql = "SELECT Bookmarked FROM `user_personalisation`";

    // BOOKMARK 
    if ($result = mysqli_query($db, $sql)) {

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);
            $allbookmarks = $row[0];

            // var_dump($allbookmarks);
            // $removespaces = str_replace(" ,"," ",$allbookmarks);
            // var_dump($removespaces);
            // $sql = "UPDATE user_personalisation SET Bookmarked = '$removespaces' WHERE id = 1";        // $bookmarked = explode(",", $bookmarked);
            $bookmarked = $_COOKIE['bookmarked'];
            if (strpos($allbookmarks, $bookmarked) == false) {

                $updateQuery = "UPDATE user_personalisation SET Bookmarked = CONCAT(Bookmarked, ',$bookmarked') WHERE id = 1";
            } else {

                $updateQuery = "UPDATE user_personalisation SET Bookmarked =  replace(Bookmarked , ',$bookmarked', ' ') WHERE (Bookmarked like '%$bookmarked%' ) and (Id=1)";
            }
        }
        mysqli_query($db, $updateQuery);
        setcookie("bookmarked", "", time() - 3600);
    }
}

// KEYWORD ADD
if (isset($_COOKIE['keyword'])) {
    $keyword = $_COOKIE['keyword'];
    $updateQuery = "UPDATE user_personalisation SET Keywords = CONCAT(Keywords, ',$keyword') WHERE id = 1";
    mysqli_query($db, $updateQuery);
    setcookie("keyword", "", time() - 3600);
}


$sql = "SELECT Keywords FROM `user_personalisation`";

if ($result = mysqli_query($db, $sql)) {

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        $allbookmarks = $row[0];
        $allbookmarks = explode(",", $allbookmarks);
        $allbookmarks = array_unique($allbookmarks);
        sort($allbookmarks);
        // var_dump($allbookmarks);
        $allbookmarks = implode(",", $allbookmarks);
        var_dump($allbookmarks);
        $updateQuery = "UPDATE user_personalisation SET Keywords = '{$allbookmarks}'";
        mysqli_query($db, $updateQuery);
    }
}




?>