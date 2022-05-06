<!-- Main Ad Section -->
    <section class="slider_section" style="background-color:#f2f2f2">
        <?php $this->renderPartial('slider',array('data'=>$data)); ?> 
    </section>
    <!-- Main Ad Section End-->
    <!-- Welcome Section Start -->
     <section id="welcome" class="section">
     	<div class="container">
            <h1 class="section-title"><?= $data['homeWelcome']->title;?></h1>
        	<hr class="lines">
            <?= $data['homeWelcome']->description;?>
            
        </div>
     </section>
    <!-- Welcome Section End -->

    <!-- New Products Section Start-->
    <section class="section grey_bg">
        <?php $this->renderPartial('home_page_products',array('data'=>$data)); ?> 
    </section>
    <!-- New Products Section End -->

    

    <!-- Features Section Starts -->
    <section id="features" class="section features">
      <!-- Container Starts -->
        <?php $this->renderPartial('home_features',array('data'=>$data)); ?> 
      <!-- Container Ends -->
    </section>
    <!-- Features Section Ends -->



    <!-- Services Section Start -->
    <section class="services section"> 
      <!-- Container Starts -->
        <?php $this->renderPartial('home_services',array('data'=>$data)); ?> 
      <!-- Container Ends -->
    </section>
    <!-- Services Section End -->
    
    

	<!-- Ready Service Start -->
    <div class="paralax_container paralaxbg" style="background-image:url(<?= Yii::app()->theme->baseUrl;?>/assets/img/paralax/ready-service.jpg); padding:60px 0px;">
		<div class="container text-center">
        	<h1>Ready to Take <span>Our Services</span>?</h1><br>
            <a href="<?= Yii::app()->createUrl('//category/all')?>" class="btn btn-red">Shop Now</a>
		</div><!-- /.content -->
	</div><!-- /.container -->
    <!-- Ready Service End -->


    <!-- Map Section Start -->
    	<section class="map_section">
        	<div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3717.4496403881035!2d-157.8238454850629!3d21.293242285855662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c006d9086d79603%3A0x4833b74997941cdb!2s1110+University+Ave+%23404%2C+Honolulu%2C+HI+96826%2C+USA!5e0!3m2!1sen!2sbd!4v1507807189410" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

          </div>
        </section>
    <!-- Map Section End -->