<?php
session_start();
require_once('../includes/db.php');

$social_icon = $_POST['social_icon'];
$social_link = $_POST['social_link'];

if(empty($social_icon) || empty($social_link)){
  $_SESSION['social_link_add_error'] = "Please fill out all the field";
}
else if(!filter_var($social_link, FILTER_VALIDATE_URL)){
  $_SESSION['social_link_add_error'] = "Please enter a valid url";
}
else {
  $insert_query = "INSERT INTO social_links (social_icon, social_link) VALUES ('$social_icon', '$social_link')";
  mysqli_query($db_connect, $insert_query);
  $_SESSION['social_link_add_success'] = "One link added successfully";
}
header("location: banner_view.php#social_link_section");
?>