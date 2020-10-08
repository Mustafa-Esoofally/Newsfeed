<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
//XAMPP
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


$contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false
    )
); // 

session_start();        //database connection
$db = mysqli_connect('localhost', 'root', '', 'newsfeed');


if ($db === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());



$cookie1_name ="source"; //selected source from dropdown

if(!isset($_COOKIE[$cookie1_name])) {
    echo "Cookie named '" . $cookie1_name . "' is not set!";
} else {
    // echo "Cookie '" . $cookie1_name . "' is set!<br>";
    $y=$_COOKIE[$cookie1_name];
}

}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>News Grabber</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<?php
// Attempt select query execution
$sql = "SELECT * FROM newsfeed ORDER BY Id desc limit 10";
?>

<body>

    <nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-dark" style="height :80px">
        <a class="navbar-brand" href="#" style="margin-right :85px">News Grabber</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <!-- <li class="nav-item active" style="margin-right :95px">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li> -->

                 <li class="nav-item">
                    <a class="nav-link" href="Funding.php" style="margin-right :95px">Funding Alert</a>
                </li>

                <li class="nav-item dropdown" style="margin-right :35px">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sources
                    </a>
                    <div class="dropdown-menu" id="selectsource" aria-labelledby="navbarDropdown">
                        <?php
                        $sql1 = "SELECT DISTINCT Source FROM newsfeed";
                        // $i = 0;
                        if ($result = mysqli_query($db, $sql1)) {

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {

                                    // echo '<a class="dropdown-item" value=" '.$row['Source'].'" onclick="f1()">' . $row["Source"] . '</a>';
                                    echo '<a class="dropdown-item">' . $row["Source"] . '</a>';
                                }
                            }
                        }

                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tagcloudtest.php">Tagcloud</a>
                </li>

            </ul>
            <!-- Search: <input type="search" id="mySearch" value="Food"> -->
            <div class="searchbar">
                <input class="search_input" type="text" name="" placeholder="Search...">
                <a href="" class="search_icon"><i class="fas fa-search"></i></a>

            </div>
        </div>
    </nav>

    </div>

</body>

</html>
<?php
//sql2 skipped

// $sql4 = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$y([[:space:]]|$)' ORDER BY Id desc";
$sql3 = "SELECT * FROM newsfeed order by Id desc limit 100";


if ($result3 = mysqli_query($db, $sql3)) {
    if (mysqli_num_rows($result3) > 0) {

        while ($row3 = mysqli_fetch_array($result3)) {

            echo '<div class="container my-0 mx-0" >';

            echo '<div class="table-responsive"> <table class="table">';



            echo ' <tbody>';
            echo '<tr class="accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="# ' . $row3['Id'] . ' ">';

            echo '<td class="expand-button"></td>';

            echo '<td style="font-size:23px" >' . $row3["Title"] . '</td>';

            echo '</tr>
<tr class="hide-table">

<td colspan="4" style="padding: 4px">';
            echo '<div id=" ' . $row3['Id'] . ' " class="collapse in p-3">';
            echo $row3['Description'];
            echo "<br>";
            echo "<br>";

            echo '<a style ="margin-left :600px margin-top :20px ">' . $row3["Source"] . '</a>';
            echo "<br>";
            echo $row3["DateTime"];
            echo '<a class="btn btn-primary" href=" ' . $row3['Link'] . ' " role="button" style ="margin-left:800px">Read More</a>';

            // <div class="accordion" id="accordionExample">
            // <div class="card">
            //   <div class="card-header" id="headingOne">
            //     <h2 class="mb-0">
            //       <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            //         Collapsible Group Item #1
            //       </button>
            //     </h2>
            //   </div>
            echo '
    </tbody>
  </table>
</div>
    
      </div>';

            // Free result set

        }
        mysqli_free_result($result3);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
}

// Close connection
mysqli_close($db);


?>

<script>
    $(document).ready(function() {
        $(".dropdown-menu a").click(function() {
            var sel = $(this).text();
            alert(sel);
            
            console.log(sel);
            document.cookie = "source=" + sel;
            "path=index1.php";
            // var x = document.cookie;
            // console.log(x);
        });
    });
