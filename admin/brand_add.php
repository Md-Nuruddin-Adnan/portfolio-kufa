<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$file_name = $_FILES['brand_image']['name'];
$afer_explode = explode(".", $file_name);
$file_extension = end($afer_explode);
$excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

if(!empty($_FILES['brand_image']['name'])){
  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['brand_image']['size'] <= 1048576){
      $file_name_temporary = htmlspecialchars(htmlentities($_FILES['brand_image']['name']));

      $brand_insert_query = "INSERT INTO brands (brand_image) VALUES ('$file_name_temporary')";
      mysqli_query($db_connect, $brand_insert_query);
      $last_id = mysqli_insert_id($db_connect);
      $new_file_name = $last_id.".".$file_extension;

      $new_location = '../uploads/images/brands/'.$new_file_name;
      move_uploaded_file($_FILES['brand_image']['tmp_name'], $new_location);

      $brand_update_query = "UPDATE brands SET brand_image = '$new_file_name' WHERE id = $last_id";
      mysqli_query($db_connect, $brand_update_query);

      $_SESSION['brand_success'] = "Brand added successfully";
    }
    else {
      $_SESSION['brand_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['brand_error'] = "Your file formate is not supported";
  }
}
else {
  $_SESSION['brand_error'] = "Please Attached a Photo";
}

header('location: brand_view.php');


?>