<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Service';
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$service_hading_query = "SELECT * FROM sections_heading WHERE section_name = 'service section'";
$service_heading_data = mysqli_fetch_assoc(mysqli_query($db_connect, $service_hading_query));
?>

<div class="row">
  <div class="col-md-4 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="services.php">Service</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$service_heading_data['section_name']?></li>
      </ol>
    </nav>
  </div>
</div>

<div class="card-body">
    <div class="row">
      <div class="col-md-6 m-auto">
        <form action="section_heading_post.php" method="POST">
          <table class="table">
            <tr>
              <th>Top Heading</th>
              <th>:</th>
              <td>
                <input type="hidden" name="service_name" value="<?=$service_heading_data['section_name']?>">
                <input type="text" name="top_heading" class="form-control" value="<?=$service_heading_data['top_heading']?>">
              </td>
            </tr>
            <tr>
              <th>Main Heading</th>
              <th>:</th>
              <td>
                <input type="text" name="main_heading" class="form-control" value="<?=$service_heading_data['main_heading']?>">
              </td>
            </tr>
            <tr>
              <td class="text-center" colspan="50">
                <?php  if(isset($_SESSION['heading_error'])): ?>
                  <div class="alert alert-danger"><?=$_SESSION['heading_error']?></div>
                <?php endif; unset($_SESSION['heading_error']) ?>
                <button type="submit" name="service_submit" class="btn btn-info btn-sm px-5">Update</button>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>



<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>