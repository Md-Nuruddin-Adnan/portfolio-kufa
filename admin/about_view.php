<?php
require_once('AUTH/auth.php');
require_once('../includes/db.php');
$title = 'About' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');

$about_selet_query = "SELECT * FROM about";
$about_information = mysqli_fetch_assoc(mysqli_query($db_connect, $about_selet_query));
?>

<h2 class="text-center">About me</h2>

<div class="row bg-white p-4">
  <div class="col-lg-4">
    <div class="about_image">
      <img src="../uploads/images/about/<?=$about_information['about_image']?>" alt="<?=$about_information['about_image']?>" class="img-fluid">
    </div>
  </div>
  <div class="col-lg-8" style="display: grid; place-items: center">
  
    <?php if(isset($_SESSION['about_edit_error'])): ?>
      <div class="alert alert-danger"><?=$_SESSION['about_edit_error']?></div>
    <?php endif; unset($_SESSION['about_edit_error']);?>

    <?php if(isset($_SESSION['about_edit_success'])): ?>
      <div class="alert alert-success"><?=$_SESSION['about_edit_success']?></div>
    <?php endif; unset($_SESSION['about_edit_success']);?>

    <div class="about_description">
      <h3>About Description</h3>
      <p><?=$about_information['about_description']?> </p>
      <a href="about_edit.php" class="btn btn-info">Edit</a>
    </div>
  </div>
</div>

<!-- === Education start === -->
<h2 class="text-center my-4" id="education_section">Education</h2>

<div class="row bg-white p-4">
  <div class="col-lg-8">

    <?php if(isset($_SESSION['education_edit_error'])): ?>
      <div class="alert alert-danger"><?=$_SESSION['education_edit_error']?></div>
    <?php endif; unset($_SESSION['education_edit_error']);?>

    <?php if(isset($_SESSION['education_edit_success'])): ?>
      <div class="alert alert-success"><?=$_SESSION['education_edit_success']?></div>
    <?php endif; unset($_SESSION['education_edit_success']);?>

    <?php
      $education_select_query = "SELECT * FROM educations ORDER BY passing_year DESC";
      $education_db =mysqli_query($db_connect, $education_select_query);
    ?>
    <table class="table table-responsive-xl" id="education_table">
      <thead>
        <tr>
          <th>Sl. No</th>
          <th>Education Name</th>
          <th>Passing Year</th>
          <th>Progress</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $serial = 1;
          foreach($education_db as $education):
        ?>
        <tr>
          <td><?=$serial++?></td>
          <td><?=$education['education_name']?></td>
          <td><?=$education['passing_year']?></td>
          <td><?=$education['progress']?>%</td>
          <td class="text-nowrap">
            <?php if($_SESSION['user_role'] == 1): ?>
              <a href="education_edit.php?education_id=<?=$education['id']?>" class="btn btn-sm btn-info">Edit</a>
              <button type="button" class="btn btn-sm btn-danger btn_delete" value="education_delete.php?education_id=<?=$education['id']?>">Delete</button>
            <?php endif; ?>
          </td>
        </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="col-lg-4">
    <form action="education_add_post.php" method="POST" class="p-4 border">
      <div class="form-group">
        <label for="education_name">Education Name</label>
        <input name="education_name" id="education_name" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label for="passing_year">Passing Year</label>
        <input name="passing_year" id="passing_year" type="number" class="form-control">
      </div>
      <div class="form-group">
        <label for="progress">Progress</label>
        <input name="progress" id="progress" type="number" class="form-control">
      </div>

      <?php if(isset($_SESSION['education_add_error'])): ?>
        <div class="alert alert-danger"><?=$_SESSION['education_add_error']?></div>
      <?php endif; unset($_SESSION['education_add_error']);?>

      <?php if(isset($_SESSION['education_add_success'])): ?>
        <div class="alert alert-success"><?=$_SESSION['education_add_success']?></div>
      <?php endif; unset($_SESSION['education_add_success']);?>
      
      <div class="form-group">
       <button type="submit" class="btn btn-success btn-block">Add New</button>
      </div>
    </form>
  </div>
</div>
<!-- === Education End === -->

<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>

<script>
  $(document).ready(function(){
    $('#education_table').on('click', '.btn_delete', function(){
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

    $('#education_table').DataTable({
      pageLength : 10,
      lengthMenu: [[10, 20, -1], [10, 20, 'All']]
    });
  })
</script>

