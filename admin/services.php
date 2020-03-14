<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
require_once('includes/role.php');
$title = 'Service';
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
?>

<div class="card">
  <div class="card-header text-center bg-white">
    <h2>Services</h2>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-6 m-auto">
        <table class="table">
          <?php
            $section_hading_query = "SELECT * FROM sections_heading WHERE section_name = 'service section'";
            $heading_data = mysqli_fetch_assoc(mysqli_query($db_connect, $section_hading_query));
          ?>
          <tr>
            <th>Top Heading</th>
            <th>:</th>
            <td><?=$heading_data['top_heading']?></td>
          </tr>
          <tr>
            <th>Main Heading</th>
            <th>:</th>
            <td><?=$heading_data['main_heading']?></td>
          </tr>
          <tr>
            <td class="text-center" colspan="50">
              <?php  if(isset($_SESSION['heading_success'])): ?>
                <div class="alert alert-success"><?=$_SESSION['heading_success']?></div>
              <?php endif; unset($_SESSION['heading_success']) ?>

              <a href="service_heading_edit.php?id=<?=$heading_data['id']?>" class="btn btn-info btn-sm px-5">Edit</a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
 
  <?php
    $active_service_query = "SELECT COUNT(*) AS active_count FROM services WHERE service_status = 2";
    $active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_service_query));
  ?>

  <div class="card-body">
  <?php if(isset( $_SESSION['service_update_error'])):?>
    <div class="alert alert-danger"><?= $_SESSION['service_update_error']?></div>
  <?php endif; unset( $_SESSION['service_update_error']);?>

  <?php if(isset($_SESSION['service_update_success'])):?>
    <div class="alert alert-success"><?=$_SESSION['service_update_success']?></div>
  <?php endif; unset($_SESSION['service_update_success']);?>

  <?php if(isset($_SESSION['active_status'])):?>
    <div class="alert alert-danger"><?=$_SESSION['active_status']?></div>
  <?php endif; unset($_SESSION['active_status']);?>
  <h4 class="mb-3 pt-3">Serveces List (Active: <?=$active_count['active_count'];?>)</h4>
    <div class="row">
      <div class="col-lg-8">
        <table class="table table-striped table-sm table-responsive-lg" id="service_table">
          <thead>
            <tr class="text-nowrap">
              <th class="pb-3">Sl. No</th>
              <th class="pb-3">Service Icon</th>
              <th class="pb-3">Service Title</th>
              <th class="pb-3">Service Description</th>
              <th class="pb-3">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $service_query = "SELECT * FROM services";
            $service_query_db = mysqli_query($db_connect, $service_query);

            $serial = 1;
            foreach($service_query_db as $service_data):
          ?>
            <tr>
              <td><?=$serial++?></td>
              <td><i class="<?=$service_data['service_icon']?>"></i></td>
              <td class="text-nowrap"><?=$service_data['service_title']?></td>
              <td><?=$service_data['service_description']?></td>
              <td class="text-nowrap">
                <?php if($service_data['service_status'] == 1): ?>
                  <a href="services_status_change.php?service_id=<?=$service_data['id']?>&btn=active" class="btn btn-sm btn-warning">Active</a>
                <?php endif; ?>

                <?php if($service_data['service_status'] == 2): ?>
                  <a href="services_status_change.php?service_id=<?=$service_data['id']?>&btn=deactive" class="btn btn-sm btn-success">Deactive</a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 1): ?>
                  <a href="services_update.php?service_id=<?=$service_data['id']?>" class="btn btn-sm btn-info">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger btn_delete" value="services_delete.php?service_id=<?=$service_data['id']?>">Delete</button>
                <?php endif; ?>
              </td>
            </tr>

          <?php
            endforeach;
          ?>
          </tbody>
        </table>
      </div>
      <!-- === adding service start === -->
      <div class="col-lg-4">
        <div class="border px-3">
          <h4 class="text-center pt-3">Add new service</h4>
          <form method="POST" action="service_add_post.php">
            <div class="form-group">
              <label for="service_icon">service icon</label>
              <input type="text" class="form-control" name="service_icon" id="service_icon">
            </div>
            <div class="form-group">
              <label for="service_title">service title</label>
              <input type="text" class="form-control" name="service_title" id="service_title">
            </div>
            <div class="form-group">
              <label for="service_description">service description</label>
              <textarea  class="form-control" name="service_description" id="service_description" rows="4"></textarea>
            </div>
            <div class="form-group text-center">
              <?php  if(isset($_SESSION['service_add_error'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['service_add_error']?></div>
              <?php endif; unset($_SESSION['service_add_error']); ?>

              <?php  if(isset($_SESSION['service_add_success'])): ?>
                <div class="alert alert-success"><?=$_SESSION['service_add_success']?></div>
              <?php endif; unset($_SESSION['service_add_success']); ?>

              <button type="sumbit" class="btn btn-success btn-block">Add</button>
            </div>
          </form>
        </div>
      </div>
      <!-- ===//end of adding service === -->
    </div>
  </div>
</div>


 

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>

<script>
  $(document).ready(function(){
    $('#service_table').on('click', '.btn_delete', function(){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
        var delete_link = $(this).val();
        window.location.href = delete_link;
        }
      })
    })

    $('#service_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 20, -1], [10, 20, 'All']]
    });
  })
</script>
