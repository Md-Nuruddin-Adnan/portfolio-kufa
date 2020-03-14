<?php
require_once('../includes/db.php');
$customer_id = $_GET['customer_id'];

// old photo delete start
$photo_name_query = "SELECT customer_image FROM testimonials WHERE id = $customer_id";
$old_photo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $photo_name_query))['customer_image'];
$old_photo_location = "../uploads/images/testimonials/$old_photo_name";
unlink($old_photo_location);
// end of old photo delete

// delete from database start
$testimonial_delete_query = "DELETE FROM testimonials WHERE id = $customer_id";
mysqli_query($db_connect, $testimonial_delete_query);

header('location: testimonial_view.php');
// delete from database end

?>