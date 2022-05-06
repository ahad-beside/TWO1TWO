<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo Yii::app()->easycode->showNotification(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo Chtml::textField('emailTest', $model->email, array('size' => 50, 'maxlength' => 50, 'class' => 'form-control','disabled'=>'disabled')); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'active'); ?>
                <?php echo $form->dropDownList($model, 'active', array('1'=>'Active','0'=>'Inactive'), array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'active'); ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($data['profileModel'], 'name'); ?>
                <?php echo $form->textField($data['profileModel'], 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                <?php echo $form->error($data['profileModel'], 'name'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'active'); ?>
                <?php echo $form->dropDownList($model, 'active', array('1'=>'Active','0'=>'Inactive'), array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'active'); ?>
            </div>
        </div>
    </div>
    

    

    

    <div class="form-group buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->