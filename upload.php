<?php 
  include_once "html/html.php";
  include_once "html/header.php" ?>

<?php
$img_arr = [];
$directory = 'images/';

if (!is_dir($directory)) {
  exit('Invalid diretory path');
}

// Loops on each image that was uploaded to images folder and save them to an array.
$files = array();
foreach (scandir($directory) as $file) {
  if ($file !== '.' && $file !== '..') {
    $files[] = $file;
  }
}

// On form submit, checks if the image is with the right extenstion and size, then push the image with a uniqe id to images folder.
if (isset($_POST['submit'])) {
  $allowed = array('jpg', 'jpeg', 'png', "bmp");
  $file = $_FILES['file'];

  $file_name = $_FILES['file']['name'];
  $file_tmp_name = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_error = $_FILES['file']['error'];

  $file_ext = explode('.', $file_name);

  $file_actual_ext = strtolower($file_ext[1]);

  if (in_array($file_actual_ext, $allowed)) {
    if ($file_error === 0) {
      if ($file_size < 8000000) {
        $file_name_new = uniqid('', true) . "." . $file_actual_ext;
        array_push($img_arr, $file_name_new);
        $file_destination = 'images/' . $file_name_new;
        move_uploaded_file($file_tmp_name, $file_destination);
        header("Location: index.php");
      } else {
        echo "<span class='error'>Your file is too big!</span>";
      }
    } else {
      echo "<span class='error'>There was an error uploading your file!</span>";
    }
  } else {
    echo "<span class='error'>*Warning* You cannot upload files of this type</span>";
  }
}
