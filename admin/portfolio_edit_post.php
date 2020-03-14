<?php
session_start();
require_once('../includes/db.php');

$portfolio_id = $_POST['portfolio_id'];
$portfolio_category = htmlentities($_POST['portfolio_category'], ENT_QUOTES);
$portfolio_name = htmlentities($_POST['portfolio_name'], ENT_QUOTES);
$portfolio_information = htmlentities($_POST['portfolio_information'], ENT_QUOTES);

if($_FILES['portfolio_image']['name']){
  // File validation check start
  $file_name = $_FILES['portfolio_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['portfolio_image']['size'] <= 1048576){
      // old photo delete start
      $photo_name_query = "SELECT portfolio_image FROM portfolios WHERE id = $portfolio_id";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['portfolio_image'];
      $old_photo_location = "../uploads/images/portfolios/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete

      // new photo upload start
      $new_file_name = $portfolio_id.".".$file_extension;
      $new_file_location = "../uploads/images/portfolios/$new_file_name";
      move_uploaded_file($_FILES['portfolio_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE portfolios SET portfolio_image = '$new_file_name' WHERE id = $portfolio_id";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end

      $_SESSION['portfolio_edit_success'] = "Portfolio update successfull";
      header("location: portfolio_view.php");
    }
    else {
      $_SESSION['portfolio_edit_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['portfolio_edit_error'] = "Your file formate is not supported";
  }  
}

if(empty($portfolio_category) || empty($portfolio_name) || empty($portfolio_information)){
  $_SESSION['portfolio_edit_error'] = "Cann't Take an empty value";
  header("location: portfolio_view.php");
}
else {
  $update_query = "UPDATE portfolios SET portfolio_category = '$portfolio_category ', portfolio_name = '$portfolio_name', portfolio_information = '$portfolio_information' WHERE id = $portfolio_id";
  mysqli_query($db_connect, $update_query);
  // $_SESSION['portfoli_edit_success'] = "Portfolio text edit successfull";
  header("location: portfolio_view.php");
}
?>