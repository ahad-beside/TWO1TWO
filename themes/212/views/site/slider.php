<div class="ms-fullscreen-template" id="slider1-wrapper"> 

  <!-- masterslider -->

  <div class="master-slider ms-skin-default" id="masterslider">

<?php foreach($data['slider'] as $rowSlide):?>

    <div class="ms-slide slide-1">

      <div class="slide-pattern"></div>

      <img src="<?= Yii::app()->theme->baseUrl?>/assets/masterslider/blank.gif" data-src="<?= Yii::app()->easycode->showOriginalImage($rowSlide->image,'/slider/');?>" alt="lorem ipsum dolor sit"/>

      <?php if($rowSlide->title!=''){?>

      <h3 class="ms-layer bold-text-white bigtext"

					data-type="text"

					data-effect="rotate3dtop(70,0,0,180)"

					data-duration="2000"

					data-ease="easeInOutQuint"

		        > <?=$rowSlide->title?></h3>

<?php } ?>

<?php if($rowSlide->button_label!=''){?>

      <h4 class="ms-layer captiontext"

					data-type="text"

					data-effect="rotate3dbottom(-70,0,0,180)"

					data-duration="2000"

					data-ease="easeInOutQuint"

		        > <a target="_blank" href="<?=$rowSlide->link?>" class="btn btn-red"><?=$rowSlide->button_label?></a> </h4>

    </div>

<?php } ?>

    <?php endforeach;?>



    <!--<div class="ms-slide slide-2">

      <div class="slide-pattern"></div>

      <h3 class="ms-layer thin-text-white blacktext"

					data-type="text"

					data-effect="rotate3dleft(50,0,0,480)"

					data-duration="2000"

					data-ease="easeInOutQuint"

		        > MODERN </h3>

      <h3 class="ms-layer thin-text-black whitetext"

					data-type="text"

					data-effect="rotate3dright(-50,0,0,480)"

					data-duration="2000"

					data-ease="easeInOutQuint"

		        > DESIGN </h3>

      <img src="assets/masterslider/blank.gif" data-src="assets/masterslider/img/2.jpg" alt="lorem ipsum dolor sit"/> </div>

    <div class="ms-slide slide-3">

      <div class="slide-pattern"></div>

      <h3 class="ms-layer thin-text-white blacktext"

					data-type="text"

					data-effect="top(45)"

					data-duration="3400"

					data-ease="easeOutExpo"

		        > WE CREATE </h3>

      <h4 class="ms-layer bold-text-white bigtext"

					data-type="text"

					data-effect="top(45)"

					data-duration="3400"

					data-delay="400"

					data-ease="easeOutExpo"

		        > AWOESOME STUFF </h4>

      <img src="assets/masterslider/blank.gif" data-src="assets/masterslider/img/3.jpg" alt="lorem ipsum dolor sit"/> </div>

    <div class="ms-slide slide-4">

      <div class="slide-pattern"></div>

      <div class="ms-layer box"

					data-effect="skewleft(15,250)"

					data-duration="1300"

					data-ease="easeOutBack"

		       ></div>

      <h4 class="ms-layer small-text"

					data-type="text"

					data-effect="skewleft(25,250)"

					data-duration="1000"

					data-ease="easeOutQuart"

					data-delay="500"

		        > THE BEST SOLUTION </h4>

      <h3 class="ms-layer medium-text"

					data-type="text"

					data-effect="skewright(25,250)"

					data-duration="1500"

					data-ease="easeOutQuart"

					data-delay="700"

		        > FOR YOUR </h3>

      <h3 class="ms-layer big-text"

					data-type="text"

					data-effect="scalebottom(1.1,1.1,50)"

					data-duration="1500"

					data-ease="easeOutQuart"

					data-delay="1200"

		        > BUSSINESS </h3>

      <img src="assets/masterslider/blank.gif" data-src="assets/masterslider/img/4.jpg" alt="lorem ipsum dolor sit"/> </div>

    <div class="ms-slide slide-5">

      <div class="slide-pattern"></div>

      <h4 class="ms-layer video-caption"

					data-type="text"

					data-effect="bottom(50)"

					data-duration="1540"

		        > HD BACKGROUND VIDEOS </h4>

      <video data-autopause="false" data-mute="true" data-loop="true" data-fill-mode="fill">

        <source src="video/video.mp4" type="video/mp4"/>

        <source src="video/video.webm" type="video/webm"/>

        <source src="video/video.ogv" type="video/ogg"/>

      </video>

      <img src="assets/masterslider/blank.gif" data-src="assets/masterslider/img/video.jpg" alt="lorem ipsum dolor sit"/> </div>-->

  </div>

  <!-- end of masterslider --> 

</div>



<style>

    @media (min-width: 320px) and (max-width: 900px) {

    .ms-slide .ms-slide-layers{

        dislplay:none!important;

		opacity: 0 !important;

    }

    .ms-skin-default .ms-nav-next, .ms-skin-default .ms-nav-prev{

		top:63%!important;

	}

}

</style>

	