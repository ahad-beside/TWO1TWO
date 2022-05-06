<section id="product-collection" class="section30"> 
 <!-- Start Page Header -->
 <div class="content-page-header" style="margin-top:61px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span> <span class="current"><?= $this->pageTitle;?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<div id="content" class="product-area" style="padding:0px 0px;">
  <div class="container">
    <div class="whitebox">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
          <?php $this->renderPartial('sidebar',array('data'=>$data)); ?>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="shop-content">
            <div class="perrow">
              <div class="row">
                <div class="col-md-12">
                  <h2><?= $this->pageTitle;?></h2>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
        <div class="login">
<div class="">
<?= Yii::app()->easycode->showNotification() ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action'=>Yii::app()->createUrl('//user/changePassword'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('role' => 'form')
    ));
    ?>


<div class="form-group">
  <div class="row">
      <div class="col-md-6">
        <label for="exampleInputEmail1">Current Password</label>
          <input type="password" class="form-control" name="Password[current]">
        </div>
        <div class="col-md-6">
          
        </div>
    </div>
</div>
<div class="form-group">
  <div class="row">
      <div class="col-md-6">
         <label for="exampleInputEmail1">Re-Type Password</label>
                  <input type="password" class="form-control" name="Password[re]">
        </div>
        <div class="col-md-6">
          
        </div>
    </div>
</div>

<div class="form-group">
  <div class="row">
      <div class="col-md-6">
        <label for="exampleInputEmail1">Re-Type Password</label>
                  <input type="password" class="form-control" name="Password[re]">
        </div>
        <div class="col-md-6">
          
        </div>
    </div>
</div>

<div class="button-box">
                <button type="submit" class="btn btn-common log-btn">Change</button>
              </div>
<?php $this->endWidget(); ?>
</div>
</div>
      </div>
                  </div><!--/row--> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

<style>
.expired_date{
  color:#666;
  font-size:12px;
}
.perrow{
  width:100%;
  display:inline-block;
  background-color:#FFF;
  margin-bottom:20px;
  padding:12px;
}
.date{
  font-size:12px;
  color:#888;
}
.whitebox{
  width:100%;
  display:inline-block;
  padding:12px;
}
.shop-content a{
  color:#15C;
}
</style>
<!-- End Page Header -->
</section>