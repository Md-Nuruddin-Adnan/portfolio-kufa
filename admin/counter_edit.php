<?php
require_once('AUTH/auth.php');
require_once('includes/role.php');
require_once('../includes/db.php');
$title = "Counter edit";
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
$counter_id = $_GET['counter_id'];

$counter_select_query = "SELECT * FROM counters WHERE id = '$counter_id'";
$counter_db = mysqli_query($db_connect, $counter_select_query);
$counter_assoc = mysqli_fetch_assoc($counter_db);
?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="counter_view.php">Counter</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$counter_assoc['counter_name']?></li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
   <!-- === adding new counter start === -->
   <div class="col-md-4 m-auto">
    <div class="border px-3 bg-white">
      <h4 class="text-center pt-3">Add new counter</h4>
      <form method="POST" action="counter_edit_post.php">
        <div class="form-group">
          <label for="counter_icon">Counter icon</label>
          <input type="hidden" name="counter_id" value="<?=$counter_assoc['id']?>">
          <input type="text" class="form-control" name="counter_icon" id="counter_icon" value="<?=$counter_assoc['counter_icon']?>">
        </div>
        <div class="form-group">
          <label for="counter_count">Counter count</label>
          <input type="text" class="form-control" name="counter_count" id="counter_count"  value="<?=$counter_assoc['counter_count']?>">
        </div>
        <div class="form-group">
          <label for="counter_name">Counter name</label>
          <input type="text" class="form-control" name="counter_name" id="counter_name" value="<?=$counter_assoc['counter_name']?>">
        </div>
        <div class="form-group text-center">
          <?php  if(isset($_SESSION['counter_add_error'])): ?>
              <div class="alert alert-danger"><?= $_SESSION['counter_add_error']?></div>
          <?php endif; unset($_SESSION['counter_add_error']); ?>

          <?php  if(isset($_SESSION['counter_add_success'])): ?>
            <div class="alert alert-success"><?=$_SESSION['counter_add_success']?></div>
          <?php endif; unset($_SESSION['counter_add_success']); ?>

          <button type="sumbit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
  <!-- ===//end of adding new counter === -->
</div>