<?php
session_start();
require_once('../includes/db.php');

$about_id = $_POST['about_id'];
$about_description = htmlentities($_POST['about_description'], ENT_QUOTES);


if($_FILES['about_image']['name']){
  // File validation check start
  $file_name = $_FILES['about_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['about_image']['size'] <= 2097152){
      // old photo delete start
      $photo_name_query = "SELECT * FROM about";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['about_image'];
      $old_photo_location = "../uploads/images/about/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete

      // new photo upload start
      $new_file_name = $about_id.".".$file_extension;
      $new_file_location = "../uploads/images/about/$new_file_name";
      move_uploaded_file($_FILES['about_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE about SET about_image = '$new_file_name' WHERE id = $about_id";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end

      $_SESSION['about_edit_success'] = "About update successfull";
      header("location: about_view.php");
    }
    else {
      $_SESSION['about_edit_error'] = "Your file size is more than 2mb";
    }
  }
  else {
    $_SESSION['about_edit_error'] = "Your file formate is not supported";
  }  
}

if(empty($about_description)){
  $_SESSION['about_edit_error'] = "Cann't update an empty value";
  header("location: about_view.php");
}
else {
  $update_query = "UPDATE about SET about_description = '$about_description' WHERE id = $about_id";
  mysqli_query($db_connect, $update_query);
  header("location: about_view.php");
}
?>