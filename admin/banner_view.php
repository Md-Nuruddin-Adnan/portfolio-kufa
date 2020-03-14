<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'Banner' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$banner_select_query = "SELECT * FROM banners";
$banner_data = mysqli_fetch_assoc(mysqli_query($db_connect, $banner_select_query));

?>


  
<h2 class="text-center">Banner</h2>



<div class="row mb-4 bg-white shadow-sm" id="my_summary">
  <div class="col-lg-6 m-auto">
    <div class="p-4 ">
      <h4 class="text-nowrap">My Name:</h4>
      <p><?=$banner_data['my_name']?></p>
      <h4 class="text-nowrap">My Description:</h4>
      <p><?=$banner_data['my_description']?></p>

      <?php if(isset($_SESSION['banner_edit_error'])): ?>
        <div class="alert alert-danger"><?=$_SESSION['banner_edit_error']?></div>
      <?php endif; unset($_SESSION['banner_edit_error']);?>

      <?php if(isset($_SESSION['banner_edit_success'])): ?>
        <div class="alert alert-success"><?=$_SESSION['banner_edit_success']?></div>
      <?php endif; unset($_SESSION['banner_edit_success']);?>

      <div class="text-center">
        <a class="btn btn-info" href="banner_edit.php?banner_id=<?=$banner_data['id']?>">Edit</a>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4 bg-white shadow-sm" id="my_image">
  <div class="col-lg-6 m-auto">
    <div class="p-4 text-center">
      <img src="../uploads/images/banner/<?=$banner_data['my_image']?>" class="img-fluid" alt="<?=$banner_data['my_image']?>">
      <div class="text-center pt-4">
        <?php if(isset($_SESSION['my_image_edit_success'])): ?>
          <div class="alert alert-success"><?=$_SESSION['my_image_edit_success']?></div>
        <?php endif; unset($_SESSION['my_image_edit_success'])?>

        <?php if(isset($_SESSION['my_image_edit_error'])): ?>
          <div class="alert alert-danger"><?=$_SESSION['my_image_edit_error']?></div>
        <?php endif; unset($_SESSION['my_image_edit_error'])?>
        <button id="banner_image_btn" class="btn btn-info" type="button" data-toggle="collapse" data-target="#banner_image_accordion" onclick="document.getElementById('banner_image_btn').style.display = 'none'">
        Edit
        </button>
        <div class="collapse" id="banner_image_accordion">
          <div class="card card-body">
            <form action="banner_image_post.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" name="banner_id" value="<?=$banner_data['id']?>">
                <input type="file" name="my_image" class="form-control">
              </div>
              <div class="form-group">
                <button class="btn btn-info">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row bg-white" id="social_link_section">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header bg-white text-center">
        <h3>Social Link</h3>
      </div>
      <div class="card-body">

        <?php if(isset($_SESSION['social_link_edit_error'])): ?>
          <div class="alert alert-danger"><?=$_SESSION['social_link_edit_error']?></div>
        <?php endif; unset($_SESSION['social_link_edit_error'])?>

        <?php if(isset($_SESSION['social_link_edit_success'])): ?>
          <div class="alert alert-success"><?=$_SESSION['social_link_edit_success']?></div>
        <?php endif; unset($_SESSION['social_link_edit_success'])?>

        <table class="table table-responsive-xl" id="social_link_table">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Social Icon</th>
              <th>Social Link</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $social_link_query = "SELECT * FROM social_links";
              $social_link_db = mysqli_query($db_connect, $social_link_query);
              $serial = 1;
              foreach($social_link_db as $social_link):
            ?>
            <tr>
              <td><?=$serial++?></td>
              <td><i class="<?=$social_link['social_icon']?>"></i></td>
              <td><?=$social_link['social_link']?></td>
              <td class="text-nowrap">
                <?php if($_SESSION['user_role'] == 1): ?>
                  <a href="social_link_edit.php?social_link_id=<?=$social_link['id']?>" class="btn btn-sm btn-info">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger btn_delete" value="social_link_delete.php?social_link_id=<?=$social_link['id']?>">Delete</button>
                <?php endif; ?>
              </td>
            </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="my-3 p-3 border">
      <div class="text-center">
        <h3>Add New Link</h3>
      </div>
      <form action="social_link_add_post.php" method="POST">
        <div class="form-group">
          <label for="social_icon">Social Icon</label>
          <input type="text" name="social_icon" id="social_icon" class="form-control">
        </div>
        <div class="form-group">
          <label for="social_link">Social Link</label>
          <input type="text" name="social_link" id="social_link" class="form-control">
        </div>

        <?php if(isset($_SESSION['social_link_add_error'])): ?>
          <div class="alert alert-danger"><?=$_SESSION['social_link_add_error']?></div>
        <?php endif; unset($_SESSION['social_link_add_error'])?>

        <?php if(isset($_SESSION['social_link_add_success'])): ?>
          <div class="alert alert-success"><?=$_SESSION['social_link_add_success']?></div>
        <?php endif; unset($_SESSION['social_link_add_success'])?>

        <div class="form-group text-center">
          <button type="sumbit" class="btn btn-info">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>



<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>

<script>
  $(document).ready(function(){
    $('#social_link_table').on('click', '.btn_delete', function(){
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

    $('#social_link_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 20, -1], [10, 20, 'All']]
    });
  })
</script>