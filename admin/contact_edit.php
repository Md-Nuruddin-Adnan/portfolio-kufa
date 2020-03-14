<?php
require_once('AUTH/auth.php');
require_once('includes/role.php');
require_once('../includes/db.php');
$title = 'Contact' ;
require_once('includes/dashboard_header.php');
require_once('includes/top_nav.php');
require_once('includes/sidebar.php');
$contact_select_query = "SELECT * FROM contacts";
$contact_information = mysqli_fetch_assoc(mysqli_query($db_connect, $contact_select_query));
?>

<style>
  .contact-content span {
    padding-right: 10px;
    font-weight: 700;
    width: 200px
  }

  .contact-list li {
    list-style: none;
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .contact-list ul li i {
    color: #8cc090;
    font-size: 14px;
    margin-right: 10px;
  }
</style>

<form action="contact_edit_post.php" method="POST">
<div class="card ">
  <div class="card-header text-center bg-white">
    <h2>Contact</h2>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-xl-6 col-lg-8 m-auto">
        <div class="section-title mb-20">
          <h3>Contact Information</h3>
        </div>
        <div class="contact-content">
          <p>
          <textarea name="contact_information" type="text" class="form-control" rows="4"><?=$contact_information['contact_information']?></textarea>
          </p>
          <h5 class="d-flex align-items-center text-nowrap">
             <span>OFFICE IN:</span>
             <input name="office_location" type="text" class="form-control" value="<?=$contact_information['office_location']?>"> 
          </h5>
          <div class="contact-list">
            <ul class="pl-0 text-nowrap">
              <li>
                <span><i class="fas fa-map-marker"></i>Address: </span> 
                <input type="text" name="address" class="form-control" value="<?=$contact_information['address']?>"> 
              </li>
              <li>
                <span><i class="fas fa-headphones"></i>Phone: +880 </span>
                <input name="phone" type="text" class="form-control" value="<?=$contact_information['phone']?>"> 
              </li>
              <li>
                <span><i class="fas fa-globe-asia"></i>e-mail: </span>
                <input name="email" type="text" class="form-control" value=" <?=$contact_information['email']?>"> 
              </li>
            </ul>
          </div>
        </div>
        <?php if(isset($_SESSION['contact_edit_error'])):?>
          <div class="alert alert-danger"><?= $_SESSION['contact_edit_error']?></div>
        <?php endif; unset($_SESSION['contact_edit_error']);?>
        <div class="text-center">
          <button type="submit" class="btn btn-info px-xl-5">Update</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>


<?php
  require_once('includes/copyright.php');
  require_once('includes/dashboard_footer.php');
?>