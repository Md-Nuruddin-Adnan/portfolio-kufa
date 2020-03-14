<?php
require_once('../includes/db.php');

$service_id = $_GET['service_id'];

$services_delete_query = "DELETE FROM services WHERE id = $service_id";
mysqli_query($db_connect, $services_delete_query);

header('location: services.php');
?>