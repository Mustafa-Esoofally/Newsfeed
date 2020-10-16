<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <script src="http://underscorejs.org/underscore-min.js"></script>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="style.css">

    <!-- JS Files -->
    <script src="highlightword.js"></script>
    <script src="cookiefunctions.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-dark" style="height :80px">

        <a class="navbar-brand" href="index.php" style="margin-right :45px ; font-size:25px">Dashboard</a>
        <a class="navbar-brand" href="funding.php" style="margin-right :45px  ; font-size:25px">CapitalRaising Alerts</a>
        <a class="navbar-brand" href="tagcloud.php" style="margin-right :45px ;font-size:25px">Tagcloud</a>

        <a class="navbar-brand" style="font-size:25px">


            <form action="search.php" method="post" style="margin-left: 100px;height: 35px">

                <input type="text" id="textboxSearch" style="width: 350px; height: 35px;border-radius: 31px ;font-size:20px " value="">

                <button id=" search" onclick="searchFunction()">
                    <i class="fa fa-search" style="color:green"></i>
                </button>
            </form>
        </a>

        <div class="container">

            <div class="dropdown dropleft">
                <button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">
                    Recent Searches
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="margin-top: 24px;font-size:20px">

                    Search History:
                    <div style="border:1px solid green; width:400px; height:300px; overflow-y:scroll;">
                        <ul id="searchHistory"></ul>
                        <?php if (isset($_COOKIE['searchword'])) {
                            // echo 'hello';
                        ?>
                            <script>
                                var recentSearches = <?php echo $_COOKIE['searchword']; ?>;
                                console.log(recentSearches);

                                _.uniq(recentSearches);
                                // recentSearches.reverse();
                                $('#searchHistory').text(""); //clear the seach history window then repopulate with the new array


                                $.each(recentSearches, function(index, value) {
                                    $('#searchHistory').append("<li class='historyItem'  onclick='addtotextbox(" + index + ")'>" + value + '</li>');
                                    // savedrecentSearches.push(value);

                                });
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                var savedrecentSearches = []; // create an empty javascript array
                                var recentSearches = []; // create an empty javascript array
                            </script>
                        <?php }
                        ?>
                    </div>

                </ul>
            </div>

        </div>

    </nav>

    <script>
        function searchFunction(data) {

            // This line puts the value from the text box in an array
            recentSearches.push($('#textboxSearch').val());
            recentSearches = _.uniq(recentSearches);

            $('#textboxSearch').val(""); //  clear the text box after search

            $('#searchHistory').text(""); //clear the seach history window then repopulate with the new array

            // the function below loops through the array and adds each item in the array
            // to the span element within the Search history arear

            var json_str = JSON.stringify(recentSearches);

            // cookie for the searched words
            document.cookie = "searchword=" + json_str;
            "path=/";

            var arr = JSON.parse(json_str);


            // populate the recent searches dropdown 
            $.each(arr, function(index, value) {
                $('#searchHistory').append("<li class='historyItem'  onclick='addtotextbox(" + index + ")'>" + value + '</li>');

            });


        }


        function addtotextbox(id) {
            $('#textboxSearch').val(recentSearches[id]);
            var a = $('#textboxSearch').val();

            cname = "searchword";
            var x = JSON.parse(getCookie(cname));
            console.log(x);

            x.push(a);
            console.log(a);
            var z = JSON.stringify(x);
            console.log(z);

            // var input = "AbCyTtaCc113";
            // let names = ['James', 'james', 'bob', 'JaMeS', 'Bob'];

            setCookie("Searchword", z, 1);
            // var recentSearches1 = <?php echo $_COOKIE['Searchword']; ?>;
            // console.log(recentSearches1);

            // _.uniq(recentSearches1);
        }
    </script>

    <script>
        $(document).ready(function() {
            $(".dropdown-toggle").dropdown();
        });
    </script>

</body>

</html>
<style>
    .historyItem:hover {
        background-color: yellow;
    }
</style>