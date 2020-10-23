<?php include("config.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NewsFeed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mootools/1.6.0/mootools-core.min.js"> </script> -->

    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    <script type="text/javascript" src="./assets/scripts/functions.js"></script>

    <link href="./assets/css/main.css" rel="stylesheet">
    <!-- <link href="./assets/css/card.css" rel="stylesheet"> -->
    <link href="./assets/css/index.css" rel="stylesheet">
</head>


<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src">
                    <div class="logoText" style="color:white">NewsFeed</div>
                    <!-- <img src="./assets/images/logo.jpg" class="img img-responsive" style=" width: 70%;">  -->
                </div>



                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" id="search" class="search-input" placeholder="Type to search" style="font-size: 20px;color: white">
                            <button id="search-icon" class="search-icon" onclick="search()"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>

                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">

                                <a class="navbar-brand">

                                    <a class="navbar-brand" style="margin-right :3px ;font-size:25px; color:white">
                                        <div>
                                            <i onclick="gridview()" style="color: white;margin-right:30px" class="fa fa-window-maximize" aria-hidden="true"></i>

                                        </div>

                                    </a>
                                </a>
                                <a class="navbar-brand">

                                    <a class="navbar-brand" style="margin-right :3px ;font-size:25px; color:white">
                                        <div>
                                            <i onclick="listview()" style="color: white;margin-right:30px" class="fa fa-list" aria-hidden="true"></i>
                                        </div>

                                    </a>
                                </a>

                                <!-- <a class="navbar-brand" style="font-size:25px">

                                    <form action="search.php" method="post" style="margin-left: 100px;height: 35px">

                                        <input type="text" id="textboxSearch" style="width: 200px; height: 35px;border-radius: 31px ;font-size:20px " value="">

                                        <button id=" search" onclick="searchFunction()">
                                            <i class="fa fa-search" style="color:green"></i>
                                        </button>
                                    </form>
                                </a> -->


                                <a>
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn" style="margin-right:40px">
                                                <i class="fa fa-angle-down ml-2 opacity-8">
                                                    <?php

                                                    $time = $_COOKIE['Days'];
                                                    if ($time == "365") {
                                                        $string = "Past Year";
                                                    } else if ($time == "1") {
                                                        $string = "Last 24 hours";
                                                    } else if ($time == "7") {
                                                        $string = "Last Week";
                                                    }else{
                                                        $string="Last Month";
                                                    }
                                                    ?>
                                                    <Span style="color: white;font-size:25px">
                                                        <?php echo $string ?>
                                                    </Span>

                                                </i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">Past 24 hours</button>
                                                <!-- <button type="button" tabindex="0" class="dropdown-item">Yesterday</button> -->
                                                <!-- <h6 tabindex="-1" class="dropdown-header">Header</h6> -->
                                                <button type="button" tabindex="0" class="dropdown-item">This week</button>
                                                <button type="button" tabindex="0" class="dropdown-item">This month</button>
                                                <!-- <div tabindex="-1" class="dropdown-divider"></div> -->
                                                <button type="button" tabindex="0" class="dropdown-item">Last Year</button>
                                            </div>
                                        </div>
                                    </div>

                                </a>

                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php
                                        $sql = "Select * from Users";
                                        if ($result = mysqli_query($db, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_array($result);
                                                $name = $row['Firstname'] . " " . $row['Lastname'];
                                                echo $name;
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php
                                        $sql = "Select * from Users";
                                        if ($result = mysqli_query($db, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_array($result);
                                                $name = $row['Login'];
                                                echo $name;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- <a>
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="assets/images/avatars/1.png" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">User
                                                    Account</button>
                                                <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                                <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                            </div>
                                        </div>
                                    </div>

                                </a>
 -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>

                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <!-- <li class="app-sidebar__heading">Dashboards</li>
                            <li class="app-sidebar__heading">Quick Menu</li> 
                            -->
                            <!-- <li class="app-sidebar__heading">Subscriptions</li> -->

                            <li>
                                <a href="#">
                                    <!-- <i class="metismenu-icon pe-7s-diamond"></i> -->
                                    <!-- <i class="metismenu-icon pe-7s-folder"></i> -->
                                    <i class="fa fa-folder-open metismenu-icon" aria-hidden="true" style="color: orange"></i>

                                    <span class="textnormal" style="font-size: 0.875rem;">
                                        Sources
                                    </span>
                                    <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left" id="clickedsources"></i> -->
                                </a>
                                <ul class="mm-collapse mm-show">
                                    <!-- <ul  id="clickedsources"> -->

                                    <iframe src="sources.php " width="260px" height="250px" frameborder="0" style="margin-top: -21px;"></iframe>
                                </ul>
                            </li>


                            <!-- <li class="app-sidebar__heading">Watches</li> -->

                            <!-- <li>
                                <a class="navbar-brand" href="01-parent-frame.php" style="margin-right :45px ;font-size:19px; color:black">
                                    <i class="fa fa-folder" aria-hidden="true" style="color: orange;"></i>
                                    All News
                                </a>
                            </li> -->
                            <!-- <li> -->
                            <li>
                                <a href="#" id="clickedsources">
                                    <!-- <i class="metismenu-icon pe-7s-diamond"></i> -->
                                    <!-- <i class="metismenu-icon pe-7s-folder"></i>
                                     -->
                                    <i class="fa fa-folder-open metismenu-icon" aria-hidden="true" style="color: orange"></i>
                                    <span class="textnormal" style="font-size: 0.875rem;">

                                        Personalisation
                                    </span>
                                    <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left" id="clickedsources"></i> -->
                                </a>
                                <ul id="clickedsources" class="mm-collapse mm-show">
                                    <!-- <ul  id="clickedsources"> -->
                                    <a class="textbold" onclick="TagCloud()" style="margin-top:-15px">
                                        <i class="fa fa-folder" aria-hidden="true" style="color: orange;"></i>

                                        Tagcloud
                                        <!-- <li> -->

                                        <a class="textbold" onclick="starred()" style="margin-top:-10px">
                                            <i class="fa fa-folder" aria-hidden="true" style="color: orange;"></i>
                                            <?php
                                            // 
                                            $sql = "SELECT Bookmarked FROM `user_personalisation` ";
                                            if ($result = mysqli_query($db, $sql)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_array($result);

                                                    $allbookmarks = $row[0];
                                                    $allbookmarks = explode(",", $allbookmarks);
                                                    $string =  'My Favorites ' . '<span style="color:blue">(' . count($allbookmarks) . ')</span>';
                                                    echo $string;
                                            ?>
                                            <?php } else {
                                                    echo "My Favorities";
                                                }
                                            } ?>
                                        </a>
                                    </a>
                                    <!-- </li>  -->


                                    <!-- <iframe id="clickedsources" src="sources.php " width="260px" height="200px" frameborder="0"></iframe> -->
                                </ul>

                            </li>

                            <!-- </li> -->

                            <!-- </li> -->
                            <!-- <li>
                                <a id="funding" class="navbar-brand" style="margin-right :65px  ; font-size:19px ; color:black">
                                    <i class="fa fa-folder" aria-hidden="true" style="color: orange;"></i>
                                    Funding Alerts</a>
                            </li> -->
                            <!-- <li>
                                <a id="starred" class="navbar-brand" style="margin-right :65px  ; font-size:19px ; color:black">
                                    <i class="fa fa-folder" aria-hidden="true" style="color: orange;"></i>
                                    My Favourites
                                </a>
                            </li> -->

                            <!-- <li class="app-sidebar__heading">Tags</li> -->
                            <li>

                                <a href="#">
                                    <!-- <i class="metismenu-icon pe-7s-ticket"></i> -->
                                    <!-- <i class="metismenu-icon pe-7s-folder"></i>
                                     -->
                                    <i class="fa fa-folder-open metismenu-icon" aria-hidden="true" style="color: orange"></i>
                                    <span class="textnormal" style="font-size: 0.875rem;">

                                        Tags
                                    </span>
                                    <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> -->
                                    <!-- <ul> -->
                                    <i class="fa fa-plus" style="font-size:20px;color:red;margin-left:180px" onclick="myFunction()"></i>

                                    <!-- </ul> -->
                                </a>

                                <ul class="mm-collapse mm-show">

                                    <!-- <button onclick="myFunction()"> -->
                                    <!-- <button onclick="myFunction()"> -->
                                    <!-- </button> -->

                                    <!-- <p id="demo">
                                    </p> -->
                                    <iframe name="frame" src="tagword.php " width="260px" height="180px" frameborder="0" style="margin-top: -10px;"></iframe>
                                </ul>

                            </li>
                            <li>
                                <div class="footer">
                                    <div class="app-footer__inner">
                                        <div class="app-footer-right">
                                            <span class="textbold">
                                                Elite Infosoft . 2020
                                            </span>
                                        </div>
                                    </div>
                                    <!-- 

                                                    -->
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- Scrollbar sidebar end -->
            </div>
            <!-- Scrollbar sidebar end -->

            <div class="app-main_outer">
                <div class="app-main_inner">

                    <div id="map">
                        <iframe id="frame1" name="frame" src="gridview.php " width="1350px" height="570px" frameborder="0"></iframe>
                        <!-- <iframe name="frame" src="gridview.php "  width="100%" height="100%" frameBorder="0"></iframe> -->
                    </div>

                    <div id="restaurant" class="hide">

                        <iframe id="frame" name="frame" src="index.php " width="1350px" height="570px" frameborder="0"></iframe>
                    </div>

                </div>
                <!-- App outer end -->
            </div>
            <!-- App main end -->
        </div>


    </div>

    <!-- Container End -->

    <style>
        .hide {
            display: none
        }
    </style>

</body>



</html>

<!--  -->

<style>
    .app-sidebar__inner {
        zoom: 90%;
    }
</style>