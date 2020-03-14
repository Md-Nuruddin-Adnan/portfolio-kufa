<?php
session_start();
require_once('includes/header.php');
require_once('includes/db.php');
?>

<!-- preloader -->
<div id="preloader">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
        </div>
    </div>
</div>
<!-- preloader-end -->

<!-- header-start -->
<header>
    <div id="header-sticky" class="transparent-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="main-menu">
                        <nav class="navbar navbar-expand-lg">
                            <?php 
                                $light_logo_query = "SELECT * FROM logos WHERE logo_color = 'light'";
                                $light_logo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $light_logo_query))['logo_image'];
                            ?>
                                <a href="index.php" class="navbar-brand logo-sticky-none"><img src="uploads/images/logo/<?=$light_logo_name?>" alt="uploads/images/logo/<?=$light_logo_name?>"></a>

                            <?php 
                                $dark_logo_query = "SELECT * FROM logos WHERE logo_color = 'dark'";
                                $dark_logo_name = mysqli_fetch_assoc(mysqli_query($db_connect, $dark_logo_query))['logo_image'];
                            ?>
                            <a href="index.html" class="navbar-brand s-logo-none"><img src="uploads/images/logo/<?=$dark_logo_name?>" alt="uploads/images/logo/<?=$darkt_logo_name?>"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarNav">
                                <span class="navbar-icon"></span>
                                <span class="navbar-icon"></span>
                                <span class="navbar-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active"><a class="nav-link" href="#home">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#about">about</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#service">service</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#portfolio">portfolio</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                                </ul>
                            </div>
                            <div class="header-btn">
                                <a href="#" class="off-canvas-menu menu-tigger"><i class="flaticon-menu"></i></a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas-start -->
    <div class="extra-info">
        <div class="close-icon menu-close">
            <button>
                <i class="far fa-window-close"></i>
            </button>
        </div>
        <div class="logo-side mb-30">
            <a href="index-2.html">
                <img src="img/logo/logo.png" alt="" />
            </a>
        </div>
        <div class="side-info mb-30">
            <div class="contact-list mb-30">
                <h4>Office Address</h4>
                <p>123/A, Miranda City Likaoli
                    Prikano, Dope</p>
            </div>
            <div class="contact-list mb-30">
                <h4>Phone Number</h4>
                <p>+0989 7876 9865 9</p>
            </div>
            <div class="contact-list mb-30">
                <h4>Email Address</h4>
                <p>info@example.com</p>
            </div>
        </div>
        <div class="social-icon-right mt-20">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
    <div class="offcanvas-overly"></div>
    <!-- offcanvas-end -->
</header>
<!-- header-end -->

