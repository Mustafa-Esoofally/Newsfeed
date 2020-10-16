<?php

// configuration file 
include("config.php");
//default navbar
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Funding Alert</title>

</head>

<body>

  <ul>
    <?php
    $funding = array('funding', 'fund', 'raise', 'raises', 'invest', 'invested', 'Funding Of','seed','series');


    // include("navbar.php");   

    for ($i = 0; $i < count($funding); $i++) {
      $word = $funding[$i];
      // $sql = "SELECT * FROM newsfeed WHERE Title regexp '(^|[[:space:]])$hello([[:space:]]|$)'  limit 6";
      $sql = "SELECT * FROM newsfeed WHERE Title like '%$word%' limit 10 ";
      if ($result = mysqli_query($db, $sql)) {
        if (mysqli_num_rows($result) > 0) {


          while ($row = mysqli_fetch_array($result)) {
    ?>
            <h4>
              <li id="demo">

                <span id="title"><?php echo $row['Title'] ?></span>
                <span id="datetime"> <?php echo $row['Date'] ?></span>
                <span id="datetime"> <?php echo $row['Time'] ?></span>
                <a id="readmore" href="<?php echo $row['Link']; ?>">Read.. </a>
              </li>
            </h4>

    <?php
          }
        }
      }
    } ?>

  </ul>
</body>


<script>
  <?php

  $wordcount = count($funding);

  for ($i = 0; $i < $wordcount; $i++) {
  ?>

    var word = <?php echo json_encode($funding[$i]); ?>;
    console.log(word);
    highlightWord(document.body, word);

    var word = <?php echo json_encode(ucwords($funding[$i])); ?>;
    console.log(word);
    highlightWord(document.body, word);
    var word = <?php echo json_encode(lcfirst($funding[$i])); ?>;
    console.log(word);
    highlightWord(document.body, word);

    document.getElementById("textboxSearch").value = word;
<?php } ?>
</script>

</body>

<style>
  .highlighted {
    background: yellow
  }
</style>