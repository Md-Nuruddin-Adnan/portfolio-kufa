<?php
require_once('../includes/db.php');
$brand_id = $_GET['brand_id'];

// old photo delete start
$photo_name_query = "SELECT brand_image FROM brands WHERE id = $brand_id";
$old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['brand_image'];
$old_photo_location = "../uploads/images/brands/$old_photo_name";
unlink($old_photo_location);
// end of old photo delete

// delete from database start
$brand_delete_query = "DELETE FROM brands WHERE id = $brand_id";
mysqli_query($db_connect, $brand_delete_query);

header('location: brand_view.php');
// delete from database end

?>