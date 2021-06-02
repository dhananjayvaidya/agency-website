
<section class='page-header'>
  <div class="container">
    <div class='row'>
      <div class="col-md-12">
        <h1><?php echo $page_title;?></h1>
      </div>
    </div>
  </div>
</section>
  <main id="main">

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Team</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem</p>
        </div>

        <div class="row">
          <?php foreach($teams as $team){ //start loop
          ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="<?php echo base_url($team['profile_photo']);?>" class="img-fluid" alt="">
                <div class="social">
                  <?php 
                    if ($team['fb_link'] !== "" ){ echo "<a href='".$team['fb_link']."'><i class='icofont-facebook'></i></a>";} 
                    if ($team['tw_link'] !== "" ){ echo "<a href='".$team['tw_link']."'><i class='icofont-twitter'></i></a>";} 
                    if ($team['ln_link'] !== "" ){ echo "<a href='".$team['ln_link']."'><i class='icofont-linkedin'></i></a>";} 
                  ?>
                </div>
              </div>
              <div class="member-info">
                <h4><?php echo $team['full_name'];?></h4>
                <span><?php echo $team['designation'];?></span>
              </div>
            </div>
          </div>
          <?php 
          } //closing foreach loop
          ?>
        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->
