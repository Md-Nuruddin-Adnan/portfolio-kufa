<?php
require_once('../includes/db.php');

$counter_id = $_GET['counter_id'];

$counter_delete_query = "DELETE FROM counters WHERE id = $counter_id";
mysqli_query($db_connect, $counter_delete_query);

header('location: counter_view.php');
?>