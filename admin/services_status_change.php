<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$service_id = $_GET['service_id'];

$active_service_query = "SELECT COUNT(*) AS active_count FROM services WHERE service_status = 2";
$active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_service_query));

if($_GET['btn'] == 'active'){
  if($active_count['active_count'] < 6) {
    $update_query = "UPDATE services SET service_status = 2 WHERE id = '$service_id'";
  }
  else {
    $_SESSION['active_status'] = "You can't active more than 6 services";
  }
}
else {
  $update_query = "UPDATE services SET service_status = 1 WHERE id = '$service_id'";
}

mysqli_query($db_connect, $update_query);
header("location: services.php");
?>