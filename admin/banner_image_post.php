<?php
session_start();
require_once('../includes/db.php');

$banner_id = $_POST['banner_id'];


if(!empty($_FILES['my_image']['name'])){
  // File validation check start
  $file_name = $_FILES['my_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['my_image']['size'] <= 1048576){
      // old photo delete start
      $photo_name_query = "SELECT * FROM banners WHERE id = $banner_id";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['my_image'];
      $old_photo_location = "../uploads/images/banner/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete
    
      // new photo upload start
      $new_file_name = $banner_id.".".$file_extension;
      $new_file_location = "../uploads/images/banner/$new_file_name";
      move_uploaded_file($_FILES['my_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE banners SET my_image = '$new_file_name' WHERE id = '$banner_id'";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end
      $_SESSION['my_image_edit_success'] = "My image update successfull";
    }
    else {
      $_SESSION['my_image_edit_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['my_image_edit_error'] = "Your file formate is not supported";
  }  
}
else {
  $_SESSION['my_image_edit_error'] = "Plese select a photo";
}

header("location: banner_view.php#my_image");
?>