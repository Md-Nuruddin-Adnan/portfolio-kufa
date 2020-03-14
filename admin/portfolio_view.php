<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Portfolio' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$portfolio_select_query = "SELECT * FROM portfolios";
$portfolio_db = mysqli_query($db_connect, $portfolio_select_query);

?>

<style>
  .dataTables_wrapper .dataTable .btn {
    padding: .5rem .3rem .5rem .5rem !important;
  }
</style>

<div class="card" id="portfolio">
  <div class="card-header text-center bg-white">
    <h2>Portfolio</h2>
  </div>
  <div class="card-body">

    <?php if(isset($_SESSION['portfolio_edit_error'])): ?>
      <div class="alert alert-danger"><?=$_SESSION['portfolio_edit_error']?></div>
    <?php endif; unset($_SESSION['portfolio_edit_error']);?>

    <?php if(isset($_SESSION['portfolio_edit_success'])): ?>
      <div class="alert alert-success"><?=$_SESSION['portfolio_edit_success']?></div>
    <?php endif; unset($_SESSION['portfolio_edit_success']);?>

    <div class="row">
      <div class="col-md-8">
        <?php if(isset($_SESSION['active_status'])):?>
          <div class="alert alert-danger"><?=$_SESSION['active_status']?></div>
        <?php endif; unset($_SESSION['active_status']);?>
        <?php
          $active_portfolio_query = "SELECT COUNT(*) AS active_count FROM portfolios WHERE portfolio_status = 2";
          $active_count = mysqli_fetch_assoc(mysqli_query($db_connect, $active_portfolio_query));
        ?>
        <h4 class="mb-3 pt-3">Portfolio List (Active: <?=$active_count['active_count'];?>)</h4>
       <table class="table table-sm table-responsive" id="portfolio_table">
         <thead>
           <tr class="text-nowrap">
             <th>Sl. No</th>
             <th>Portfolio category</th>
             <th>Portfolio Name</th>
             <th>Portfolio Information</th>
             <th>Portfolio Image</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           $serial = 1;
           foreach($portfolio_db as $portfolio):
           ?>
           <tr>
             <td><?=$serial++?></td>
             <td><?=strtoupper($portfolio['portfolio_category'])?></td>
             <td><?=ucwords(strtolower($portfolio['portfolio_name']))?></td>
             <td><?=$portfolio['portfolio_information']?></td>
             <td><img src="../uploads/images/portfolios/<?=$portfolio['portfolio_image']?>" alt="<?=$portfolio['portfolio_image']?>"> </td>
             <td class="text-nowrap">
              <?php if($portfolio['portfolio_status'] == 1): ?>
                <a href="portfolio_status_change.php?portfolio_id=<?=$portfolio['id']?>&btn=active" class="btn btn-sm btn-warning"><i class="fas fa-eye-slash"></i></a>
              <?php endif; ?>

              <?php if($portfolio['portfolio_status'] == 2): ?>
                <a href="portfolio_status_change.php?portfolio_id=<?=$portfolio['id']?>&btn=deactive" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
              <?php endif; ?>
              <a href="portfolio_edit.php?portfolio_id=<?=$portfolio['id']?>" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
              <button type="button" class="btn btn-sm btn-danger btn_delete" value="portfolio_delete.php?portfolio_id=<?=$portfolio['id']?>"><i class="fas fa-trash-alt"></i></button>
             </td>
           </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
      </div>
     <!-- === Adding portfolio start === -->
     <div class="col-md-4 col-sm-12">
        <div class="border px-3">
          <h4 class="text-center pt-3">Add Portfolio</h4>
          <form method="POST" action="portfolio_add.php"  enctype="multipart/form-data">
            <div class="form-group">
              <label for="portfolio_category">Portfolio category</label>
              <input type="text" class="form-control" name="portfolio_category" id="portfolio_category">
            </div>
            <div class="form-group">
              <label for="portfolio_name">Portfolio name</label>
              <input type="text" class="form-control" name="portfolio_name" id="portfolio_name">
            </div>
            <div class="form-group">
              <label for="portfolio_image">portfolio image</label>
              <input type="file" class="form-control" name="portfolio_image" id="portfolio_image">
            </div>
            <div class="form-group">
              <label for="portfolio_information">Portfolio information</label>
              <textarea class="form-control" name="portfolio_information" id="portfolio_information" rows="4"></textarea>
            </div>

            <?php if(isset($_SESSION['portfolio_error'])): ?>
              <div class="alert alert-danger"><?=$_SESSION['portfolio_error']?></div>
            <?php endif; unset($_SESSION['portfolio_error']);?>

            <?php if(isset($_SESSION['portfolio_success'])): ?>
              <div class="alert alert-success"><?=$_SESSION['portfolio_success']?></div>
            <?php endif; unset($_SESSION['portfolio_success']);?>

            <div class="form-group text-center">
              <button type="sumbit" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
      <!-- ===//end of Adding portfolio === -->
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
    $('#portfolio_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 10, 20, -1], [10, 10, 20, 'All']]
    });
    //Ddata table end

    // Sweetalert delete start
    $('#portfolio_table').on('click', '.btn_delete', function(){
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

