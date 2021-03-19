<!-- This function gets image as a GD Object. 
1. Loops through all the pixels one by one. 
2. Pushing them into an array.
3. Later saves their rgb colors.
4. Save them as key value pairs containing how much each color appears. [x,y,z] => int(100).
5. Calculate precentage by k from n items.
6. Sort then returned. -->

<!-- I used GD Graphics Library functions because they get simple data from the image quickly. -->
<!-- Creadits: https://www.php.net/manual/en/book.image.php -->

<?php
function imageColorExtractor($imgGD)
{
  $colorArr = array();
  $colorItems = array();
  $resultArr = array();

  for ($yAxis = 0; $yAxis < imagesy($imgGD); $yAxis++) {
    for ($xAxis = 0; $xAxis < imagesx($imgGD); $xAxis++) {
      $pixelColorIndex = imagecolorat($imgGD, $xAxis, $yAxis);
      $imgColor = imagecolorsforindex($imgGD, $pixelColorIndex);

      array_push($colorArr, $imgColor);
    }
  }

  $countItems = count($colorArr);

  for ($i = 0; $i < $countItems; $i++) {
    $rgbColor = $colorArr[$i]['red'] . "," . $colorArr[$i]['green'] . "," . $colorArr[$i]['blue'];
    array_push($colorItems, $rgbColor);
  }

  $countRgbColorsArr = array_count_values($colorItems);

  foreach ($countRgbColorsArr as $key => $value) {
    $precent = $value / $countItems * 100;
    $resultArr[$key] = $precent;
  }

  arsort($resultArr);
  return $resultArr;
}
?>