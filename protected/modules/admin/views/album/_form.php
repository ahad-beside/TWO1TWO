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


		<div class="row">	
			<div class="form-group">
				<div class="col-md-6">
                       <?php echo $form->labelEx($model, 'name'); ?>
                       <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
				</div>
			</div>
		</div>
		
	<div class="clear-fix">&nbsp;</div>
		
	<div class="form-group">
         <?php echo $form->labelEx($model, 'description'); ?>
         <?php echo $form->textArea($model, 'description', array('rows' => 10, 'cols' => 50, 'class' => 'form-control')); ?>
         <?php echo $form->error($model, 'description'); ?>
    </div>
	
	<div class="row">
			<div class="form-group">
				<div class="col-md-3">
					<?php echo $form->labelEx($model, 'image'); ?>
					<?php echo $form->fileField($model, 'image'); ?>
					<?php echo $form->error($model, 'image'); ?>
					<?php echo Yii::app()->easycode->showImage($model->image, 120, 100);?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php echo $form->labelEx($model, 'status'); ?>
					<?php echo $form->dropDownList($model, 'status', array('1' => 'Enable', '0' => 'Disable'), array('class' => 'form-control')); ?>
					<?php echo $form->error($model, 'status'); ?>
				</div>
			</div>
	</div>
				

	<div class="clear-fix">&nbsp;</div>


	
    <div class="form-group buttons" style="padding-right:5px">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Album' : 'Update Album', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>

   /*  var editor = CKEDITOR.replace('Album_description');
    CKFinder.setupCKEditor(editor, '<?php echo Yii::app()->request->baseUrl ?>/ckfinder/');

    var finder = new CKFinder();
    finder.basePath = '<?php echo Yii::app()->request->baseUrl ?>/ckfinder/'; */
	
var roxyFileman = '<?php echo Yii::app()->request->baseUrl ?>/fileman/index.html';
     $(function(){
           CKEDITOR.replace( 'Album_description',{filebrowserBrowseUrl:roxyFileman,
                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                    removeDialogTabs: 'link:upload;image:upload'});
});


</script>

