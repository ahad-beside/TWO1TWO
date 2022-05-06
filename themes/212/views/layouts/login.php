<?php $this->renderPartial('/layouts/header_assets'); ?> 
<!-- Header Section Start -->
<div class="header" style="background-color:#333;"> 
  
  <!-- Start Top Bar -->
  <?php include 'top_bar.php'; ?>
  <!-- End Top Bar --> 
  
  <!-- Start  Logo & Naviagtion  -->
  <nav class="navbar navbar-default" data-spy="affix" data-offset-top="50">
    <?php $this->renderPartial('/layouts/top_menu'); ?>
  </nav>
</div>
<!-- Header Section End --> 
<!-- DYNAMIC CONTENT START FROM HERE -->

    <?= $content;?>

    <!-- DYNAMIC CONTENT END HERE -->

<!-- Footer Start -->
<footer class="section">
  <?php $this->renderPartial('/layouts/footer'); ?>  
</footer>
<!-- Footer End --> 

<!-- Copyright Start -->
<?php $this->renderPartial('/layouts/copyright'); ?>
<!-- Copyright End --> 

<!-- Go To Top Link --> 
<a href="#" class="back-to-top"> <i class="icon-arrow-up"></i> </a> 

<!-- All js here -->
 <?php $this->renderPartial('/layouts/footer_assets'); ?>