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


if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$funding = array( 'funding','Funding','fund','raise','raises','invest','invested','capital');

for($i=0;$i<count($funding);$i++)
{
    $hello = $funding[$i];
    // Attempt select query execution
    $sql = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$hello([[:space:]]|$)' ";
if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<table class = "table table striped" >';
            echo "<tr>";
            echo "<th>Id</th>";
                echo "<th>Title</th>";
                echo "<th>Date</th>";
                echo "<th>Source</th>";
                echo "</tr>";
            
                while($row = mysqli_fetch_array($result)){
           
                    echo "<tr>";
                    echo "<td >" . $row['Id'] . "</td>";
                echo "<td>" . $row['Title'] . "</td>";
                echo "<td>" . $row['DateTime'] . "</td>";
                echo "<td >" . $row['Source'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Free result set
        mysqli_free_result($result);
    } 
    // else{
    //     echo "No records matching your query were found.";
    // }
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
}
mysqli_close($db);
?>