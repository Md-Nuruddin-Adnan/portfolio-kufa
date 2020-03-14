<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Service';
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
?>

<div class="card">
  <div class="card-header text-center bg-white">
    <h2>Counter</h2>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-8">
      <?php if(isset( $_SESSION['counter_update_error'])):?>
        <div class="alert alert-danger"><?= $_SESSION['counter_update_error']?></div>
      <?php endif; unset( $_SESSION['counter_update_error']);?>

      <?php if(isset($_SESSION['counter_update_success'])):?>
        <div class="alert alert-success"><?=$_SESSION['counter_update_success']?></div>
      <?php endif; unset($_SESSION['counter_update_success']);?>

      <?php if(isset($_SESSION['active_status'])):?>
        <div class="alert alert-danger"><?=$_SESSION['active_status']?></div>
      <?php endif; unset($_SESSION['active_status']);?>

      <?php
        $active_counter_query = "SELECT COUNT(*) AS active_count FROM counters WHERE counter_status = 2";
        $active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_counter_query));
      ?>
      <h4 class="mb-3">Counter List (Active: <?=$active_count['active_count'];?>)</h4>

      <table class="table table-striped table-sm table-responsive-xl" id="counter_table">
          <thead>
            <tr class="text-nowrap">
              <th class="pb-3">Sl. No</th>
              <th class="pb-3">Counter Icon</th>
              <th class="pb-3">Counter Count</th>
              <th class="pb-3">Counter Name</th>
              <th class="pb-3">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $counter_query = "SELECT * FROM counters";
            $counter_query_db = mysqli_query($db_connect, $counter_query);

            $serial = 1;
            foreach($counter_query_db as $counter_data):
          ?>
            <tr>
              <td><?=$serial++?></td>
              <td><i class="<?=$counter_data['counter_icon']?>"></i></td>
              <td><?=$counter_data['counter_count']?></td>
              <td><?=$counter_data['counter_name']?></td>
              <td class="text-nowrap">
                <?php if($counter_data['counter_status'] == 1): ?>
                  <a href="counter_status_change.php?counter_id=<?=$counter_data['id']?>&btn=active" class="btn btn-sm btn-warning">Active</a>
                <?php endif; ?>

                <?php if($counter_data['counter_status'] == 2): ?>
                  <a href="counter_status_change.php?counter_id=<?=$counter_data['id']?>&btn=deactive" class="btn btn-sm btn-success">Deactive</a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 1): ?>
                  <a href="counter_edit.php?counter_id=<?=$counter_data['id']?>" class="btn btn-sm btn-info">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger btn_delete" value="counter_delete.php?counter_id=<?=$counter_data['id']?>">Delete</button>
                <?php endif; ?>
              </td>
            </tr>

          <?php
            endforeach;
          ?>
          </tbody>
        </table>
      </div>

       <!-- === adding new counter start === -->
       <div class="col-lg-4">
        <div class="border px-3">
          <h4 class="text-center pt-3">Add new counter</h4>
          <form method="POST" action="counter_add_post.php">
            <div class="form-group">
              <label for="counter_icon">Counter icon</label>
              <input type="text" class="form-control" name="counter_icon" id="counter_icon">
            </div>
            <div class="form-group">
              <label for="counter_count">Counter count</label>
              <input type="text" class="form-control" name="counter_count" id="counter_count">
            </div>
            <div class="form-group">
              <label for="counter_name">Counter name</label>
              <input type="text"  class="form-control" name="counter_name" id="counter_name">
            </div>
            <div class="form-group text-center">
              <?php  if(isset($_SESSION['counter_add_error'])): ?>
                  <div class="alert alert-danger"><?= $_SESSION['counter_add_error']?></div>
              <?php endif; unset($_SESSION['counter_add_error']); ?>

              <?php  if(isset($_SESSION['counter_add_success'])): ?>
                <div class="alert alert-success"><?=$_SESSION['counter_add_success']?></div>
              <?php endif; unset($_SESSION['counter_add_success']); ?>

              <button type="sumbit" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
      <!-- ===//end of adding new counter === -->
    </div>
  </div>
</div>

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>


<script>
  $(document).ready(function(){
    $('#counter_table').on('click', '.btn_delete', function(){
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

    $('#counter_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 20, -1], [10, 20, 'All']]
    });
  })
</script>