<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">Sign In</span>
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
            <div class="login-content">
            <div class="login-text">
              <h3>Sign In</h3>
              <p>Please Enter your email and password to Sign In</p>
            </div>
  <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action'=>Yii::app()->createUrl('//site/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('role' => 'form')
    ));
    ?>
    <input type="hidden" name="referalUrl" value="<?= $referalUrl?>">
              <div class="form-group">
                <div class="controls">
                  <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Type your email address')); ?> <?php echo $form->error($model, 'username'); ?>
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Type your password')); ?> <?php echo $form->error($model, 'password'); ?>
                </div>
              </div>
              <div class="button-box">
                <div class="login-toggle-btn">
                  <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $form->label($model, 'rememberMe'); ?>
        <?php echo $form->error($model, 'rememberMe'); ?>
                  <a href="javascript:void(0);" class="forget"> Forgot your password?</a></div>
                <button type="submit" class="btn btn-common log-btn">Sign In</button>
              </div>
            <?php $this->endWidget(); ?> 
            <!-- <p>If you want to register with <?//= Yii::app()->name?> please <a href="<?//= Yii::app()->createUrl('//site/registration');?>">Click Here</a>.</p> -->
            </div>
            
            
            <div class="result forgot_bg" style="display: none;">
            <div class="login-text">
              <h3>Forgot Password</h3>
              <p>Please Enter your registered email to recover password</p>
            </div>
            
    
    <div class="signin-account-register" style="padding:0px; margin-bottom: 0px;">
        <div class="row col-sm-12">
            <form role="form" id="forgotpas_form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" placeholder="Enter registerd email address" id="frgt_paswd_email_id" class="form-control">
                </div>
                
                <div class="row">
                <div class="col-md-6">
                	<button id="forgotspin" class="btn btn-success" type="button" onclick="forgotPassword();">Recover Password</button>
                </div>
                
                <div class="col-md-6" style="padding-top:12px;">
                	<a href="javascript:void(0);" class="login-show"> login Click Here</a>
                </div>
                </div>
                
                
            </form>
            <p style="margin-top: 10px;" id="msg_forgotpass"></p>
        </div>
    </div>
</div>
            
            
          </div>
          
          

          
        </div>
      </div>
    </div>
  </div>
</section>
<script>
   $('.forget').click(function () {
	$('.login-content').slideToggle(100);
    $(".result").slideToggle(100);
    scrollToTarget('#forgotpas_form');
});
</script>

<script>
   $('.login-show').click(function () {
    $(".forgot_bg").slideToggle(100);
	$('.login-content').slideToggle(100);
    scrollToTarget('#forgotpas_form');
	});
</script>


