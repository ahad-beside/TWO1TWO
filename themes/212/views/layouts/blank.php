<?php $this->renderPartial('/layouts/header_assets'); ?> 
<!-- Header Section Start -->
<!-- Header Section End --> 
<!-- DYNAMIC CONTENT START FROM HERE -->
<div id="fullscreen">
	<?= $content;?>
</div>
    

    <!-- DYNAMIC CONTENT END HERE -->

<!-- Copyright Start -->
<?php //$this->renderPartial('/layouts/copyright'); ?>
<!-- Copyright End --> 

<!-- Go To Top Link --> 
<a href="#" class="back-to-top"> <i class="icon-arrow-up"></i> </a> 

<!-- All js here -->
 <?php $this->renderPartial('/layouts/footer_assets'); ?>