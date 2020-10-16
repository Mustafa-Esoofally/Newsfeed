<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


$contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false
    )
);

//database connection
session_start();
$db = mysqli_connect('localhost', 'root', '', 'newsfeed');

$results = mysqli_query($db, "SELECT * FROM newsfeed");

// initialize variables
$source = "";
$title = "";
$link = "";
$id = 0;
//variables end 

$link = $_POST['Url'];
$source = $_POST['Source'];
$title = $_POST['Title'];

$url = 'http://feeds.feedburner.com/TechCrunch/startups';
$content = file_get_contents($url);

echo "<p>Fetching News from ..." . $url;
$source = $url ;

//split title and links

if (preg_match_all('~<title>(?P<paragraphs>.*?)</link>~is', $content, $matches)) {
    
    //title

    if (preg_match_all('~<title>(?P<paragraphs>.*?)</title>~is', $content, $matches1)) {
        
        echo "<pre>";
        
        print_r($matches1['paragraphs']);
        
        echo "</pre>";
        echo"==================";
    }
    //link
    if (preg_match_all('~<link>(?P<paragraphs>.*?)</link>~is', $content, $matches2)) {
        
        echo "<pre>";
        echo"///////////////////////";
        
        print_r($matches2['paragraphs']);
        
        echo "</pre>";
    }
    
}
$lm = "https://www.businessinsider.in/business/startups";

// $lm="http://www.livemint.com/mostpopular";
$url = $lm ; 
// $source = $url ; 
// echo "$source";
$content = file_get_contents($url);

echo "<p>Fetching News from ..." . $url;

//split 
if (preg_match_all('~<a gatrack(?P<paragraphs>.*?)</a>~is', $content, $matches)) {
// if (preg_match_all('~<a href=(?P<paragraphs>.*?)</a>~is', $content, $matches)) {
    
    //$headlines = print_r($matches['paragraphs'], TRUE);
    
    ob_start();
    var_dump($matches['paragraphs']);
    $headlines = ob_get_clean();
    
    //echo $headlines;
    $str2 = explode("latest stories section", $headlines);
    
    foreach ($str2 as $str) {
        
        $str3 = explode("href=", $str);
        $matches1 = array();
        $t = preg_match('/>(.*?)\[/s', $str3[1], $matches1);
        
        echo "<pre>";
        print_r($matches1[1]);
        // echo strip_tags("$matches1[1]");
        echo "</pre>";
        //   $title = $matches1[1]; 
        //   echo "$title" ;   
        
        //============= SQL QUERY =================
        
        // mysqli_query($db, "INSERT INTO newsfeed (Link, Source , Title) VALUES ('$link', '$Source' , '$title' )");
        
        //===========SQL============================    
        
        //sql query
        //
    }
}

echo "<pre>";
echo "<style> .lazy {display: none} </style> ";            //  <img class="lazy"
// print_r($matches['paragraphs']);
echo "</pre>";

$lm = "https://techstory.in/category/startups/";
$url = $lm ; 
// $source = $url ; 
// echo "$source";
$content = file_get_contents($url);

echo "<p>Fetching News from ..." . $url;

if (preg_match_all('~<a href=(?P<paragraphs>.*?)</a>~is', $content, $matches5)) {
    // if (preg_match_all('~<a href=(?P<paragraphs>.*?)</a>~is', $content, $matches)) {
        
        //$headlines = print_r($matches['paragraphs'], TRUE);
        
        ob_start();
        var_dump($matches['paragraphs']);
        $headlines4 = ob_get_clean();
        
        //echo $headlines;
        $str4 = explode("popular posts", $headlines4);
        
        foreach ($str4 as $str6) {
            
            $str10 = explode("href=", $str6);
            $matches5 = array();
            // $t = preg_match('/>(.*?)\[/', $str10[1], $matches5);
        $t = preg_match('/>(.*?)\[/s', $str3[1], $matches1);
            
            echo "<pre>";
            print_r($matches5[1]);
            echo "</pre>";
            //   $title = $matches1[1]; 
            //   echo "$title" ;   
            
            //============= SQL QUERY =================
            
            // mysqli_query($db, "INSERT INTO newsfeed (Link, Source , Title) VALUES ('$link', '$Source' , '$title' )");
            
            //===========SQL============================    
            
            //sql query
            //
        }
    }
?>