<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');

$brand_id = $_GET['brand_id'];

$active_brand_query = "SELECT COUNT(*) AS active_count FROM brands WHERE brand_status = 2";
$active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_brand_query));

if($_GET['btn'] == 'active'){
  $update_query = "UPDATE brands SET brand_status = 2 WHERE id = '$brand_id'";
}
else {
  $update_query = "UPDATE brands SET brand_status = 1 WHERE id = '$brand_id'";
}

mysqli_query($db_connect, $update_query);
header("location: brand_view.php");
?>