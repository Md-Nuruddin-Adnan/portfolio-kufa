<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Portfolio' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$brand_selet_query = "SELECT * FROM brands";
$brand_db = mysqli_query($db_connect, $brand_selet_query);

?>

<div class="card" id="brand">
  <div class="card-header text-center bg-white">
    <h2>Brand</h2>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-8">
      <?php if(isset($_SESSION['brand_edit_error'])): ?>
        <div class="alert alert-danger"><?=$_SESSION['brand_edit_error']?></div>
      <?php endif; unset($_SESSION['brand_edit_error']);?>

      <?php if(isset($_SESSION['brand_edit_success'])): ?>
        <div class="alert alert-success"><?=$_SESSION['brand_edit_success']?></div>
      <?php endif; unset($_SESSION['brand_edit_success']);?>
       <table class="table table-responsive-xl" id="brand_table">
         <thead>
           <tr class="text-nowrap">
             <th>Sl. No</th>
             <th>Brand Image</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           $serial = 1;
           foreach($brand_db as $brand):
           ?>
           <tr>
             <td><?=$serial++?></td>
             <td><img src="../uploads/images/brands/<?=$brand['brand_image']?>" alt="<?=$brand['brand_image']?>"> </td>
             <td class="text-nowrap">
             <?php if($brand['brand_status'] == 1): ?>
              <a href="brand_status_change.php?brand_id=<?=$brand['id']?>&btn=active" class="btn btn-sm btn-warning">Active</a>
             <?php endif; ?>

             <?php if($brand['brand_status'] == 2): ?>
              <a href="brand_status_change.php?brand_id=<?=$brand['id']?>&btn=deactive" class="btn btn-sm btn-success">Deactive</a>
             <?php endif; ?>

             <?php if($_SESSION['user_role'] == 1): ?>
              <a href="brand_edit.php?brand_id=<?=$brand['id']?>" class="btn btn-sm btn-info">Edit</a>
              <button type="button" class="btn btn-sm btn-danger btn_delete" value="brand_delete.php?brand_id=<?=$brand['id']?>">Delete</button>
             <?php endif; ?>
             </td>
           </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
      </div>
     <!-- === Adding Brand start === -->
     <div class="col-lg-4">
        <div class="border px-3">
          <h4 class="text-center pt-3">Add Brand</h4>
          <form method="POST" action="brand_add.php"  enctype="multipart/form-data">
            <div class="form-group">
              <label for="brand_image">Brand Image</label>
              <input type="file" class="form-control" name="brand_image" id="brand_image">
            </div>

            <?php if(isset($_SESSION['brand_error'])): ?>
              <div class="alert alert-danger"><?=$_SESSION['brand_error']?></div>
            <?php endif; unset($_SESSION['brand_error']);?>

            <?php if(isset($_SESSION['brand_success'])): ?>
              <div class="alert alert-success"><?=$_SESSION['brand_success']?></div>
            <?php endif; unset($_SESSION['brand_success']);?>

            <div class="form-group text-center">
              <button type="sumbit" class="btn btn-success btn-block">Add</button>
            </div>
          </form>
        </div>
      </div>
      <!-- ===//end of Adding Brand === -->
    </div>
  </div>
</div>


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>

<script>
  $(document).ready(function(){
    // Data table start
    $('#brand_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 10, 20, -1], [10, 10, 20, 'All']]
    });
    //Ddata table end

    // Sweetalert delete start
    $('#brand_table').on('click', '.btn_delete', function(){
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
    //Sweetalert delete end

  })
</script>

