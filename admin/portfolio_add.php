<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$file_name = $_FILES['portfolio_image']['name'];
$afer_explode = explode(".", $file_name);
$file_extension = end($afer_explode);
$excepted_extension = array ("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

if(!empty($_FILES['portfolio_image']['name']) || !empty($_POST['portfolio_category']) || !empty($_POST['portfolio_name']) || !empty($_POST['portfolio_information'])){
  if(in_array($file_extension, $excepted_extension)){
    if($_FILES['portfolio_image']['size'] <= 1048576){
      $portfolio_category = htmlentities($_POST['portfolio_category'], ENT_QUOTES);
      $portfolio_name = htmlentities($_POST['portfolio_name'], ENT_QUOTES);
      $portfolio_information = htmlentities($_POST['portfolio_information'], ENT_QUOTES);

      $portfolio_insert_query = "INSERT INTO portfolios (portfolio_category, portfolio_name, portfolio_information) VALUES ('$portfolio_category', '$portfolio_name', '$portfolio_information')";
      mysqli_query($db_connect, $portfolio_insert_query);
      $last_id = mysqli_insert_id($db_connect);
      $new_file_name = $last_id.".".$file_extension;

      $new_location = '../uploads/images/portfolios/'.$new_file_name;
      move_uploaded_file($_FILES['portfolio_image']['tmp_name'], $new_location);

      $portfolio_update_query = "UPDATE portfolios SET portfolio_image = '$new_file_name' WHERE id = $last_id";
      mysqli_query($db_connect, $portfolio_update_query);

      $_SESSION['portfolio_success'] = "Portfolio added successfully";
    }
    else {
      $_SESSION['portfolio_error'] = "Your file size is more than 1mb";
    }
  }
  else {
    $_SESSION['portfolio_error'] = "Your file formate is not supported";
  }
}
else {
  $_SESSION['portfolio_error'] = "Please fillout all the field";
}

header('location: portfolio_view.php');


?>