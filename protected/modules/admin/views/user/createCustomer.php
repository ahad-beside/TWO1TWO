<div class="row open_page">
    <div class="col-md-12 custom-page-header">
        <div class="col-md-6"><h2>Customer</h2></div>
        <div class="col-md-6 action-button">
            <?php
            echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('createCustomer'), array('class' => 'btn btn-default btn-circle', 'title' => 'New Customer'));
            echo CHtml::link('<i class="fa fa-list"></i>', $this->createUrl('admin'), array('class' => 'btn btn-default btn-circle', 'title' => 'All Customer'));
            ?>
        </div>
    </div>

    <div class="col-md-12"><?php echo Yii::app()->easycode->showNotification(); ?></div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Customer
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'first_name'); ?>
                                        <?php echo $form->textField($model, 'first_name', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'first_name'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'email'); ?>
                                        <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'email'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'password'); ?>
                                        <?php echo $form->textField($model, 'password', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'password'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'repeatpassword'); ?>
                                        <?php echo $form->textField($model, 'repeatpassword', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'repeatpassword'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'phone'); ?>
                                        <?php echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'phone'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'gender'); ?>
                                        <?php echo $form->dropDownList($model, 'gender', array('Male'=>'Male','Female'=>'Female'), array('empty'=>'Select Any','maxlength' => 50, 'class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'gender'); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($model, 'active'); ?>
                                        <?php echo $form->dropDownList($model, 'active', array('1' => 'Active', '0' => 'Inactive'), array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model, 'active'); ?>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="form-group buttons">
                                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
                            </div>

                            <?php $this->endWidget(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>