<?php
session_start();
require_once('../includes/db.php');

$service_id = $_POST['service_id'];
$service_icon = htmlentities($_POST['service_icon'], ENT_QUOTES);
$service_title = htmlentities($_POST['service_title'], ENT_QUOTES);
$service_description = htmlentities( $_POST['service_description'], ENT_QUOTES);

if(empty($service_icon) || empty($service_title) || empty($service_description)){
  $_SESSION['service_update_error'] = "Something is wrong!";
}
else {
  $update_query = "UPDATE services SET service_icon = '$service_icon', service_title = '$service_title', service_description = '$service_description' WHERE id = '$service_id'";
  mysqli_query($db_connect, $update_query);
  $_SESSION['service_update_success'] = "One service update successfully";
}
header("location: services.php");
?>