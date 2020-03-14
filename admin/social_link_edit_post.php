<?php
session_start();
require_once('../includes/db.php');

$social_link_id = $_POST['social_link_id'];
$social_icon = trim($_POST['social_icon']);
$social_link = trim($_POST['social_link']);

if(empty($social_icon) || empty($social_link)){
  $_SESSION['social_link_edit_error'] = "Can't update an empty value";
}
else if(!filter_var($social_link, FILTER_VALIDATE_URL)){
  $_SESSION['social_link_edit_error'] = "Please enter a valid url";
}
else {
  $update_query = "UPDATE social_links SET social_icon = '$social_icon', social_link = '$social_link' WHERE id = $social_link_id";
  mysqli_query($db_connect, $update_query);
  $_SESSION['social_link_edit_success'] = "One link update successfully";
}
header("location: banner_view.php#social_link_section");
?>