<?php
session_start();
require_once('../includes/db.php');

$brand_id = $_POST['brand_id'];


if($_FILES['brand_image']['name']){
  // File validation check start
  $file_name = $_FILES['brand_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['brand_image']['size'] <= 1048576){
      // old photo delete start
      $photo_name_query = "SELECT brand_image FROM brands WHERE id = $brand_id";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['brand_image'];
      $old_photo_location = "../uploads/images/brands/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete

      // new photo upload start
      $new_file_name = $brand_id.".".$file_extension;
      $new_file_location = "../uploads/images/brands/$new_file_name";
      move_uploaded_file($_FILES['brand_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE brands SET brand_image = '$new_file_name' WHERE id = $brand_id";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end

      $_SESSION['brand_edit_success'] = "Brand update successfull";
    }
    else {
      $_SESSION['brand_edit_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['brand_edit_error'] = "Your file formate is not supported";
  }  
}

header("location: brand_view.php");
?>