<!-- main-area -->
<main>

    <!-- banner-area -->
    <section id="home" class="banner-area banner-bg fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-6">
                    <div class="banner-content">
                        <h6 class="wow fadeInUp" data-wow-delay="0.2s">HELLO!</h6>
                        <?php
                        $banner_select_query = "SELECT * FROM banners";
                        $banner_data = mysqli_fetch_assoc(mysqli_query($db_connect, $banner_select_query));
                        ?>
                        <h2 class="wow fadeInUp" data-wow-delay="0.4s">I am <?=$banner_data['my_name']?></h2>
                        <p class="wow fadeInUp" data-wow-delay="0.6s"><?=$banner_data['my_description']?></p>
                        <div class="banner-social wow fadeInUp" data-wow-delay="0.8s">
                            <ul>
                            <?php
                                $social_link_query = "SELECT * FROM social_links";
                                $social_link_db = mysqli_query($db_connect, $social_link_query);
                               
                                foreach($social_link_db as $social_link):
                            ?>
                                <li><a href="<?=$social_link['social_link']?>" target="_blank"><i class="<?=$social_link['social_icon']?>"></i></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        <a href="#" class="btn wow fadeInUp" data-wow-delay="1s">SEE PORTFOLIOS</a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                    <div class="banner-img text-right">
                        <img src="uploads/images/banner/<?=$banner_data['my_image']?>" alt="<?=$banner_data['my_image']?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape"><img src="assets/img/shape/dot_circle.png" class="rotateme" alt="img"></div>
    </section>
    <!-- banner-area-end -->

    <!-- about-area-->
    <?php
        $about_selet_query = "SELECT * FROM about";
        $about_information = mysqli_fetch_assoc(mysqli_query($db_connect, $about_selet_query));
    ?>
    <section id="about" class="about-area primary-bg pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="uploads/images/about/<?=$about_information['about_image']?>" alt="<?=$about_information['about_image']?>" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 pr-90">
                    <div class="section-title mb-25">
                        <span>Introduction</span>
                        <h2>About Me</h2>
                    </div>
                    <div class="about-content">
                        <p><?=$about_information['about_description']?></p>
                        <h3>Education:</h3>
                    </div>
                    <!-- Education Item -->
                    <?php
                        $education_select_query = "SELECT * FROM educations ORDER BY passing_year DESC";
                        $education_db =mysqli_query($db_connect, $education_select_query);
                        foreach($education_db as $education):
                    ?>
                    <div class="education">
                        <div class="year"><?=$education['passing_year']?></div>
                        <div class="line"></div>
                        <div class="location">
                            <span><?=$education['education_name']?></span>
                            <div class="progressWrapper">
                                <div class="progress">
                                    <div class="progress-bar wow slideInLefts" data-wow-delay="0.2s" data-wow-duration="2s" role="progressbar" style="width:<?=$education['progress']?>%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endforeach; ?>
                    <!-- End Education Item -->
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- Services-area -->
    <section id="service" class="services-area pt-120 pb-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mb-70">
                        <?php
                            $sersvice_heading_qurey = "SELECT * FROM sections_heading WHERE section_name = 'service section'";
                            $sersvice_heading = mysqli_fetch_assoc(mysqli_query($db_connect, $sersvice_heading_qurey));
                        ?>
                        <span><?=$sersvice_heading['top_heading']?></span>
                        <h2><?=$sersvice_heading['main_heading']?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $services_query = "SELECT * FROM services WHERE service_status = 2 ORDER BY id DESC";
                    $services_query_db = mysqli_query($db_connect, $services_query);
                    if($services_query_db->num_rows == 0) :
                ?>
                    <h1 class="text-center w-100">No Service </h1>
                <?php endif; ?>

                <?php
                    foreach($services_query_db as $service_data):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box_01 wow fadeInLeft" data-wow-delay="0.2s">
                        <i class="<?=$service_data['service_icon']?>"></i>
                        <h3><?=$service_data['service_title']?></h3>
                        <p>
                            <?php
                              echo  substr($service_data['service_description'], 0, 100);
                                if(  strlen($service_data['service_description']) >= 100){
                                    echo "...";
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Services-area-end -->

    <!-- Portfolios-area -->
    <section id="portfolio" class="portfolio-area primary-bg pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mb-70">
                        <span>Portfolio Showcase</span>
                        <h2>My Recent Best Works</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $portfolio_select_query = "SELECT * FROM portfolios WHERE portfolio_status = 2 ORDER BY id DESC";
                $portfolios_db = mysqli_query($db_connect, $portfolio_select_query);
                if($portfolios_db->num_rows == 0):
                ?>
                <h1 class="text-center w-100">NO Portfolio to show</h1>
                <?php
                endif; 
                foreach($portfolios_db as $portfolio):
                ?>
                <div class="col-lg-4 col-md-6 pitem">
                    <div class="speaker-box">
                        <div class="speaker-thumb">
                            <img src="uploads/images/portfolios/<?=$portfolio['portfolio_image']?>" alt="img">
                        </div>
                        <div class="speaker-overlay">
                            <span> <?=$portfolio['portfolio_category']?> </span>
                            <h4><a href="portfolio-single.html"><?=$portfolio['portfolio_name']?></a></h4>
                            <a href="portfolio-single.html" class="arrow-btn">More information <span></span></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <!-- services-area-end -->


    <!-- fact-area -->
    <section class="fact-area">
        <div class="container">
            <div class="fact-wrap">
                <div class="row justify-content-between">
                    <?php 
                        $counter_selet_query = "SELECT * FROM counters WHERE counter_status = 2";
                        $counter_data_db = mysqli_query($db_connect, $counter_selet_query);
                        if($counter_data_db->num_rows == 0):
                    ?>
                        <h1 class="text-center w-100">No Counter </h1>
                    <?php
                        endif;
                        foreach($counter_data_db as $counter_data):
                    ?>
                    <div class="col-xl-2 col-lg-3 col-sm-6">
                        <div class="fact-box text-center mb-50">
                            <div class="fact-icon">
                                <i class="<?=$counter_data['counter_icon']?>"></i>
                            </div>
                            <div class="fact-content">
                                <h2><span class="count"><?=$counter_data['counter_count']?></span></h2>
                                <span><?=$counter_data['counter_name']?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- fact-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial-area primary-bg pt-115 pb-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mb-70">
                        <span>testimonial</span>
                        <h2>happy customer quotes</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">
                    <div class="testimonial-active">
                        <?php 
                            $testimonial_selet_query = "SELECT * FROM testimonials WHERE testimonial_status = 2";
                            $testimonial_data_db = mysqli_query($db_connect, $testimonial_selet_query);
                            if($testimonial_data_db->num_rows == 0):
                        ?>
                            <h1 class="text-center w-100">No testimonial found</h1>
                        <?php
                            endif;
                            foreach($testimonial_data_db as $testimonial):
                        ?>
                        <div class="single-testimonial text-center">
                            <div class="testi-avatar">
                            <img src="uploads/images/testimonials/<?=$testimonial['customer_image']?>" alt="<?=$testimonial['customer_image']?>">
                            </div>
                            <div class="testi-content">
                                <h4><span>“</span><?=$testimonial['customer_review']?><span>”</span></h4>
                                <div class="testi-avatar-info">
                                    <h5><?=$testimonial['customer_name']?></h5>
                                    <span><?=$testimonial['customer_designation']?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->

    <!-- brand-area -->
    <div class="barnd-area pt-100 pb-100">
        <div class="container">
            <div class="row brand-active">
                <?php 
                    $brand_selet_query = "SELECT * FROM brands WHERE brand_status = 2";
                    $brnad_data_db = mysqli_query($db_connect, $brand_selet_query);
                    if($brnad_data_db->num_rows == 0):
                ?>
                    <h1 class="text-center w-100">No brand found</h1>
                <?php
                    endif;
                    foreach($brnad_data_db as $brand):
                ?>
                <div class="col-xl-2">
                    <div class="single-brand">
                        <img src="uploads/images/brands/<?=$brand['brand_image']?>" alt="<?=$brand['brand_image']?>">
                        <!-- <img src="assets/img/brand/brand_img01.png" alt="img"> -->
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- brand-area-end -->

    <!-- contact-area -->
    <section id="contact" class="contact-area primary-bg pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title mb-20">
                        <span>information</span>
                        <h2>Contact Information</h2>
                    </div>
                    <div class="contact-content">
                        <?php
                        $contact_select_query = "SELECT * FROM contacts";
                        $contact_information = mysqli_fetch_assoc(mysqli_query($db_connect, $contact_select_query));
                        ?>
                        <p><?=$contact_information['contact_information']?></p>
                        <h5>OFFICE IN <span><?=$contact_information['office_location']?></span></h5>
                        <div class="contact-list">
                            <ul>
                                <li><i class="fas fa-map-marker"></i><span>Address :</span><?=$contact_information['address']?></li>
                                <li><i class="fas fa-headphones"></i><span>Phone :</span>+880 <?=$contact_information['phone']?></li>
                                <li><i class="fas fa-globe-asia"></i><span>e-mail :</span><?=$contact_information['email']?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form" id="contact_form">
                        <form action="visitor_post.php" method="POST">
                            <input type="text" placeholder="your name *" name="visitor_name">
                            <input name="visitor_email" type="text" placeholder="your email *">
                            <textarea name="visitor_message" id="message" placeholder="your message *"></textarea>

                            <?php if(isset($_SESSION['visitor_post_error'])): ?>
                                <div class="alert alert-danger"><?=$_SESSION['visitor_post_error']?></div>
                            <?php endif; unset($_SESSION['visitor_post_error']) ?>

                            <?php if(isset($_SESSION['visitor_post_success'])): ?>
                                <div class="alert alert-success"><?=$_SESSION['visitor_post_success']?></div>
                            <?php endif; unset($_SESSION['visitor_post_success']) ?>

                            <button type="submit" class="btn">SEND</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area-end -->

<!-- footer -->
<footer>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <p>Copyright© <span>Kufa</span> | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-end -->



<?php
require_once('includes/footer.php');
?>