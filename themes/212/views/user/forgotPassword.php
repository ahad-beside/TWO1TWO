
<!-- Start Page Header -->
<div class="content-page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current">New Password</span>
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
              <h3>New Password</h3>
            </div>
            <?= Yii::app()->easycode->showNotification() ?>
  <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action'=>Yii::app()->createUrl('//user/forgotPassword'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('role' => 'form')
    ));
    ?>
    <input type="hidden" name="Password[forgot_pass_code]" value="<?php echo $_GET['link']?>">
              <div class="form-group">
                <div class="controls">
                  <label for="exampleInputEmail1">New Password</label>
                  <input type="password" class="form-control" name="Password[new]">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <label for="exampleInputEmail1">Re-Type Password</label>
                  <input type="password" class="form-control" name="Password[re]">
                </div>
              </div>
              <div class="button-box">
                <button type="submit" class="btn btn-common log-btn">Set Password</button>
              </div>
            <?php $this->endWidget(); ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

