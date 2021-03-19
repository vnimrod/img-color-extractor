<?php include_once "html/html.php" ?>

<body>
  <?php 
    include_once "html/header.php";
    include_once "html/form-element.php";
    include_once "functions/imageExt.php";
    include_once "functions/imageColorExtractor.php";
  ?>

  <div class="container">
    <?php include_once "upload.php";
    $colorPrecentArr = 1;
    $rgbArr = '';
    $i = 0;
    foreach ($files as $file) {
      $imgGD = imgExt("images/$file");
      $colorPrecentArr = imageColorExtractor($imgGD);
      echo "<div class='container__img-item'>";
      echo "<img src='images/$file'>";
      echo "<table>";
      foreach ($colorPrecentArr as $key => $val) if ($i++ < 5) {
        $val = number_format($val, 3, '.', '');
        $rgbArr = explode(",", $key);
        // echo '<br>';
        echo "<tr class='container__img-item__tr' style= 'background-color: rgb($key);'><td><span>$val% </span><div class='container__img-item__rgb'><span>R:$rgbArr[0]</span><span> G:$rgbArr[1]</span> <span>B:$rgbArr[2]</span></div></td></tr></tr>";
      }
      echo "</table>";
      echo "</div>";
      $i = 0;
    }
    ?>
  </div>

  <?php include_once "html/footer.php" ?>
</body>
</html>