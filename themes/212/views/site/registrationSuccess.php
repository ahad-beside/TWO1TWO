<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Success</span>
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

  <i class="fa fa-check-circle-o fa-5x"></i>
<p>Congratulations! Your new account has been successfully created!</p>
  <p>You can now take advantage of member privileges to enhance your online shopping experience with us.</p>
<!--  <p>If you have ANY questions about the operation of this online shop, please email the store owner.</p>-->
  <p><b>A confirmation has been sent to the provided email address</b>.</p>
  <p>If you have not received it within 30 mins., please click here to <a href="<?= $this->createUrl('resendEmailVerification',array('user'=>base64_encode($_GET['user'])))?>" class="resendVerification">Resend</a> <i class="fa fa-spinner fa-spin verificationLoading" style="display: none"></i> or <a href="<?php echo Yii::app()->createAbsoluteUrl('//site/contact')?>">contact us</a>.</p>
</div>
</div>
</div>
      </div>
    </div>
  </div>
</section>