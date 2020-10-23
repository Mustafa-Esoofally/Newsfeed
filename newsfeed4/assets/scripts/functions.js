
$(function () {
    $('#map-toggle').click(function () {
        $("#restaurant").toggleClass('hide')

        $("#map").toggleClass('hide')
    });
})

$(document).ready(function () {
    $(".dropdown-menu-right button").click(function () {
        var sel = $(this).text();
        var no_of_days;
        // alert(sel);
        if (sel == "This week") {
            no_of_days = 7;
        } else if (sel == "This month") {
            no_of_days = 30;
        } else if (sel == "Last Year") {
            no_of_days = 365;
        }
        else {
            no_of_days = 1;
        }
        // console.log(no_of_days);
        document.cookie = "Days=" + no_of_days;
        "path=/;"
        // document.alert(no_of_days);
        location.reload();
    });
});

function myFunction() {
    var txt;
    var keyword = prompt("Enter Keyword:", "");
    if (keyword == null || keyword == "") {
        // txt = "User cancelled the prompt.";
    } else {
        txt = keyword + " added to list";
        document.cookie = "keyword=" + keyword;
        "path=/;"
    }
    window.top.location.reload();
    $.get("functions.php");
}

$(function () {
    $('#searchlink').on('click', function (e) {
        $(this).toggleClass('open');
    });
});

function reply_click(clicked_id) {
    // alert(clicked_id);
    document.cookie = "bookmarked=" + clicked_id;
    "path=/;"
    window.top.location.reload();
    $.get("functions.php");

}


$('span').on('click', fav);

function fav(e) {
    $(this).find('.fa').toggleClass('fa-star-o fa-star');
    // $.get("cookie.php");     
}

// function remove_keyword(clicked_id) {
//     // alert(clicked_id);
//     document.cookie = "Removedkeyword=" + clicked_id;
//     "path=/;"
//     $.get("functions.php");
//     // location.reload();
// }

function view_more(clicked_id) {
    // alert(clicked_id);
    document.cookie = "selectedkeyword=" + clicked_id;
    "path=/;"
    // $.get("tagword.php");
    // location.reload();
    window.top.location.reload();
}

function view_more_source(clicked_id) {
    // alert(clicked_id);
    document.cookie = "selectedsource=" + clicked_id;
    "path=/;"
    // $.get("tagword.php");
    // location.reload();
    // document.getElementById(extra).innerHTML ="Showing Results for "+clicked_id;
    window.top.location.reload();
}

function tagcloud() {

    var myFrame = document.getElementById("myFrame");
    // document.alert("Loading");
    myFrame.src = "tagcloud.php";
}

function clickedarticle(clicked_id) {
    // window.alert(clicked_id);
    // console.log(clicked_id);
    window.open(clicked_id, "_blank");
}

function starred() {
    console.log("clicked");
    document.cookie = "starred=starred";
    "path=/;"
    window.top.location.reload();
    location.reload();
}

function search() {


    // $('#search-icon').click(function() {
    var search = $('#search').val();
    if (search != "") {
        location.reload();
        // console.log(search);
        document.cookie = "search=" + search;
        "path=/;"
    }
    // });
}

function TagCloud() {

    document.getElementById("frame1").src = "tagcloud.php";
    console.log("TagCloud");
}

function gridview() {

    document.getElementById("frame1").src = "gridview.php";
    console.log("GridView");
}

function listview() {
    document.getElementById("frame1").src = "index.php";
    console.log("ListView");
}

// function funding(){

//     // $('#funding').click(function() {

//         console.log("clicked funding");
//         document.cookie = "funding=funding";
//         "path=/;"
//         window.top.location.reload();

//     // });

// }