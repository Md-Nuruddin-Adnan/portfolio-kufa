<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Portfolio' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$testimonial_select_query = "SELECT * FROM testimonials";
$testimonial_db = mysqli_query($db_connect, $testimonial_select_query);

?>

<div class="card" id="testimonial">
  <div class="card-header text-center bg-white">
    <h2>Testimonial</h2>
  </div>
  <div class="card-body">

    <?php if(isset($_SESSION['testimonial_edit_error'])): ?>
      <div class="alert alert-danger"><?=$_SESSION['testimonial_edit_error']?></div>
    <?php endif; unset($_SESSION['testimonial_edit_error']);?>

    <?php if(isset($_SESSION['testimonial_edit_success'])): ?>
      <div class="alert alert-success"><?=$_SESSION['testimonial_edit_success']?></div>
    <?php endif; unset($_SESSION['testimonial_edit_success']);?>

    <div class="row">
      <div class="col-lg-8">
      <?php if(isset($_SESSION['active_status'])):?>
        <div class="alert alert-danger"><?=$_SESSION['active_status']?></div>
      <?php endif; unset($_SESSION['active_status']);?>
      <?php
        $active_testimonial_query = "SELECT COUNT(*) AS active_count FROM testimonials WHERE testimonial_status = 2";
        $active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_testimonial_query));
      ?>
      <h4 class="mb-3 pt-3">Testimonial List (Active: <?=$active_count['active_count'];?>)</h4>
       <table class="table table-responsive" id="testimonial_table">
         <thead>
           <tr class="text-nowrap">
             <th>Sl. No</th>
             <th>Name</th>
             <th>Designation</th>
             <th>Review</th>
             <th>Image</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           $serial = 1;
           foreach($testimonial_db as $testimonial):
           ?>
           <tr>
             <td><?=$serial++?></td>
             <td class="text-nowrap"><?=strtoupper($testimonial['customer_name'])?></td>
             <td><?=ucwords(strtolower($testimonial['customer_designation']))?></td>
             <td><?=$testimonial['customer_review']?></td>
             <td><img src="../uploads/images/testimonials/<?=$testimonial['customer_image']?>" alt="<?=$testimonial['customer_image']?>"> </td>
             <td class="text-nowrap">
             <?php if($testimonial['testimonial_status'] == 1): ?>
              <a href="testimonial_status_change.php?customer_id=<?=$testimonial['id']?>&btn=active" class="btn btn-sm btn-warning">Active</a>
             <?php endif; ?>

             <?php if($testimonial['testimonial_status'] == 2): ?>
              <a href="testimonial_status_change.php?customer_id=<?=$testimonial['id']?>&btn=deactive" class="btn btn-sm btn-success">Deactive</a>
             <?php endif; ?>

             <?php if($_SESSION['user_role'] == 1): ?>
              <a href="testimonial_edit.php?customer_id=<?=$testimonial['id']?>" class="btn btn-sm btn-info">Edit</a>
              <button type="button" class="btn btn-sm btn-danger btn_delete" value="testimonial_delete.php?customer_id=<?=$testimonial['id']?>">Delete</button>
             <?php endif; ?>
             </td>
           </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
      </div>
     <!-- === Adding testimonial start === -->
     <div class="col-lg-4">
        <div class="border px-3">
          <h4 class="text-center pt-3">Add Testimonial</h4>
          <form method="POST" action="testimonial_add.php"  enctype="multipart/form-data">
            <div class="form-group">
              <label for="customer_name">Customer Name</label>
              <input type="text" class="form-control" name="customer_name" id="customer_name">
            </div>
            <div class="form-group">
              <label for="customer_designation">Customer Designation</label>
              <input type="text" class="form-control" name="customer_designation" id="customer_designation">
            </div>
            <div class="form-group">
              <label for="customer_review">Customer Review</label>
              <textarea type="text" class="form-control" name="customer_review" rows="4" id="customer_review"></textarea>
            </div>
            <div class="form-group">
              <label for="customer_image">Customer Image</label>
              <input type="file" class="form-control" name="customer_image" id="customer_image">
            </div>

            <?php if(isset($_SESSION['testimonial_error'])): ?>
              <div class="alert alert-danger"><?=$_SESSION['testimonial_error']?></div>
            <?php endif; unset($_SESSION['testimonial_error']);?>

            <?php if(isset($_SESSION['testimonial_success'])): ?>
              <div class="alert alert-success"><?=$_SESSION['testimonial_success']?></div>
            <?php endif; unset($_SESSION['testimonial_success']);?>

            <div class="form-group text-center">
              <button type="sumbit" class="btn btn-success btn-block">Add</button>
            </div>
          </form>
        </div>
      </div>
      <!-- ===//end of Adding testimonial === -->
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
    $('#testimonial_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 10, 20, -1], [10, 10, 20, 'All']]
    });
    //Ddata table end

    // Sweetalert delete start
    $('#testimonial_table').on('click', '.btn_delete', function(){
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

