<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/cubeportfolio/css/cubeportfolio.css">
<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Gallery</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<section class="welcome_section section" id="welcome">
  <div class="container">
  	<div class="row">
    <div class="col-md-12">
    <div class="whitebg">
        <h1 class="section-title"><?= $this->pageTitle?></h1>
        <div class="album">
        
        
        <div id="js-grid-masonry-projects" class="cbp cbp-l-grid-masonry-projects">
        <?php foreach ($data['album'] as $album):?>
        <div class="cbp-item graphic">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="<?= Yii::app()->easycode->showOriginalImage($album->image,Yii::app()->params->albumDir)?>"/>
                    
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a href="<?php echo Yii::app()->createUrl('//site/gallery',array('id'=>$album->id))?>" class="cbp-singlePage cbp-l-caption-buttonLeft" rel="nofollow">View Gallery</a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo Yii::app()->createUrl('//site/gallery',array('id'=>$album->id))?>" class="cbp-singlePage cbp-l-grid-masonry-projects-title" rel="nofollow"><?= $album->name?></a>
        </div>
        
        <?php endforeach; ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
    </div>
    
    
        
        
        
        <?php /*?>
        <?php foreach ($data['album'] as $album):?>
        
        <div class="col-lg-3">
            <a href="<?php echo Yii::app()->createUrl('//site/gallery',array('id'=>$album->id))?>"><?= Yii::app()->easycode->showImage($album->image,253,142,true,true,Yii::app()->params->albumDir)?></a>
            <h3><a href="<?php echo Yii::app()->createUrl('//site/gallery',array('id'=>$album->id))?>"><?= $album->name?></a></h3>
        </div>
        
        <?php endforeach; ?><?php */?>
        </div>
        </div>
    </div>
    </div>
  </div>
</section>

<!-- load cubeportfolio -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/cubeportfolio/js/jquery.cubeportfolio.js"></script>

    <!-- init cubeportfolio -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/cubeportfolio/js/main.js"></script>