<?php
session_start();
require_once('../includes/db.php');

$customer_id = $_POST['customer_id'];
$customer_name = htmlentities($_POST['customer_name'], ENT_QUOTES);
$customer_designation = htmlentities($_POST['customer_designation'], ENT_QUOTES);
$customer_review = htmlentities($_POST['customer_review'], ENT_QUOTES);


if($_FILES['customer_image']['name']){
  // File validation check start
  $file_name = $_FILES['customer_image']['name'];
  $afer_explode = explode(".", $file_name);
  $file_extension = end($afer_explode);
  $excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['customer_image']['size'] <= 1048576){
      // old photo delete start
      $photo_name_query = "SELECT portfcustomer_imageolio_image FROM testimonials WHERE id = $customer_id";
      $old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['customer_image'];
      $old_photo_location = "../uploads/images/testimonials/$old_photo_name";
      unlink($old_photo_location);
      // end of old photo delete

      // new photo upload start
      $new_file_name = $customer_id.".".$file_extension;
      $new_file_location = "../uploads/images/testimonials/$new_file_name";
      move_uploaded_file($_FILES['customer_image']['tmp_name'], $new_file_location);
      // new photo upload end

      // update new photo name to database start
      $new_photo_name_update_query = "UPDATE testimonials SET customer_image = '$new_file_name' WHERE id = $customer_id";
      mysqli_query($db_connect, $new_photo_name_update_query);
      // update new photo name to database end

      $_SESSION['testimonial_edit_success'] = "Testimonial update successfull";
      header("location: testimonial_view.php");
    }
    else {
      $_SESSION['testimonial_edit_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['testimonial_edit_error'] = "Your file formate is not supported";
  }  
}

if(empty($customer_name) || empty($customer_designation) || empty($customer_review)){
  $_SESSION['testimonial_edit_error'] = "Cann't Take an empty value";
  header("location: testimonial_view.php");
}
else {
  $update_query = "UPDATE testimonials SET customer_name = '$customer_name ', customer_designation = '$customer_designation', customer_review = '$customer_review' WHERE id = $customer_id";
  mysqli_query($db_connect, $update_query);

  header("location: testimonial_view.php");
}
?>