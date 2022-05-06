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
    <div class="paralax_container paralaxbg" style="background-image:url(<?= Yii::app()->theme->baseUrl;?>/assets/img/paralax/ready-service.jpg); padding:60px 0px;display: none;">
        <div class="container text-center">
            <h1>Ready to Take <span>Our Services</span>?</h1><br>
            <a href="<?= Yii::app()->createUrl('//category/all')?>" class="btn btn-red">Shop Now</a>
        </div><!-- /.content -->
    </div><!-- /.container -->
    <!-- Ready Service End -->


    <!-- Map Section Start -->
        <section class="map_section">
            <div>
                <?=$data['homemap']->description;?>
          </div>
        </section>
    <!-- Map Section End -->