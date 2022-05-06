<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'image-slider-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo Yii::app()->easycode->showNotification(); ?>

		<div class="col-md-12">
		<div class="col-md-6"><div class="form-group">
             <?php echo $form->labelEx($model, 'albumId'); ?>
             <?php echo $form->dropDownList($model, 'albumId', CHtml::listData(Album::model()->findAll(), id, name), array('empty'=>'Select any', 'class' => 'form-control')); ?>
			 <?php echo $form->error($model, 'albumId'); ?>
		</div><div class="col-md-6"></div></div></div>
				
        <div class="col-md-12">
			<div class="col-md-3">  
				<div class="form-group">
                       <?php echo $form->labelEx($model, 'image'); ?>
                       <?php echo $form->fileField($model, 'image'); ?>
					   <?php echo $form->error($model, 'image'); ?>
                      <?php echo Yii::app()->easycode->showImage($model->image, 120, 100,true,true,Yii::app()->params->albumDir);?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
                    <?php echo $form->labelEx($model, 'status'); ?>
                    <?php echo $form->dropDownList($model, 'status', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status'); ?>
				</div>
			</div>
		  </div>

    <div class="col-md-12"><div class="form-group buttons" style="">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Gallery' : 'Update Gallery', array('class' => 'btn btn-primary')); ?>
    </div></div>

<?php $this->endWidget(); ?>

</div><!-- form -->


