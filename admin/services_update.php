<?php
require_once('AUTH/auth.php');
require_once('includes/role.php');
require_once('../includes/db.php');
$title = "Service update";
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
$service_id = $_GET['service_id'];

$service_select_query = "SELECT * FROM services WHERE id = '$service_id'";
$service_db = mysqli_query($db_connect, $service_select_query);
$service_assoc = mysqli_fetch_assoc($service_db);
?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="services.php">Service</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$service_assoc['service_title']?></li>
      </ol>
    </nav>
  </div>
</div>

<div class="row">
<!-- === adding service start === -->
  <div class="col-md-4 col-sm-12 border m-auto">
    <div class="card">
      <div class="card-header text-center bg-white">
        <h3>Serveces Update</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="service_update_post.php">
          <input type="hidden" name="service_id" value="<?=$service_id?>">
          <div class="form-group">
            <label for="service_icon">service icon</label>
            <input type="text" class="form-control" name="service_icon" id="service_icon" value="<?=$service_assoc['service_icon']?>">
          </div>
          <div class="form-group">
            <label for="service_title">service title</label>
            <input type="text" class="form-control" name="service_title" id="service_title" value="<?=$service_assoc['service_title']?>">
          </div>
          <div class="form-group">
            <label for="service_description">service description</label>
            <textarea  class="form-control" name="service_description" id="service_description" rows="4"><?=$service_assoc['service_description']?></textarea>
          </div>
          <div class="form-group text-center">
            <button type="sumbit" name="submit" class="btn btn-success btn-block">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ===//end of adding service === -->


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>
