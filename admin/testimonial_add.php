<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$file_name = $_FILES['customer_image']['name'];
$afer_explode = explode(".", $file_name);
$file_extension = end($afer_explode);
$excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

if(!empty($_FILES['customer_image']['name']) && !empty($_POST['customer_name']) && !empty($_POST['customer_designation']) && !empty($_POST['customer_review'])){
  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['customer_image']['size'] <= 1048576){
      $customer_name = htmlentities($_POST['customer_name'], ENT_QUOTES);
      $customer_designation = htmlentities($_POST['customer_designation'], ENT_QUOTES);
      $customer_review = htmlentities($_POST['customer_review'], ENT_QUOTES);

      $testimonial_insert_query = "INSERT INTO testimonials (customer_name, customer_designation, customer_review) VALUES ('$customer_name', '$customer_designation', '$customer_review')";
      mysqli_query($db_connect, $testimonial_insert_query);
      $last_id = mysqli_insert_id($db_connect);
      $new_file_name = $last_id.".".$file_extension;

      $new_location = '../uploads/images/testimonials/'.$new_file_name;
      move_uploaded_file($_FILES['customer_image']['tmp_name'], $new_location);
      

      $testimonial_update_query = "UPDATE testimonials SET customer_image = '$new_file_name' WHERE id = $last_id";
      mysqli_query($db_connect, $testimonial_update_query);

      $_SESSION['testimonial_success'] = "Testimonial added successfully";
    }
    else {
      $_SESSION['testimonial_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['testimonial_error'] = "Your file formate is not supported";
  }
}
else {
  $_SESSION['testimonial_error'] = "Please fillout all the field";
}

header('location: testimonial_view.php');


?>