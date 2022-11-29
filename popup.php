<?php
get_header();

/**
 * This is pop up contact form
 * Template Name: Pop Up
 */

 
?>

<section id="body-area">
    <div class="container single-page">
        <div class="row">
            <div class="col-md-9"> 
          
            <?php 


            // $contact_email="";
         
              if(isset($_GET['success'])): 
                ?>
              <div class="alert alert-success">
                <h3>Congrats! Your Form Submitted Successfully.</h3>
              </div>
              <?php endif; 
                 ;
                ?>

          <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger">
              <h3>Sorry! Unable to submit the form.</h3>
            </div>
          <?php endif; ?>

          <?php 
     
          ?>
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" name="contact_form" id="formid" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="utf-8" >

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="contact_full_name" class="form-control" placeholder="Enter your Name" required="">
                </div>
                <div class="form-group">
                    <label for="contact_email">Email</label>
                    <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Enter your E-mail" required="">
                </div>
                <div class="form-group">
                    <label for="contact_message">Message</label>
                    <textarea class="form-control" name="contact_message" id="contact_message" cols="10" rows="3"></textarea>
                </div>
                
              <input type="hidden" name="action" value="contact_form">
              <input type="hidden" name="base_page" value="<?php echo home_url( $wp->request ); ?>">


              <input type="submit" name="submit_btn" value="Submit" class="techIT-btn mt-3">
            </form>
            </div>
            <div class="col-md-3"> 
              <button class="popmake-264 btn techIt-btn">Pop Up button</button>
            <?php get_sidebar();?> 
          
          </div>
        </div>
    </div> 
</section>
     
<?php get_footer();?>