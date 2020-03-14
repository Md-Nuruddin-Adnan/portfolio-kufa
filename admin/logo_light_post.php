<?php
session_start();
require_once('../includes/db.php');


if(!empty($_FILES['logo_image']['name'])){
  // File validation check start
  $file_name = $_FILES['logo_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['logo_image']['size'] <= 1048576){
      // old photo delete start
      $photo_name_query = "SELECT * FROM logos WHERE logo_color = 'light'";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['logo_image'];
      $old_photo_location = "../uploads/images/logo/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete
    
      // new photo upload start
      $logo_color = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['logo_color'];
      $new_file_name = $logo_color.".".$file_extension;
      $new_file_location = "../uploads/images/logo/$new_file_name";
      move_uploaded_file($_FILES['logo_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE logos SET logo_image = '$new_file_name' WHERE logo_color = 'light'";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end
      $_SESSION['logo_light_edit_success'] = "Logo update successfull";
    }
    else {
      $_SESSION['logo_light_edit_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['logo_light_edit_error'] = "Your file formate is not supported";
  }  
}
else {
  $_SESSION['logo_light_edit_error'] = "Plese select a photo";
}

header("location: logo.php");
?>