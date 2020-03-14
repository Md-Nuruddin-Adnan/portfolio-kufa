<?php
session_start();
require_once('../includes/db.php');

$service_icon = htmlentities($_POST['service_icon'], ENT_QUOTES);
$service_title = htmlentities($_POST['service_title'], ENT_QUOTES);
$service_description = htmlentities( $_POST['service_description'], ENT_QUOTES);

if(empty($service_icon) || empty($service_title) || empty($service_description)){
 $_SESSION['service_add_error'] = "Please fill out the field properly";
}
else{
  $service_insert_query = "INSERT INTO services (service_icon, service_title, service_description) VALUES ('$service_icon', '$service_title', '$service_description')";
  mysqli_query($db_connect, $service_insert_query);
  $_SESSION['service_add_success'] = "One new service add successfully";
}

header('location: services.php');

?>