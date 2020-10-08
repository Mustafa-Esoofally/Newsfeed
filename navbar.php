<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mockup.css">
  <!-- <title>Document</title> -->
  <!-- <title>News Grabber</title> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-dark" style="height :80px">

    <a class="navbar-brand" href="index.php" style="margin-right :70px">Dashboard</a>

    <a class="navbar-brand" href="funding.php" style="margin-right :70px">Funding Alert</a>

    <a style="color: #fff;" class="nav-link" href="tagcloud.php">Tagcloud</a>



    <form action="search.php" method="post" style="margin-left:300px">
      <input type="text" name="search" style="border-radius:40px; height:40px ;width:400px">
      <input type="submit">
      <br>
  </nav>


  <script>
    function myFunction() {
      var x = document.getElementById("search").value;
      document.getElementById("demo").innerHTML = x;
      console.log(x);
      // var url1 = "tp1.php";
      // window.open(url1);
    }
  </script>

  </nav>
</body>

