<?php
if($_SESSION['user_role'] != 1){
  header("location: index.php");
}
?>