<?php
session_start();
require_once('includes/db.php');

$visitor_name = trim(htmlspecialchars(htmlentities($_POST['visitor_name'], ENT_QUOTES)));
$visitor_email = trim(htmlspecialchars(htmlentities($_POST['visitor_email'], ENT_QUOTES)));
$visitor_message = trim(htmlentities($_POST['visitor_message'], ENT_QUOTES));

if(empty($visitor_name) || empty($visitor_email) || empty($visitor_message)){
  $_SESSION['visitor_post_error'] = "Please fill out all the field";
}
else if(filter_var($visitor_name, FILTER_SANITIZE_NUMBER_INT)){
  $_SESSION['visitor_post_error'] = "please enter a valid name";
}
else if(!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)){
   $_SESSION['visitor_post_error'] = "please enter a valid email";
}
else {
  $insert_query = "INSERT INTO visitors (visitor_name, visitor_email, visitor_message) VALUES ('$visitor_name', '$visitor_email', '$visitor_message')";
  mysqli_query($db_connect, $insert_query);
  $_SESSION['visitor_post_success'] = "Thank for your subscription";
}
header("location: index.php#contact_form");
?>