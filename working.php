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
$db = mysqli_connect('localhost', 'root', '', 'newsfeed'); //

$source = "";  // initialize variables
$title = "";
$link = "";
$id = 0;
$date = "";

$link = $_POST['Url'];         //POST
$source = $_POST['Source'];
$title = $_POST['Title'];
$date = $_POST['Date'];
// $name = $_POST['name'];
// echo $name;




require_once 'autoloader.php';

// CNN search
// Enterpreneur
//The Hindu
//Livemint
//Economic Times
//Forbes


//extra http://feeds.feedburner.com/eu-startups

$url = array(
    // "http://superfounders.com/feed/",
    "https://economictimes.indiatimes.com/rssfeeds/11993050.cms",
    "https://indianceo.in/category/startup/feed/",
    "https://www.google.com/alerts/feeds/04625958786388732261/68429032197491169",
    "https://www.business-standard.com/rss/companies-start-ups-10113.rss",
    "https://inc42.com/infocus/startup-watchlist/feed/",
    "https://inc42.com/infocus/feed/", //funding page weekly
    "https://digify.com/feed/", //extra 
    "https://tech.co/tag/startups/feed",
    "https://inc42.com/infocus/feed/", //funding page weekly
    "https://analyticsindiamag.com/feed/",
    "https://www.google.com/alerts/feeds/04625958786388732261/10018300103479588515",
    "https://www.google.com/alerts/feeds/04625958786388732261/7565418466674719352",
    "https://www.google.com/alerts/feeds/04625958786388732261/2234888820976242977",
    "https://www.google.com/alerts/feeds/04625958786388732261/5761366312100548119",
    "https://thehimalayantimes.com/search/startups/feed/rss2/",
    "https://www.google.com/alerts/feeds/04625958786388732261/10895331304346349157",
    "https://www.google.com/alerts/feeds/04625958786388732261/7005825945051230787",
    "https://www.google.com/alerts/feeds/04625958786388732261/9204133020843014365",
    "https://www.google.com/alerts/feeds/04625958786388732261/4601059000648021950",
    "https://www.google.com/alerts/feeds/04625958786388732261/4601059000648021186",
    "https://www.google.com/alerts/feeds/04625958786388732261/4806451866499005400",
    "https://www.google.com/alerts/feeds/04625958786388732261/12073777735237305244",
    "https://www.privateequityinternational.com/news-analysis/investors/feed/",
    "https://www.privateequityinternational.com/feed/",
    "https://feeds.feedburner.com/venturebeat/SZYF",
    "https://www.inventiva.co.in/category/startups/feed/",
    "https://feeds.feedburner.com/venturebeat/SZYF",
    "https://techstory.in/feed/",
    "https://www.businessofapps.com/feed/",
    "https://entrackr.com/feed/",
    "https://www.google.com/alerts/feeds/04625958786388732261/4934724114917459929",
    "https://www.eu-startups.com/directory/",
    "https://e27.co/index_wp.php/feed/",
    "https://inc42.com/startups/",
    "https://www.eu-startups.com/feed/",
    "https://500.co/blog/",
    "https://www.google.com/alerts/feeds/04625958786388732261/14747421409038512479",
    "https://www.google.com/alerts/feeds/04625958786388732261/2538858900731621764",
    "https://www.google.com/alerts/feeds/04625958786388732261/997343315799691095",
    "https://news.google.com/rss/search?q=%7BStartup%7D&hl=en-IN&gl=IN&ceid=IN:en",
    "https://iamanentrepreneur.in/news-rss-feed",
    "https://www.techrepublic.com/rssfeeds/topic/start-ups/",
    "https://www.zeebiz.com/startups.xml",
    "https://startupbeat.com/feed/",
    "https://tech.economictimes.indiatimes.com/rss/startups",
    "https://techcrunch.com/startups/ ",
    "https://news.crunchbase.com/sections/startups/feed/",
    "https://www.google.com/alerts/feeds/04625958786388732261/15362554208751657620",
    "https://www.google.com/alerts/feeds/04625958786388732261/13703398787898131642",
    "https://www.google.com/alerts/feeds/04625958786388732261/13186834551622454514",
    "https://www.google.com/alerts/feeds/04625958786388732261/5166070128986027904",
    "https://www.google.com/alerts/feeds/04625958786388732261/13059746098961229203",
    "https://www.google.com/alerts/feeds/04625958786388732261/17209136706472328803",
    "https://www.google.com/alerts/feeds/04625958786388732261/3228149685339569469",
    "https://www.google.com/alerts/feeds/04625958786388732261/3363832676682441844",
    "https://www.google.com/alerts/feeds/04625958786388732261/9724156296092295745",
    "https://www.digitimes.com/rss/daily.xml",
);

// $a = 3;
$a = count($url);
?>
<style>
    h1 {
        font-size: 2em;
        text-align: center;
    }
</style>


<?php for ($i = 0; $i < $a; $i++) : ?>

    <?php

    $feed = new SimplePie();
    $feed->set_feed_url($url[$i]);
    $feed->strip_htmltags(array('img', 'src', 'embed', 'path', ' svg ', 'iframe', 'blockquote', 'href', 'strong', 'b'));
    $feed->init();
    $feed->handle_content_type();
    $itemQty = $feed->get_item_quantity();
    $source = $feed->get_title();
    echo "......................................................................................................................................................................................................................................................................................................";
    echo '<h1>' . $feed->get_title() . '</h1>';
    echo ".....................................................................................................................................";
    ?>
    <?php foreach ($feed->get_items(0, $itemQty) as $item) : ?>

        <?php echo '<article style="text-align:center">'; ?>
        <a href="<?php print $item->get_permalink(); ?>">

            <?php echo '<h2> <a href="' . $item->get_link() . '">' . $item->get_title() . '</a></h2>'; ?>
            <?php echo '<h3>' . $item->get_date('d-m-Y H:i:s') . '</h3>' ?>
            <?php echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"; ?>
            <br>
            <?php echo "==========================================================================================================================="; ?>
            <br>
        </a>

        <?php

        $link = $item->get_link();
        $title = $item->get_title();
        $date = $item->get_date('d-m-Y H:i:s');
        $description1 = $item->get_content();
        $description = strip_tags($description1);

        // $score = wordSimilarity($test, $row['$title']);


        mysqli_query($db, "INSERT INTO newsfeed (Link, Source , Title, DateTime  ,Description ) VALUES ('$link', '$source' , '$title' ,'$date' , '$description')");

        ?>

    <?php endforeach; ?>


<?php endfor; ?>
