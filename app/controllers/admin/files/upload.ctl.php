<?php
include_once(CONFIG_DIR . '/app.cnf.php');

$target_dir = "uploads/";
$target_file = $target_dir . time() . "_" . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    die("-1"); // not image
    $uploadOk = 0;
  }
}

if ($_FILES["file"]["size"] > 5000000) {
  die("-2"); // large file
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  die("-3"); // ext not allowed
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  die("-4"); // server error
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo WEB_BASE_URL . '/' . $target_file;
    } else {
      die("-4");
    }
}