<div class="cbp-l-project-title"><?= $data['album']?></div>
<!-- <div class="cbp-l-project-subtitle">by Paul Flavius Nechita</div> -->

<div class="cbp-slider">
    <ul class="cbp-slider-wrap">
    	<?php 
//print_r($data['gallery']);exit;
        foreach ($data['gallery'] as $album):

        ?>
        <li class="cbp-slider-item">
            <img src="<?= Yii::app()->easycode->showOriginalImage($album->image,'/album/') ?>" alt="<?= $data['album']?>">
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<br><br><br>


<?php /*?><link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/assets/gallery/unite-gallery.css" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/gallery/unitegallery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/assets/gallery/ug-theme-tiles.js"></script>
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
<section class="welcome_section" id="welcome" style="padding-bottom:0px;">
  <div class="container">
  	<div class="row">
    <div class="col-md-12">
    <div class="whitebg">
	<h1><?= $this->pageTitle?> <span style="color:#CCC;">-</span> <span style="color:#999"><?= $data['album']?></span></h1>
    
    <div id="gallery" style="display:block;">
		
        
        <?php 
//print_r($data['gallery']);exit;
        foreach ($data['gallery'] as $album):

        ?>
        <div class="col-md-4">
        	<img width="200" height="200" src="<?= Yii::app()->easycode->showOriginalImage($album->image,'/album/') ?>" alt="<?= $data['album']?>">
        </div>
		<!-- <a href="http://unitegallery.net">
        
        
        <img alt="<?//= $data['album']?>"
		     src="<?//= Yii::app()->easycode->showOriginalImage($album->image,'/album/') ?>"
		     data-image="<?//= Yii::app()->easycode->showOriginalImage($album->image,'/album/') ?>"
		     data-description="<?//= $data['album']?>"
		     style="display:block">
		</a> -->
<?php endforeach; ?>
		
      </div>
        </div>
    </div>
    </div>
  </div>
</section>

<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery("#gallery").unitegallery({
				tile_border_color:"#7a7a7a",
				tile_outline_color:"#8B8B8B",
				tile_enable_shadow:true,
				tile_shadow_color:"#8B8B8B",
				tile_overlay_opacity:0.3,
				//tile_show_link_icon:true,
				tile_image_effect_type:"sepia",
				tile_image_effect_reverse:true,
				tile_enable_textpanel:true,
				lightbox_textpanel_title_color:"e5e5e5",
				tiles_col_width:230,
				tiles_space_between_cols:20				
			});

		});
		
	</script>
    <?php */?>