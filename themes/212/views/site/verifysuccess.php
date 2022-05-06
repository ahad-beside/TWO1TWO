<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Verify Success</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="login">
<div class="login-form-container">
<div class="login-text">

  <h1 style="font-size: 22px;">Congratulations!</h1>                
                <p style="font-size: 20px;"><?= Yii::app()->user->getFlash('success');?></p>
             <?php if(isset($_GET['role']) && $_GET['role']==4){?>   
             <p>Your account is successfully varified. We will review and activate your account soon.</p>
             <?php }else{?> 
  <p>You can now take advantage of member privileges to enhance your online shopping experience with us.</p>
  <div class="col-md-12" style="margin-bottom: 16px;">
                <div style="text-align: center;"><a href="<?php echo Yii::app()->createUrl('//site/login')?>" class="btn btn-primary">Go To Login Page</a></div>
            </div>
            <?php } ?>
</div>
</div>
</div>
      </div>
    </div>
  </div>
</section>