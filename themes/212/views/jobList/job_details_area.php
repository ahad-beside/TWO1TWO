<div class="content-page-header" style="margin-top:61px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb"> <a href="<?= Yii::app()->homeUrl;?>"><i class="icon-home"></i> Home</a> 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Page Header -->
<div class="product-area" style="padding:50px 0px;">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12">
        <?php $this->renderPartial('/jobCategory/job_sidebar',array('data'=>$data)); ?>
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="shop-content">
          <h2><?= $data->name?></h2>
          <p style="font-size:12px">Expire Date: <em style="font-size:12px;"><?= date('d-m-Y',strtotime($data->expire_date));?></em></p>
          <p><?= $data->description;?></p>
          
          
          
          
            <!-- Trigger the modal with a button -->
<div style="text-align:center; margin:20px 0px;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Apply Now</button></div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply Now</h4>
      </div>
      <div class="modal-body">
        <p>
        	<section id="">
  <div class="">
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
        echo $form->hiddenField($modelApply, 'job_id', array('class' => 'form-control', 'value' => $data->id));
    ?>

<div class="form-group">
	<div class="row">
    	<div class="col-md-6">
        	<?php echo $form->labelEx($modelApply, 'name', array('class' => '')); ?>
<?php echo $form->textField($modelApply, 'name', array('class' => 'form-control', 'placeholder' => 'Type your name')); ?> <?php echo $form->error($modelApply, 'name'); ?>
        </div>
        <div class="col-md-6">
        	 <?php echo $form->labelEx($modelApply, 'email', array('class' => '')); ?>
<?php echo $form->textField($modelApply, 'email', array('class' => 'form-control', 'placeholder' => 'Type your email')); ?> <?php echo $form->error($modelApply, 'email'); ?>
        </div>
    </div>
<div class="controls">
   
</div>
</div>
<div class="form-group">
<div class="controls">
   <?php echo $form->labelEx($modelApply, 'phone', array('class' => '')); ?>
<?php echo $form->textField($modelApply, 'phone', array('class' => 'form-control', 'placeholder' => 'Type your phone')); ?> 
<?php echo $form->error($modelApply, 'phone'); ?>
</div>
</div>
<div class="form-group">
<div class="controls">
   <?php echo $form->labelEx($modelApply, 'cv_file', array('class' => '')); ?>
   <!--  <input name="JobAppliedList[cv_file]" type="file">  -->
   <?php echo $form->fileField($modelApply, 'cv_file', array('class' =>'')); ?> 
<?php echo $form->error($modelApply, 'cv_file'); ?>
</div>
</div>
<div class="button-box">
<button type="submit" class="btn btn-success log-btn">Send</button>
</div>
<?php $this->endWidget(); ?>
</div>
</div>
      </div>
    </div>
  </div>
</section>
        </p>
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
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
	.shop-content{
		width:100%;
		display:inline-block;
		background-color:#FFF;
		padding:12px;
	}
	.shop-content h2{
		font-size:25px;
	}
	.dtls{
		color:#000;
	}
</style>