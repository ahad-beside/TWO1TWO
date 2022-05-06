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
                  <div class="row"><div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>
                                        </div>
                  <div class="row">
                    <div class="col-md-12">
        <div class="login">
<div class="">
<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'job-applied-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
        if($model->isNewRecord){
          $newModel=$userModel;
        }else{
          $newModel=$model;
        }
    ?>

<div class="form-group">
  <div class="row">
      <div class="col-md-6">
        <?php echo $form->labelEx($newModel, 'first_name', array('class' => '')); ?>
          <?php echo $form->textField($newModel, 'first_name', array('class' => 'form-control', 'placeholder' => 'Type your first name')); ?> 
          <?php echo $form->error($newModel, 'first_name'); ?>
        </div>
        <div class="col-md-6">
          <?php echo $form->labelEx($newModel, 'last_name', array('class' => '')); ?>
           <?php echo $form->textField($newModel, 'last_name', array('class' => 'form-control', 'placeholder' => 'Type your Last name')); ?> 
           <?php echo $form->error($newModel, 'last_name'); ?>
        </div>
    </div>
</div>
<div class="form-group">
  <div class="row">
      <div class="col-md-6">
        <?php echo $form->labelEx($model, 'birth_date', array('class' => '')); ?>
          <?php 
            $this->widget('ext.YiiDateTimePicker.jqueryDateTime', 
              array( 'model' => $model, 'attribute' => 'birth_date', 'options' => array( 'format' => 'd-m-Y', 'timepicker' => true, 'closeOnDateSelect' => true, ), 
             'htmlOptions' => array( 'class' => 'form-control input-sm'), 
           ));
           ?> 
          <?php echo $form->error($model, 'birth_date'); ?>
        </div>
        <div class="col-md-6">
          <?php echo $form->labelEx($model, 'gender', array('class' => '')); ?>
           <?php echo $form->dropDownList($model, 'gender',array('Male'=>'Male','Female'=>'Female'), array('class' => 'form-control', 'prompt' => 'Select Any')); ?> 
           <?php echo $form->error($model, 'gender'); ?>
        </div>
    </div>
</div>

<div class="form-group">
<div class="controls">
   <?php echo $form->labelEx($model, 'address1', array('class' => '')); ?>
   <!--  <input name="JobAppliedList[cv_file]" type="file">  -->
   <?php echo $form->textArea($model, 'address1', array('class' => 'form-control', 'prompt' => 'Select Any')); ?> 
<?php echo $form->error($model, 'address1'); ?>
</div>
</div>

<div class="form-group">
  <div class="row">
      <div class="col-md-6">
        <?php echo $form->labelEx($model, 'phone', array('class' => '')); ?>
          <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'placeholder' => 'Type your phone')); ?> 
          <?php echo $form->error($model, 'phone'); ?>
        </div>
        <div class="col-md-6">
          <?php echo $form->labelEx($model, 'country', array('class' => '')); ?>
          <?php echo $form->dropDownList($model, 'country',CHtml::listData(Country::model()->findAll(),'id','name'), array('class' => 'form-control', 'prompt' => 'Select Any')); ?>
          <?php echo $form->error($model, 'country'); ?>
        </div>

          
    </div>
</div>

<div class="form-group">
<div class="controls">
   <?php echo $form->labelEx($model, 'photo', array('class' => '')); ?>
          <?php echo $form->fileField($model, 'photo', array('class' =>'')); ?> 
          <?php echo $form->error($model, 'photo'); ?>
</div>
</div>

 <img style="width: 80px;height: 80px;" src="<?php echo Yii::app()->easycode->showOriginalImage($model->photo,'/user/'); ?>">
<div class="button-box">
<button type="submit" class="btn btn-success log-btn">Save</button>
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
.xdsoft_timepicker{
  display: none!important;
}
</style>
<!-- End Page Header -->
</section>